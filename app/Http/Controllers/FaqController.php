<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'add_categories'=>'required',
            'answer' => 'required',
        ]);

        $faq = new Faq;
        $faq->question = $request->input('question');
        $faq->category = $request->input('add_categories');
        $faq->answer = $request->input('answer');

        try {
            $faq->save();
            return redirect()->route('faq.index')->with('success', 'Question has been added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'question' => 'required',
            'category' => 'required',
            'answer' => 'required',
        ]);
        $input = $request->only('question', 'answer','category');
    
        try {
            $faq = Faq::where('id', $id)->update($input);
            return redirect()->route('faq.index')->with('success', 'Question has been updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'FAQ not updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $faq = Faq::where('id', $id)->delete();
            return redirect()->back()->with('success', 'FAQ deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'FAQ not deleted successfully.');
        }
    }
    public function showfaq($category)
    {
        $faqs_info = Faq::where('category',$category)->get();
        return view('faq-indetail', compact('faqs_info','category'));
    }
    public function searchfaq(Request $request)
    {
        $search_tearm=$request->s;
        $faqs=Faq::where('question', 'LIKE', "$search_tearm%")->get();
        return view('faq-indetail-search', compact('faqs'));

    }
    public function userIndex()
    {
        $faqs = Faq::get();
        $full_count = $faqs->count();
        $count = intval(ceil(($faqs->count())/2));
        for ($i=0; $i < $count ; $i++) {
            $faq1[] = $faqs[$i];
        }
        for ($i=$count; $i < $full_count; $i++){
            $faq2[] = $faqs[$i];
        }
        return view('faq', compact('faq1', 'faq2'));
    }
}
