<?php

namespace App\Http\Controllers;

use App\Events;
use App\EventCategory;
use App\User;
use App\Usergroup;
use App\EventsInvitations;
use Auth;
use App\EventBuy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
    }


    public function index()
    {
        $events = Events::orderBy('created_at', 'desc')->get();
        $usergroup = Usergroup::all();
        return view('admin.events.index', compact('events', 'usergroup'));
    }

    public function create()
    {
        $categories = EventCategory::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
        ]);

        $final_date = "";

        if ($request->has('date') && $request->get('date') != "") {
            $original_dt = $request->get('date');

            //$original_dt="qq";

            $dt = str_replace('-', '/', $original_dt);

            $dt_timestamp = strtotime($dt);

            if (date('m-d-Y h:i A', $dt_timestamp) == $original_dt) {
                $final_date = date('Y-m-d H:i:s', $dt_timestamp);
            }

        }

        if ($final_date) {

            $event = new Events;

            $event->title = $request->input('title');
            $event->content = $request->input('description');
            if ($request->input('category')) {
                $category = json_encode($request->input('category'));
                $event->category = $category;
            }
            $event->date = $final_date;
            //$event->location = $request->input('location');
            $event->location_url = $request->input('location_url');
            $event->author_id = Auth::user()->id;
            $event->price = $request->input('price');
            $event->free_tokens = $request->input('freetokens');
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/events/');
                $image->move($destinationPath, $name);
                $event->image = $name;
            }
            if ($request->hasFile('cover_pic')) {
                $image = $request->file('cover_pic');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/events/');
                $image->move($destinationPath, $name);
                $event->cover_pic = $name;
            }

            $event->save();

            return redirect('admin/events')->with('success', 'Event Created');
        } else {
            return back()->with('error', 'Please provide valid date.')->withInput($request->all());
        }

    }

    public function edit($id, Request $request)
    {
        $event = Events::find($id);
        $categories = EventCategory::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update($id, Request $request)
    {

        $final_date = "";

        if ($request->has('date') && $request->get('date') != "") {
            $original_dt = $request->get('date');

            //$original_dt="qq";

            $dt = str_replace('-', '/', $original_dt);

            $dt_timestamp = strtotime($dt);

            if (date('m-d-Y h:i A', $dt_timestamp) == $original_dt) {
                $final_date = date('Y-m-d H:i:s', $dt_timestamp);
            }

        }

        if ($final_date) {

            $event = Events::find($id);
            $this->validate($request, [
                'title' => 'required',
            ]);
            $event->title = $request->input('title');
            $event->content = $request->input('description');
            if ($request->input('category')) {
                $category = json_encode($request->input('category'));
                $event->category = $category;
            }
            $event->date = $final_date;
            //$event->location = $request->input('location');
            $event->location_url = $request->input('location_url');
            $event->price = $request->input('price');
            $event->author_id = Auth::user()->id;
            $event->free_tokens = $request->input('freetokens');
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/events/');
                $image->move($destinationPath, $name);
                $event->image = $name;
            }
            if ($request->hasFile('cover_pic')) {
                $image = $request->file('cover_pic');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/events/');
                $image->move($destinationPath, $name);
                $event->cover_pic = $name;
            }

            $event->save();

            return back()->with('success', 'Event Updated');
        } else {
            return back()->with('error', 'Please provide valid date.');
        }
    }

    public function delete($id)
    {
        $event = Events::find($id);
        $event->delete();
        return back()->with('success', 'Event Deleted');
    }

    public function suspend($id)
    {
        $event = Events::find($id);
        $event->suspend = '1';
        $event->save();
        return back()->with('success', 'Event Suspended');
    }

    public function active($id)
    {
        $event = Events::find($id);
        $event->suspend = '0';
        $event->save();
        return back()->with('success', 'Event Activated');
    }

    public function feature($id)
    {
        $event = Events::find($id);
        $event->feature = '1';
        $event->save();
        return back()->with('success', 'Event is featured Now');
    }

    public function unfeature($id)
    {
        $event = Events::find($id);
        $event->feature = '0';
        $event->save();
        return back()->with('success', 'Event is unfeature Now');
    }

    public function sentInvitations(Request $request)
    {

        $groups = $request->input('groupsid');
        //dd($groups);
        if ($groups) {
            foreach ($groups as $group) {
                $invitations = new EventsInvitations;
                $invitations->events_ids = $request->input('events_id');
                $invitations->usergroup_id = $group;
                $invitations->save();
            }
        }
        return back()->with('success', 'Event Invitations Successfully Sent');
    }

    public function events(Request $request)
    {
        $categories = EventCategory::all();
        //$events = Events::all();
        $events = Events::with('userSaved')
            // ->whereRaw('date >= CURDATE()')
            ->orderBy('id', 'desc')
            ->get();
        $featured_events = Events::where('feature', 1)->orderBy('id', 'DESC')->limit(5)->get();

        if (isset($_GET['category'])) {
            $cat_id = @$_GET['category'];
            $date = @$_GET['dates'];
            $location = @$_GET['location'];
            if ($date > 0) {
                $events = Events::with('userSaved')->Where('category', 'like', '%"' . $cat_id . '"%')
                    ->Where('location', 'like', $location)
                    ->whereRaw('MONTH(date) = ?', [$date])
                    ->get();
            } else {
                $events = Events::with('userSaved')->Where('category', 'like', '%"' . $cat_id . '"%')
                    ->Where('location', 'like', $location)
                    ->get();
            }
        }

        foreach ($events as $k => $event) {
            $events[$k]['saved_event_user_ids'] = $event->userSaved->pluck('id')->toArray();

        }
        // echo '<pre>';print_r($events);die;
          $title_by_page = "Events";

        return view('events', compact('events', 'categories', 'featured_events','title_by_page'));

    }

    public function eventsingle($id)
    {
        $event = Events::with('userSaved')->find($id);
        $event->saved_event_user_ids = $event->userSaved->pluck('id')->toArray();
        $featured_events = Events::where('feature', 1)->orderBy('id', 'DESC')->limit(5)->get();
        return view('singleEvent', compact('event','featured_events'));
    }

    public function eventBuy($id, Request $request)
    {
        $price = $request->input('amount');
        $user = Auth::user();
        $payment = $user->charge($price);
        // dd($payment);
        if ($payment->status == 'succeeded') {
            $eventBuy = new EventBuy;
            $eventBuy->event_id = $id;
            $eventBuy->user_id = $user->id;
            $eventBuy->transaction_id = $payment->balance_transaction;
            $eventBuy->save();
            return redirect()->back()->with('message', 'Buy Event Successfully');
        }
        return redirect()->back()->with('message', 'Payment Failed');
    }

    public function saveEventInUserList(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $event_id = 0;

        if ($request->has('event_id'))
            $event_id = $request->get('event_id');

        $response = array();
        $response['success'] = false;

        if (!$event_id) {
            $response['error'] = 'Event not found';
            return Response::json($response, 200); //422
        }

        $event = Events::find($event_id);

        if (!$event) {
            $response['error'] = 'Event not found';
            return Response::json($response, 200); //422
        }

        $hasPivot = User::where('id', $user_id)->whereHas('savedEvents', function ($q) use ($event_id) {
            $q->where('event_id', $event_id);
        })
            ->exists();

        if ($hasPivot) {
            $user->savedEvents()->detach($event_id);
            $msg = "Event unsaved successfully.";

        } else {
            $list = array($event_id);
            $user->savedEvents()->sync($list, false);
            $msg = "Event saved successfully.";
        }

        $response['success'] = true;
        $response['msg'] = $msg;

        return Response::json($response, 200); //422

    }

    public function getSavedEvents()
    {

        $user_id = Auth::user()->id;

        $saved_events = Events::savedByUser($user_id)
            ->orderBy('date', 'desc');

        $saved_events = $saved_events->paginate(15);
        $title_by_page = "Events";

        return view('user.saved-events', compact('saved_events', 'title_by_page'));

    }


    public function deleteSavedEvent($id)
    {

        $user = Auth::user();
        $user_id = Auth::user()->id;

        $event_id = $id;

        $event = Events::find($event_id);

        if (!$event) {
            return back()
                ->with('error', 'Event not found.');
        }

        $hasPivot = User::where('id', $user_id)->whereHas('savedEvents', function ($q) use ($event_id) {
            $q->where('event_id', $event_id);
        })
            ->exists();

        if ($hasPivot) {
            $user->savedEvents()->detach($event_id);
        }

        return back()
            ->with('success', 'Event removes from list successfully.');
    }

    public function searchEvent(Request $request)
    {
        $eventObj = Events::orderBy('id', 'ASC');
        $featured_events = Events::where('feature', 1)->orderBy('id', 'DESC')->limit(5)->get();
        $events = '';
        if (!empty($request->search_keyword)) {
            $eventObj->where('title', 'LIKE', '%' . $request->search_keyword . '%');
        }
        if (!empty($request->dates)) {
            $eventObj->whereMonth('date', '=', $request->dates);
        }
        if (!empty($request->category)) {
            $eventObj->Where('category', 'like', '%"' . $request->category . '"%');
        }
        $events = $eventObj->get();
        $categories = EventCategory::all();
        if (empty($events)) {
            $events = Events::with('userSaved')->get();
        }

        foreach ($events as $k => $event) {
            $events[$k]['saved_event_user_ids'] = $event->userSaved->pluck('id')->toArray();
        }

        return view('events', compact('events', 'categories','featured_events'));
    }

}
