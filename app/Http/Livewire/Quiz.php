<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Livewire\Component;

class Quiz extends Component
{

    public $quiz;
    public $sort;

    public $error;
    public $message;
    public $message2;
    public $message3;
    public $message4;
    public $message5;
    public $message6;
    public $message7;
    public $message8;
    public $message9;

    public $user_id;

    public $full_name;
    public $age;
    public $phone;
    public $mail;
    public $weight;
    public $length;

    public $values = [];

    public $uyqu = 57;
    public $kayfiyat = 67;
    public $asab = 76;

    public $uyqu_text = 87;
    public $kayfiyat_text = 88;
    public $asab_text = 89;
    protected $listeners = [
        'inputName' => 'input_Name',
        'inputAge' => 'input_Age',
        'inputPhone' => 'input_Phone',
        'inputMail' => 'input_Mail',
        'buttonSelect' => 'button_Select',
        'inputWeight' => 'input_Weight',
        'inputLength' => 'input_Length',
        'inputCheckbox' => 'input_Checkbox',
        'checkboxAdd' => 'checkbox_Add',
        'prevQuiz' => 'prev_Quiz',

    ];

    public function mount()
    {
        $this->sort = 1;
        $this->quiz = Question::where('sort',$this->sort)->first();
    }

    public function prev_Quiz($prev_sort)
    {
        

            if($prev_sort > 8)
            {
                $hist = [];
                $user = User::find($this->user_id);

                    if(in_array($prev_sort,$user->history))
                    {
                        foreach($user->history as $us)
                        {
                            if(intval($prev_sort) != intval($us))
                            {
                                $hist[] = $us;
                            }
                        }
                    }else{
                        foreach($user->history as $us)
                        {

                                $hist[] = $us;
                        }

                    }
                    $user->history = $hist;
                    $user->save();

            }

            // if($prev_sort == $this->uyqu)
            // {
            //     $this->quiz = Question::where('sort',$prev_sort)->first();
            // }elseif($prev_sort == $this->kayfiyat)
            // {
            //     $this->quiz = Question::where('sort',$prev_sort)->first();
            // }
            // elseif($prev_sort == $this->asab)
            // {
            //     $this->quiz = Question::where('sort',$prev_sort)->first();
            // }

            if($prev_sort == 5)
            {
                $question = Question::where('sort',$prev_sort-1)->first();
                $answer = Answer::where('user_id',$this->user_id)->where('question_id',$question->id)->orderBy('id','DESC')->first();
                if($answer->select == 2)
                {
                    $this->quiz = Question::where('sort',$prev_sort-1)->first();

                }else{
                    $this->quiz = Question::where('sort',7)->first();

                }
            }elseif($prev_sort == 7)
            {
                $this->quiz = Question::where('sort',4)->first();
            }
            elseif($prev_sort == 8)
            {
                $this->quiz = Question::where('sort',6)->first();
            }
            else{
                $this->quiz = Question::where('sort',$prev_sort-1)->first();
            }
        
    }

