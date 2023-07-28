<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function dashboard()
    {
        $users = User::all();
        $answer = [];
        $message = [];
        $message2 = [];
        $message3 = [];
        $message4 = [];
        $message5 = [];
        $message6 = [];
        $message7 = [];
        $message8 = [];
        $message9 = [];
        foreach ($users as $key => $user) {
            $count = Answer::where('user_id',$user->id)->count();
            if($count > 70)
            {
                $user_id = $user->id;

                $answer[$user_id] = Answer::with('question','question.select')->where('user_id',$user->id)->orderBy('question_id','ASC')->get();
                $ques = Question::whereIn('sort',[23,24,25,26,27,28])->pluck('id')->toArray();

                $ans_array = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques)->orderBy('question_id','DESC')->count();

                if($ans_array > 1)
                {
                    $message[$user_id] = 'Sizda B12 yetishmovchiligi mavjud.';
                }elseif($ans_array > 3){
                    $message[$user_id] = 'Sizda B12 yetishmovchiligi juda yuqori.';
                }else{
                    $message[$user_id] = 'Sizda B12 vitaminiga extiyoj yo\'q.';
                }

                $ques2 = Question::whereIn('sort',[29,30,31,32])->pluck('id')->toArray();

                $ans_array2 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques2)->orderBy('question_id','DESC')->count();

                if($ans_array2 > 1)
                {
                    $message2[$user_id] = 'Sizda D vitamini yetishmovchiligi mavjud.';
                }elseif($ans_array2 > 3){
                    $message2[$user_id] = 'Sizda D vitamini yetishmovchiligi juda yuqori.';
                }else{
                    $message2[$user_id] = 'Sizda D vitaminiga extiyoj yo\'q.';
                }

                $ques3 = Question::whereIn('sort',[33,34,35,36,37,38,39])->pluck('id')->toArray();

                $ans_array3 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques3)->orderBy('question_id','DESC')->count();

                if($ans_array3 > 1)
                {
                    $message3[$user_id] = 'Sizda Kaltsiy yetishmovchiligi mavjud.';
                }elseif($ans_array3 > 3){
                    $message3[$user_id] = 'Sizda Kaltsiy yetishmovchiligi juda yuqori.';
                }else{
                    $message3[$user_id] = 'Sizda Kaltsiyga extiyoj yo\'q.';
                }

                $ques4 = Question::whereIn('sort',[40,41,42,43,44,45])->pluck('id')->toArray();

                $ans_array4 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques4)->orderBy('question_id','DESC')->count();

                if($ans_array4 > 1)
                {
                    $message4[$user_id] = 'Sizda Temir moddasiga yetishmovchiligi mavjud.';
                }elseif($ans_array4 > 3){
                    $message4[$user_id] = 'Sizda Temir moddasiga yetishmovchiligi juda yuqori.';
                }else{
                    $message4[$user_id] = 'Sizda Temir moddasiga extiyoj yo\'q.';
                }

                $ques5 = Question::whereIn('sort',[46,47,48,49,50,51])->pluck('id')->toArray();

                $ans_array5 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques5)->orderBy('question_id','DESC')->count();

                if($ans_array5 > 1)
                {
                    $message5[$user_id] = 'Sizda Magneziy yetishmovchiligi mavjud.';
                }elseif($ans_array5 > 3){
                    $message5[$user_id] = 'Sizda Magneziy yetishmovchiligi juda yuqori.';
                }else{
                    $message5[$user_id] = 'Sizda Magneziy extiyoj yo\'q.';
                }


                $ques6 = Question::whereIn('sort',[52,53,54,55,56])->pluck('id')->toArray();

                $ans_array6 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques6)->orderBy('question_id','DESC')->count();

                if($ans_array6 > 1)
                {
                    $message6[$user_id] = 'Sizda Rux moddasiga yetishmovchiligi mavjud.';
                }elseif($ans_array6 > 3){
                    $message6[$user_id] = 'Sizda Rux moddasiga yetishmovchiligi juda yuqori.';
                }else{
                    $message6[$user_id] = 'Sizda Rux moddasiga extiyoj yo\'q.';
                }


                $ques7 = Question::whereIn('sort',[57,58])->pluck('id')->toArray();
                $ques71 = Question::whereIn('sort',[59,60,61])->pluck('id')->toArray();
                $ques72 = Question::whereIn('sort',[62,63,64,65,66])->pluck('id')->toArray();

                $count7 = Answer::where('select',2)->where('user_id',$user_id)->whereIn('question_id',$ques7)->orderBy('question_id','DESC')->count();
                $count71 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques71)->orderBy('question_id','DESC')->count();
                $count72 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques72)->orderBy('question_id','DESC')->count();

                if(($count7 + $count71) > 3)
                {
                    $message7[$user_id] = 'Sizda uxlab qolish muammosi mavjud.';
                }elseif($count72 > 3){
                    $message7[$user_id] = 'Toshdek qotib uxlar ekansiz.';
                }else{
                    $message7[$user_id] = 'Sizda uxlash qolib muammosi mavjud emas.';
                }

                $ques8 = Question::whereIn('sort',[67,68,69,70,71,72,73,74,75])->pluck('id')->toArray();

                $count8 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();
                $count81 = Answer::where('select',2)->where('user_id',$user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();
                $count82 = Answer::where('select',3)->where('user_id',$user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();
                $count83 = Answer::where('select',4)->where('user_id',$user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();

                $ball8 = $count8*0 + $count81*1 + $count82*2 + $count83*3;

                if($ball8 <= 4 )
                {
                    $message8[$user_id] = 'Sizni kayfiyatingiz holati oddiy';
                }elseif($ball8 > 4 && $ball8 <= 9){
                    $message8[$user_id] = 'Sizni kayfiyatingiz holati: yengil depressiya';
                }elseif($ball8 > 9 && $ball8 <= 14){
                    $message8[$user_id] = 'Sizni kayfiyatingiz holati: o\'rtacha depressiya';
                }elseif($ball8 > 14 && $ball8 <= 19){
                    $message8[$user_id] = 'Sizni kayfiyatingiz holati: o\'rtacha og\'ir ruhiy tushkunlik';
                }
                else{
                    $message8 = 'Sizni kayfiyatingiz holati: jiddiy yoki og’ir depressiya';
                }

                $ques9 = Question::whereIn('sort',[76,77,78,81,84,85])->pluck('id')->toArray();
                $ques91 = Question::whereIn('sort',[79,80,82,83])->pluck('id')->toArray();

                $count9 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count91 = Answer::where('select',2)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count92 = Answer::where('select',3)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count93 = Answer::where('select',4)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count94 = Answer::where('select',5)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();

                $count99 = Answer::where('select',1)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count991 = Answer::where('select',2)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count992 = Answer::where('select',3)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count993 = Answer::where('select',4)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count994 = Answer::where('select',5)->where('user_id',$user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();

                $ball9 = $count9*0 + $count91*1 + $count92*2 + $count93*3 + $count94*4;
                $ball91 = $count99*4 + $count991*3 + $count992*2 + $count993*1 + $count994*0;
                $uball9 = $ball9 + $ball91;
                if($uball9 <= 13 )
                {
                    $message9[$user_id] = 'Sizda past darajada asabiylik mavjud';
                }elseif($uball9 > 13 && $uball9 <= 26){
                    $message9[$user_id] = 'Sizda o\'rta darajada asabiylik mavjud';
                }
                else{
                    $message9[$user_id] = 'Sizda yuqori darajada asabiylik mavjud';
                }
            }
        }

                

        return view('admin.pages.dashboard',compact('answer','message','message2','message3','message4','message5','message6','message7','message8','message9'));
    }
}
