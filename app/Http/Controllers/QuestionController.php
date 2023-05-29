<?php

namespace App\Http\Controllers;

use App\Models\CategoryQuestion;
use App\Models\Question;
use App\Models\SelectQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $category = CategoryQuestion::all();

        $questions = Question::all();

        return view('admin.pages.question.index',[
            'category' => $category,
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        if($request->category_id == 1)
        {
            $new = new Question($request->all());
            $new->save();
        }else{
            $question = new Question;
            $question->category_id = $request->category_id;
            $question->question = $request->question;
            $question->sort = $request->sort;
            $question->save();

            $array = [];

            foreach($request->questions as $key => $item)
            {
                if($item != null)
                {
                    $val = $key+1;
                    $array[$val] = $item;
                }

            }

            $json = json_encode($array);

            $new = new SelectQuestion;
            $new->question_id = $question->id;
            $new->questions = $json;
            $new->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $question = Question::with('select','category')->find($id);

        $sorts = Question::where('id','!=',$id)->pluck('sort')->toArray();


        // return $question;
        return view('admin.pages.question.edit',[
            'question' => $question,
            'sorts' => $sorts,
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;

        $json = json_encode($request->category_ids);

        $question = Question::find($id);
        $question->link = $json;
        $question->save();

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
