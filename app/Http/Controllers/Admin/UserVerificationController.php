<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MatchQuestCategory;
use App\Questionnaires;
use App\Usergroup;
use App\UserVerificationQuestionnaires;
use Illuminate\Support\Facades\Validator;

class UserVerificationController extends Controller
{
    public function init()
    {
        $groupId = 1;
        $usergroup = Usergroup::find($groupId);
        $usergroups = Usergroup::get();
        $questionnaires = UserVerificationQuestionnaires::with('usergroups')->paginate(15);
        return view('admin.user.verification.questionnaireslist', compact('questionnaires', 'usergroups'));
    }
    // Index
    public function index()
    {
        $match_quest_categories = MatchQuestCategory::all();
        $usergroups = Usergroup::get();
        return view('admin.user.verification.userverification', compact('match_quest_categories', 'usergroups'));
    }

    // Create
    public function createQuestions(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'question_title' => 'required|max:200',
            'question_type' => 'required|max:200',
            //'question' => 'required_if:question_type,==,2',
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        if ($request->question_type == 2 || $request->question_type == 3 || $request->question_type == 5) {
            $flag = 0;
            if ($request->has('question') && count($request->question) > 0) {
                foreach ($request->question['options'] as $row) {
                    if (empty($row)) {
                        $flag = 1;
                    }
                }
            } else {
                $flag = 1;
            }
            if ($flag) {
                return redirect()->back()->with('question', 'Enter ooption if you select answer type select, checkbox or multiple choice');
            }
        }

        // $request[UserVerificationQuestionnaires::category_id] = request('category');
        $data = new UserVerificationQuestionnaires();
        $record = $data->addOrupdate($request);
        return redirect('admin/userverification');
    }
    // Edit
    public function edit($id)
    {
        $questionnaires = UserVerificationQuestionnaires::with('usergroups')->findorfail($id);
        $usergroup = Usergroup::get();
        $match_quest_categories = MatchQuestCategory::all();
        $usergroups = $questionnaires->usergroups()->get();
        return view('admin.user.verification.editquestionnaires', compact('questionnaires', 'usergroup', 'match_quest_categories', 'usergroups'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question_title' => 'required|max:200',
            'question_type' => 'required|max:200',
            // 'category' => 'required|exists:match_quest_categories,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->question_type == 2 || $request->question_type == 3 || $request->question_type == 5) {
            $flag = 0;
            if ($request->has('question') && count($request->question) > 0) {
                foreach ($request->question['options'] as $row) {
                    if (empty($row)) {
                        $flag = 1;
                    }
                }
            } else {
                $flag = 1;
            }
            if ($flag) {
                dd(2);
                return redirect()->back()->with('question', 'Enter ooption if you select answer type select, checkbox or multiple choice');
            }
        }
        // $request[UserVerificationQuestionnaires::category_id] = request('category');
        $data = new UserVerificationQuestionnaires();
        $record = $data->addOrupdate($request, 1);
        return redirect('/admin/userverification/');
    }
    // Delete
    public function destroy($id)
    {
        $questionnary = UserVerificationQuestionnaires::findorfail($id);
        $questionnary->usergroups()->detach();
        $questionnary->delete();

        return redirect('/admin/userverification/');
    }
}
