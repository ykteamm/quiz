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

    public $user_id;

    public $full_name;
    public $age;
    public $mail;
    public $weight;
    public $length;

    public $values = [];

    protected $listeners = [
        'inputName' => 'input_Name',
        'inputAge' => 'input_Age',
        'inputMail' => 'input_Mail',
        'buttonSelect' => 'button_Select',
        'inputWeight' => 'input_Weight',
        'inputLength' => 'input_Length',
        'inputCheckbox' => 'input_Checkbox',
        'checkboxAdd' => 'checkbox_Add'
    ];

    public function mount()
    {
        $this->sort = 1;
        $this->quiz = Question::where('sort',$this->sort)->first();
    }

    public function input_Name($s)
    {
        if($s == 2)
        {
            if($this->full_name)
            {
                $user = new User;
                $user->full_name = $this->full_name;
                $user->history = [$s-1];
                $user->save();

                $answer = new Answer();
                $answer->user_id = $user->id;
                $answer->question_id = Question::where('sort',$s-1)->first()->id;
                $answer->type = 1;
                $answer->input = $this->full_name;
                $answer->save();

                $this->user_id = $user->id;

                $this->quiz = Question::where('sort',$s)->first();

                $this->error = '';

            }else{
                $this->error = 'Ismni kiriting';
                $this->quiz = Question::where('sort',$s-1)->first();
            }
        }

    }

    public function input_Age($s)
    {
        if($s == 3)
        {
            if($this->age)
            {
                if($this->age < 18)
                {
                    $this->error = '18 dan katta yosh kiriting';
                    $this->quiz = Question::where('sort',$s-1)->first();
                }else{
                    $user = User::find($this->user_id);

                    $user->age = $this->age;
                    $history = $user->history;
                    $history[] = $s-1;
                    $user->history = $history;
                    $user->save();

                    $answer = new Answer();
                    $answer->user_id = $user->id;
                    $answer->question_id = Question::where('sort',$s-1)->first()->id;
                    $answer->type = 1;
                    $answer->input = $this->age;
                    $answer->save();


                    $this->quiz = Question::where('sort',$s)->first();
                    $this->error = '';
                }
            }
            else{
                    $this->error = 'Yoshni kiriting';
                    $this->quiz = Question::where('sort',$s-1)->first();
            }
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
                    $history = $user->history;
                    $history[] = $s-1;
                    $user->history = $history;
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
                    $history = $user->history;
                    $history[] = $s-1;
                    $user->history = $history;
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
            $ans_array = Answer::where('select',1)->where('user_id',$this->user_id)->orderBy('question_id','DESC')->limit(5)->count();
            if($ans_array > 1)
            {
                $this->message = 'Sizda B12 yetishmovchiligi mavjud.';
            }elseif($ans_array > 3){
                $this->message = 'Sizda B12 yetishmovchiligi juda yuqori.';
            }else{
                $this->message = 'Sizda B12 vitaminiga extiyoj kam.';
            }

            $this->quiz = Question::with('select','category')->where('sort',$s)->first();

        }else{
            $question = Question::with('select','category')->where('sort',$s-1)->first();
            $user = User::find($this->user_id);
            $history = $user->history;
            $history[] = $s-1;
            $user->history = $history;
            $user->save();

            $ans = new Answer();
            $ans->user_id = $this->user_id;
            $ans->question_id = Question::where('sort',$s-1)->first()->id;
            $ans->type = 2;
            $ans->select = $answer;
            $ans->save();

            if( ($s-1) == 4)
            {
                if($answer == 2)
                {
                    $this->quiz = Question::with('select','category')->where('sort',5)->first();

                }else{
                    $this->quiz = Question::with('select','category')->where('sort',7)->first();

                }
                    foreach($question->link as $value)
                        {
                            $history[] = intval($value);
                        }
                        // $history[] = $s-1;
                        $user->history = $history;
                        $user->save();
            }elseif(($s-1) == 7)
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
                $s = $this->getSort($user->history,$s);
                    $this->quiz = Question::with('select','category')->where('sort',$s)->first();

            }
        }


            // if($question->link != null)
            // {
            //     if(isset($question->link[$answer]))
            //     {
            //         $this->quiz = Question::with('select','category')->where('sort',$question->link[$answer])->first();

            //     }else{
            //         $this->quiz = Question::with('select','category')->where('sort',$s)->first();
            //     }
            //         foreach($question->link as $value)
            //         {
            //             $history[] = intval($value);
            //         }
            //         // $history[] = $s-1;
            //         $user->history = $history;
            //         $user->save();
            // }else{
            //     $this->quiz = Question::with('select','category')->where('sort',$s)->first();
            // }
    }

    public function input_Checkbox($s)
    {
        if(count($this->values) > 0)
        {
                $user = User::find($this->user_id);
                $history = $user->history;
                $history[] = $s-1;
                $user->history = $history;
                $user->save();

                $answer = new Answer();
                $answer->user_id = $this->user_id;
                $answer->question_id = Question::where('sort',$s-1)->first()->id;
                $answer->type = 3;
                $answer->checkbox = json_encode($this->values);
                $answer->save();

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
