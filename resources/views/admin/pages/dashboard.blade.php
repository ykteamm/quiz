@extends('admin.layouts.app')
@section('admin_content')
<style>
    .bd{
        background: #0029ff;
        padding: 1px 10px;
        color: white;
    }
</style>
    <div class="dashboard__content bg-light-4">
        <div class="row pb-50 mb-10">
            <div class="col-auto">
                @foreach ($answer as $k => $ans)

                    <ul>
                        @foreach ($ans as $item)

                            @if ($item->type == 1)
                            <li>

                                <div class="row">
                                    <div class="col-md-8">
                                        {{$item->question->sort}}) {{$item->question->question}} 

                                    </div>
                                    <div class="col-md-4">
                                        <span class="badge badge-primary bd" >{{$item->input}}</span>  

                                    </div>
                                </div>
                                <hr>
                            </li>
                                
                            @endif
                            @if ($item->type == 2)
                                <li>
                                    <div class="row">
                                        <div class="col-md-8">
                                            {{$item->question->sort}}) {{$item->question->question}} 

                                        </div>
                                        <div class="col-md-4">
                                            <span class="badge badge-primary bd" >{{$item->question->select->questions[$item->select]}}</span>  

                                        </div>
                                    </div>
                                <hr>
                                    
                                </li>
                                
                            @endif
                            @if ($item->type == 3)
                                <li>
                                    


                                    <div class="row">
                                        <div class="col-md-8">
                                            {{$item->question->sort}}) {{$item->question->question}} 
    
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $js = json_decode($item->checkbox);
                                            @endphp
                                            @foreach ($js as $s)
                                            <span class="badge badge-primary bd" >{{$item->question->select->questions[$s]}}</span> 
                                            @endforeach
    
                                        </div>
                                    </div>
                                <hr>

                                </li>
                                
                            @endif

                                

                        @endforeach

                    </ul>

                    <div class="text-center">
                        {{$message[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message2[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message3[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message4[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message5[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message6[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message7[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message8[$k]}}
                    </div>
                    <div class="text-center">
                        {{$message9[$k]}}
                    </div>

                @endforeach


            </div>
        </div>


        

    </div>
@endsection
@section('admin_script')
@endsection
