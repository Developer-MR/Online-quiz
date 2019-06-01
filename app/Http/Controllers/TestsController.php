<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        session()->forget('next_question_id');
        return view('tests.view', compact('topics'));
    }
     public function getStartTest($id){
      
        $topic = Topic::find($id);
        $questions = $topic->questions()->get();
        //dd($questions);
        $first_question_id = $topic->questions()->min('id');
        //dd($first_question_id);
        $last_question_id = $topic->questions()->max('id');
        // dd($last_question_id);
        $duration = $topic->duration;
        //dd(session('next_question_id'));
        if(session('next_question_id')){
            $current_question_id = session('next_question_id');
        }
        else{
            $current_question_id = $first_question_id;
            session(['next_question_id'=>$current_question_id]);
        }
        //dd($questions);
       // return view('subject.test', compact('topic', 'questions', 'current_question_id', 'first_question_id', 'last_question_id', 'duration'));

        return view('tests.create', compact('topic','questions', 'current_question_id', 'first_question_id', 'last_question_id', 'duration'));
     }
    // public function index()
    // {
    //     // $topics = Topic::inRandomOrder()->limit(10)->get();

    //     $questions = Question::inRandomOrder()->limit(10)->get();
    //     foreach ($questions as &$question) {
    //         $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
    //     }

    //     /*
    //     foreach ($topics as $topic) {
    //         if ($topic->questions->count()) {
    //             $questions[$topic->id]['topic'] = $topic->title;
    //             $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
    //             shuffle($questions[$topic->id]['questions']['options']);
    //         }
    //     }
    //     */

    //     return view('tests.create', compact('questions'));
    // }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postSaveQuestionResult($id, Request $req){
        //save result
       // $result = 0;
        // return $request->topic_id;
        //   $test = Test::create([
        //       'user_id' => Auth::id(),
        //       'result'  => $result,
        //   ]);
          $topic = Topic::find($id);
         // $question = Question::find($req->get('question_id'));

         
              $status = 0;
  
              if ($req->input('answers') != null
                  && QuestionsOption::find($req->input('answers'))->correct
              ) {
                  $status = 1;
                 // $result++;
              }
              TestAnswer::create([
                  'user_id'     => Auth::id(),
                //   'test_id'     => $test->id,
                  'topic_id'     => $req->topic_id,
                  'question_id' => $req->get('question_id'),
                  'option_id'   => $req->input('answers'),
                  'correct'     => $status,
              ]);
        
        $next_question_id = $topic->questions()->where('id','>',$req->get('question_id'))->min('id');
        if($next_question_id != null) {
            return Response::json(['next_question_id' => $next_question_id]);

        }
        return redirect()->route('result',[$id]);
    }

    public function store(Request $request)
    {
        $result = 0;
      // return $request->topic_id;
        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;
          //dd($question);
            if ($request->input('answers.'.$question) != null
                && QuestionsOption::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test->id,
                'topic_id'     => $request->topic_id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.'.$question),
                'correct'     => $status,
            ]);
        }

        $test->update(['result' => $result]);

        return redirect()->route('results.show', [$test->id]);
    }
}