    public function input_Name($next_sort)
    {
            if($this->full_name)
            {
                if($this->user_id)
                {
                    $user = User::find($this->user_id);
                    $user->full_name = $this->full_name;
                    $user->save();
                }else{
                    $user = new User;
                    $user->full_name = $this->full_name;
                    $user->history = [$next_sort-1];
                    $user->save();
                }

                $answer = new Answer();
                $answer->user_id = $user->id;
                $answer->question_id = $this->quiz->id;
                $answer->type = 1;
                $answer->input = $this->full_name;
                $answer->save();

                $this->user_id = $user->id;

                $this->quiz = Question::where('sort',$next_sort)->first();

                $this->error = '';

            }else{
                $this->error = 'Ismni kiriting';
            }
    }
    public function input_Age($next_sort)
    {
            if($this->age)
            {
                if($this->age < 18)
                {
                    $this->error = '18 dan katta yosh kiriting';
                    $this->quiz = Question::where('sort',$next_sort-1)->first();
                }else{

                    $user = User::find($this->user_id);

                    if(in_array($next_sort-1,$user->history))
                    {
                        $user->age = $this->age;
                        $user->save();
                    }else{
                        $user->age = $this->age;
                        $history = $user->history;
                        $history[] = $next_sort-1;
                        $user->history = $history;
                        $user->save();
                    }

                    $answer = new Answer();
                    $answer->user_id = $user->id;
                    $answer->question_id = $this->quiz->id;
                    $answer->type = 1;
                    $answer->input = $this->age;
                    $answer->save();


                    $this->quiz = Question::where('sort',$next_sort)->first();
                    $this->error = '';
                }
            }
            else{
                    $this->error = 'Yoshni kiriting';
            }

    }
    public function input_Phone($next_sort)
    {
        if($this->phone)
        {
            $user = User::find($this->user_id);

            if(in_array($next_sort-1,$user->history))
            {
                $user->email = $this->phone;
                $user->save();
            }else{
                $user->email = $this->phone;
                $history = $user->history;
                $history[] = $next_sort-1;
                $user->history = $history;
                $user->save();
            }

            $answer = new Answer();
            $answer->user_id = $user->id;
            $answer->question_id = $this->quiz->id;
            $answer->type = 1;
            $answer->input = $this->phone;
            $answer->save();

            $this->quiz = Question::with('select','category')->where('sort',$next_sort)->first();
            $this->error = '';
        }
        else{
            $this->error = 'Telefon raqamingizni kiriting';
        }
    }
    public function input_Mail($s)
    {
        if($s == 4)
        {
            if($this->mail)
            {
                if(strpos($this->mail,'@') > 1)
                {
                    $user = User::find($this->user_id);
                    $user->email = $this->mail;
                    $history = $user->history;
                    $history[] = $s-1;
                    $user->history = $history;
                    $user->save();

                    $answer = new Answer();
                    $answer->user_id = $user->id;
                    $answer->question_id = Question::where('sort',$s-1)->first()->id;
                    $answer->type = 1;
                    $answer->input = $this->mail;
                    $answer->save();


                    $this->quiz = Question::with('select','category')->where('sort',$s)->first();
                    $this->error = '';

                }else{
                    $this->error = 'Email pochtangizni kiriting';
                    $this->quiz = Question::where('sort',$s-1)->first();
                }

            }
            else{
                    $this->error = 'Email pochtangizni kiriting';
                    $this->quiz = Question::where('sort',$s-1)->first();
            }
        }

    }

    public function input_Weight($s)
    {
        if($s == 6)
        {
            if($this->weight)
            {

                    $user = User::find($this->user_id);
                    $user->weight = $this->weight;

                    if(!in_array($s-1,$user->history))
                    {
                        $history = $user->history;
                        $history[] = $s-1;
                        $user->history = $history;
                    }else{
                        $history = $user->history;
                        $user->history = $history;
                    }

                    $user->save();

                    $answer = new Answer();
                    $answer->user_id = $user->id;
                    $answer->question_id = Question::where('sort',$s-1)->first()->id;
                    $answer->type = 1;
                    $answer->input = $this->weight;
                    $answer->save();

                    $this->quiz = Question::where('sort',$s)->first();
                    $this->error = '';
            }
            else{
                    $this->error = 'Ogirlikni kiriting';
                    $this->quiz = Question::where('sort',$s-1)->first();
            }
        }

    }

    public function input_Length($s)
    {
        if($s == 7)
        {
            if($this->length)
            {
                    $user = User::find($this->user_id);
                    $user->length = $this->length;
                    if(!in_array($s-1,$user->history))
                    {
                        $history = $user->history;
                        $history[] = $s-1;
                        $user->history = $history;
                    }else{
                        $history = $user->history;
                        $user->history = $history;
                    }

                    $user->save();

                    $answer = new Answer();
                    $answer->user_id = $user->id;
                    $answer->question_id = Question::where('sort',$s-1)->first()->id;
                    $answer->type = 1;
                    $answer->input = $this->length;
                    $answer->save();

                    $s = $this->getSort($history,$s);

                        $this->quiz = Question::where('sort',$s)->first();
                        $this->error = '';
            }
            else{
                    $this->error = 'Ogirlikni kiriting';
                    $this->quiz = Question::where('sort',$s-1)->first();
            }
        }

    }

