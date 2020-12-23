<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class SpkController extends Controller
{
    //
    public function index()
    {
        return $this->success([
            'candidates' => User::where('user_type_id', 2)->get()->append(['weight', 'point'])
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'answers'   => 'required',
            'answers.1'   => 'required',
            'answers.2'   => 'required',
            'answers.3'   => 'required',
            'answers.4'   => 'required',
            'answers.5'   => 'required',
        ]);

        $candidate = (object) $request->input('candidate');
        $answers = $request->input('answers');

        foreach ($answers as $key => $value) {
            UserAnswer::updateOrCreate([
                'user_id'       => Auth::id(),
                'candidate_id'  => $candidate->id,
                'question_id'   => $key,
            ], [
                'user_id'       => Auth::id(),
                'candidate_id'  => $candidate->id,
                'question_id'   => $key,
                'weight_id'     => $value
            ]);
        }

        return $this->success([], 'berhasil menyimpan!');
    }

    public function show($id)
    {
        return $this->success([
            'candidate' => User::find($id),
            'questions'  => Question::all(),
            'weights'   => Weight::all(),
        ]);
    }
}
