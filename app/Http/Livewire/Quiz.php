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

    public $user_id;

    public $full_name;
    public $age;
    public $phone;
    public $mail;
    public $weight;
    public $length;

    public $values = [];

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
        $max_sort = Question::orderBy('sort','DESC')->first();

        if($max_sort->sort == $s)
        {
            $ques = Question::whereIn('sort',[23,24,25,26,27,28])->pluck('id')->toArray();

            $ans_array = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques)->orderBy('question_id','DESC')->count();

            if($ans_array > 1)
            {
                $this->message = 'Sizda B12 yetishmovchiligi mavjud.';
            }elseif($ans_array > 3){
                $this->message = 'Sizda B12 yetishmovchiligi juda yuqori.';
            }else{
                $this->message = 'Sizda B12 vitaminiga extiyoj kam.';
            }

            $ques2 = Question::whereIn('sort',[29,30,31,32])->pluck('id')->toArray();

            $ans_array2 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques2)->orderBy('question_id','DESC')->count();

            if($ans_array2 > 1)
            {
                $this->message2 = 'Sizda D vitamini yetishmovchiligi mavjud.';
            }elseif($ans_array2 > 3){
                $this->message2 = 'Sizda D vitamini yetishmovchiligi juda yuqori.';
            }else{
                $this->message2 = 'Sizda D vitaminiga extiyoj kam.';
            }

            $ques3 = Question::whereIn('sort',[36,37,38,39,40,41,42])->pluck('id')->toArray();

            $ans_array3 = Answer::where('select',1)->where('user_id',$this->user_id)->whereIn('question_id',$ques3)->orderBy('question_id','DESC')->count();

            if($ans_array3 > 1)
            {
                $this->message3 = 'Sizda Kaltsiy yetishmovchiligi mavjud.';
            }elseif($ans_array3 > 3){
                $this->message3 = 'Sizda Kaltsiy yetishmovchiligi juda yuqori.';
            }else{
                $this->message3 = 'Sizda Kaltsiyga extiyoj kam.';
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
                        // if($i > 1)
                        //     {
                                $userw->history = $histot;
                                $userw->save();
                            // }


            }
            elseif(($s-1) == 7)
            {
                if(in_array($answer,[1,2,3]))
                {
                    $this->message = 'B12 vitamini xomilador ayollarga mumkin emas.';

                    $this->quiz = Question::with('select','category')->where('sort',$max_sort->sort)->first();

                }else{
                    $this->quiz = Question::with('select','category')->where('sort',5)->first();
                }
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