    public function button_Select($s,$answer)
    {
        

            $max_sort = 86;
            // $max_sort = Question::orderBy('sort','DESC')->first();

            if($max_sort == $s)
            {
                $ques = Question::whereIn('sort',[23,24,25,26,27,28])->pluck('id')->toArray();

                $ans_array = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques)->orderBy('question_id','DESC')->count();

                if($ans_array > 1)
                {
                    $this->message = 'Sizda B12 yetishmovchiligi mavjud.';
                }elseif($ans_array > 3){
                    $this->message = 'Sizda B12 yetishmovchiligi juda yuqori.';
                }else{
                    $this->message = 'Sizda B12 vitaminiga extiyoj yo\'q.';
                }

                $ques2 = Question::whereIn('sort',[29,30,31,32])->pluck('id')->toArray();

                $ans_array2 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques2)->orderBy('question_id','DESC')->count();

                if($ans_array2 > 1)
                {
                    $this->message2 = 'Sizda D vitamini yetishmovchiligi mavjud.';
                }elseif($ans_array2 > 3){
                    $this->message2 = 'Sizda D vitamini yetishmovchiligi juda yuqori.';
                }else{
                    $this->message2 = 'Sizda D vitaminiga extiyoj yo\'q.';
                }

                $ques3 = Question::whereIn('sort',[33,34,35,36,37,38,39])->pluck('id')->toArray();

                $ans_array3 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques3)->orderBy('question_id','DESC')->count();

                if($ans_array3 > 1)
                {
                    $this->message3 = 'Sizda Kaltsiy yetishmovchiligi mavjud.';
                }elseif($ans_array3 > 3){
                    $this->message3 = 'Sizda Kaltsiy yetishmovchiligi juda yuqori.';
                }else{
                    $this->message3 = 'Sizda Kaltsiyga extiyoj yo\'q.';
                }

                $ques4 = Question::whereIn('sort',[40,41,42,43,44,45])->pluck('id')->toArray();

                $ans_array4 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques4)->orderBy('question_id','DESC')->count();

                if($ans_array4 > 1)
                {
                    $this->message4 = 'Sizda Temir moddasiga yetishmovchiligi mavjud.';
                }elseif($ans_array4 > 3){
                    $this->message4 = 'Sizda Temir moddasiga yetishmovchiligi juda yuqori.';
                }else{
                    $this->message4 = 'Sizda Temir moddasiga extiyoj yo\'q.';
                }

                $ques5 = Question::whereIn('sort',[46,47,48,49,50,51])->pluck('id')->toArray();

                $ans_array5 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques5)->orderBy('question_id','DESC')->count();

                if($ans_array5 > 1)
                {
                    $this->message5 = 'Sizda Magneziy yetishmovchiligi mavjud.';
                }elseif($ans_array5 > 3){
                    $this->message5 = 'Sizda Magneziy yetishmovchiligi juda yuqori.';
                }else{
                    $this->message5 = 'Sizda Magneziy extiyoj yo\'q.';
                }


                $ques6 = Question::whereIn('sort',[52,53,54,55,56])->pluck('id')->toArray();

                $ans_array6 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques6)->orderBy('question_id','DESC')->count();

                if($ans_array6 > 1)
                {
                    $this->message6 = 'Sizda Rux moddasiga yetishmovchiligi mavjud.';
                }elseif($ans_array6 > 3){
                    $this->message6 = 'Sizda Rux moddasiga yetishmovchiligi juda yuqori.';
                }else{
                    $this->message6 = 'Sizda Rux moddasiga extiyoj yo\'q.';
                }


                $ques7 = Question::whereIn('sort',[57,58])->pluck('id')->toArray();
                $ques71 = Question::whereIn('sort',[59,60,61])->pluck('id')->toArray();
                $ques72 = Question::whereIn('sort',[62,63,64,65,66])->pluck('id')->toArray();

                $count7 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques7)->orderBy('question_id','DESC')->count();
                $count71 = Answer::where('select',2)->where('user_id',$this->user_id)->whereIn('question_id',$ques71)->orderBy('question_id','DESC')->count();
                $count72 = Answer::where('select',2)->where('user_id',$this->user_id)->whereIn('question_id',$ques72)->orderBy('question_id','DESC')->count();

                if(($count7 + $count71) > 3)
                {
                    $this->message7 = 'Sizda uxlab qolish muammosi mavjud.';
                }elseif($count72 > 3){
                    $this->message7 = 'Toshdek qotib uxlar ekansiz.';
                }else{
                    $this->message7 = 'Sizda uxlash qolib muammosi mavjud emas.';
                }

                $ques8 = Question::whereIn('sort',[67,68,69,70,71,72,73,74,75])->pluck('id')->toArray();

                $count8 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();
                $count81 = Answer::where('select',2)->where('user_id',$this->user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();
                $count82 = Answer::where('select',3)->where('user_id',$this->user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();
                $count83 = Answer::where('select',4)->where('user_id',$this->user_id)->whereIn('question_id',$ques8)->orderBy('question_id','DESC')->count();

                $ball8 = $count8*0 + $count81*1 + $count82*2 + $count83*3;

                if($ball8 <= 4 )
                {
                    $this->message8 = 'Sizni kayfiyatingiz holati oddiy';
                }elseif($ball8 > 4 && $ball8 <= 9){
                    $this->message8 = 'Sizni kayfiyatingiz holati: yengil depressiya';
                }elseif($ball8 > 9 && $ball8 <= 14){
                    $this->message8 = 'Sizni kayfiyatingiz holati: o\'rtacha depressiya';
                }elseif($ball8 > 14 && $ball8 <= 19){
                    $this->message8 = 'Sizni kayfiyatingiz holati: o\'rtacha og\'ir ruhiy tushkunlik';
                }
                else{
                    $this->message8 = 'Sizni kayfiyatingiz holati: jiddiy yoki og’ir depressiya';
                }

                $ques9 = Question::whereIn('sort',[76,77,78,81,84,85])->pluck('id')->toArray();
                $ques91 = Question::whereIn('sort',[79,80,82,83])->pluck('id')->toArray();

                $count9 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count91 = Answer::where('select',2)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count92 = Answer::where('select',3)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count93 = Answer::where('select',4)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count94 = Answer::where('select',5)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();

                $count99 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count991 = Answer::where('select',2)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count992 = Answer::where('select',3)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count993 = Answer::where('select',4)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();
                $count994 = Answer::where('select',5)->where('user_id',$this->user_id)->whereIn('question_id',$ques9)->orderBy('question_id','DESC')->count();

                $ball9 = $count9*0 + $count91*1 + $count92*2 + $count93*3 + $count94*4;
                $ball91 = $count99*4 + $count991*3 + $count992*2 + $count993*1 + $count994*0;
                $uball9 = $ball9 + $ball91;
                if($uball9 <= 13 )
                {
                    $this->message9 = 'Sizda past darajada asabiylik mavjud';
                }elseif($uball9 > 13 && $uball9 <= 26){
                    $this->message9 = 'Sizda o\'rta darajada asabiylik mavjud';
                }
                else{
                    $this->message9 = 'Sizda yuqori darajada asabiylik mavjud';
                }

                $this->quiz = Question::with('select','category')->where('sort',$s)->first();


            }else{
                $question = Question::with('select','category')->where('sort',$s-1)->first();
                $user = User::find($this->user_id);
                if(!in_array($s-1,$user->history))
                    {
                        $history = $user->history;
                        $history[] = $s-1;
                        $user->history = $history;
                        $user->save();
                    }

                $exists_question = Question::where('sort',$s-1)->first();
                $exists_answer = Answer::where('user_id',$this->user_id)->where('question_id',$exists_question->id)->orderBy('id','DESC')->first();

                if($exists_answer)
                    {
                        $exists_answer->select = $answer;
                        $exists_answer->save();
                    }else{
                        $ans = new Answer();
                        $ans->user_id = $this->user_id;
                        $ans->question_id = Question::where('sort',$s-1)->first()->id;
                        $ans->type = 2;
                        $ans->select = $answer;
                        $ans->save();
                    }


                if( ($s-1) == 4)
                {
                    if($answer == 2)
                    {
                        $this->quiz = Question::with('select','category')->where('sort',5)->first();

                    }else{
                        $this->quiz = Question::with('select','category')->where('sort',7)->first();

                    }

                    $userw = User::find($this->user_id);
                    $i = 0;
                    $histot = $user->history;
                        foreach($question->link as $value)
                            {
                                if(!in_array(intval($value),$user->history))
                                {
                                    $histot[] = intval($value);
                                    $i = $i + 1;
                                }
                            }
                                    $userw->history = $histot;
                                    $userw->save();


                }
                elseif(($s-1) == 7)
                {
                    if(in_array($answer,[1,2,3]))
                    {
                        $this->message = 'B12 vitamini xomilador ayollarga mumkin emas.';

                        $this->quiz = Question::with('select','category')->where('sort',$max_sort)->first();

                    }else{
                        $this->quiz = Question::with('select','category')->where('sort',5)->first();
                    }
                }
                elseif($s == $this->uyqu)
                {
                    $this->quiz = Question::where('sort',$this->uyqu_text)->first();
                }elseif($s == $this->kayfiyat)
                {

                    $this->quiz = Question::where('sort',$this->kayfiyat_text)->first();
                }
                elseif($s == $this->asab)
                {

                    $this->quiz = Question::where('sort',$this->asab_text)->first();
                }
                else{
                    if($s == 10)
                    {
                        $this->quiz = Question::with('select','category')->where('sort',10)->first();

                    }else{

                        $s = $this->getSort($user->history,$s);


                        $this->quiz = Question::with('select','category')->where('sort',$s)->first();
                    }


                }
            }
        

    }

    public function input_Checkbox($s)
    {
        if(count($this->values) > 0)
        {
                $user = User::find($this->user_id);
                if(!in_array($s-1,$user->history))
                {
                    $history = $user->history;
                    $history[] = $s-1;
                    $user->history = $history;
                    $user->save();
                }

                $exists_question = Question::where('sort',$s-1)->first();
                $exists_answer = Answer::where('user_id',$this->user_id)->where('question_id',$exists_question->id)->orderBy('id','DESC')->first();

                if($exists_answer)
                    {
                        $exists_answer->checkbox = json_encode($this->values);
                        $exists_answer->save();
                    }else{
                        $answer = new Answer();
                        $answer->user_id = $this->user_id;
                        $answer->question_id = Question::where('sort',$s-1)->first()->id;
                        $answer->type = 3;
                        $answer->checkbox = json_encode($this->values);
                        $answer->save();
                    }

            $this->quiz = Question::where('sort',$s)->first();

        }else{

            $this->error = 'Siz tanlamadingiz';
            $this->quiz = Question::where('sort',$s-1)->first();

        }
    }

    public function checkbox_Add($k)
    {
        if(in_array($k,$this->values))
        {
            $index = array_search($k,$this->values);
            unset($this->values[$index]);
        }else{
            $this->values[] = $k;
            $this->error = '';
        }
    }
    public function getSort($history,$sort)
    {
        $sorts = Question::pluck('sort')->toArray();

        foreach($sorts as $h)
        {
            if(!in_array($h,$history))
            {
                $s = $h;
                break;
            }else{
                $s = $sort;
            }
        }
        return $s;
    }

    public function render()
    {
        return view('livewire.quiz');
    }
}
