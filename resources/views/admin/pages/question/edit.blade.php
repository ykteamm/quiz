@extends('admin.layouts.app')
@section('admin_content')
    <div class="dashboard__content bg-light-4">
        <div class="row pb-50 mb-10">
            <div class="col-auto">

                <h1 class="text-30 lh-12 fw-700">Create New Course</h1>
                <div class="mt-10">Lorem ipsum dolor sit amet, consectetur.</div>

            </div>
        </div>


        <div class="row y-gap-60">
            <div class="col-12">
                <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex items-center py-20 px-30 border-bottom-light">
                        <h2 class="text-17 lh-1 fw-500">Basic Information</h2>
                    </div>

                    <div class="py-30 px-30">
                        <form class="contact-form row y-gap-30" action="{{route('question.update',$question->id)}}" method="POST">
                            @csrf
                            {{-- {{method('put')}} --}}
                            {{ method_field('PUT') }}
                            <div class="col-12">

                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Savol nomi</label>

                                <input type="text" name="question" value="{{$question->question}}">
                            </div>

                            <div class="col-12">

                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Savol o'rni</label>

                                <input type="number" name="sort" value="{{$question->sort}}">
                            </div>

                            <div class="col-12">

                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Savol type</label>

                                <input type="text" name="category" value="{{$question->category->category}}">
                            </div>

                            <div class="col-12">

                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10 mt-40">Savol type</label>
                                <div class="form-select">
                                    <select class="selectize wide js-selectize-seachable" name="category_id">
                                        {{-- @isset($category) --}}
                                            {{-- @foreach ($category as $item) --}}
                                                <option value="{{ $question->category_id }}">{{ $question->category->category }}</option>
                                            {{-- @endforeach --}}
                                        {{-- @endisset --}}
                                    </select>
                                </div>
                            </div>
                            <div style="margin-bottom: 300px;">
                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Savol nomi</label>
                                @foreach ($question->select->questions as $key => $item)
                                <div class="col-12 mb-10">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="questions[]" value="{{$item}}">
                                        </div>
                                        <div class="col-4">

                                            {{-- <label class="text-16 lh-1 fw-500 text-dark-1 mb-10 mt-40">Savol type</label> --}}
                                            <div class="form-select">
                                                <select class="selectize  js-selectize-seachable" name="category_ids[{{$key}}]">
                                                    <option value="" disabled selected></option>
                                                    @isset($sorts)
                                                        @foreach ($sorts as $item)
                                                            <option value="{{ $item }}">{{ $item }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                        <div class="row y-gap-20 justify-content-end pt-15">
                            {{-- <div class="col-auto">
                                <button class="button -md -outline-purple-1 text-purple-1">Prev</button>
                            </div> --}}

                            <div class="col-auto">
                                <button type="submit" class="button -md -purple-1 text-white">Next</button>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('admin_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        function getType(sel) {
            var type = sel.value;
            if(type == 1)
            {
                $('.selecttype').addClass('d-none')
            }else{
                $('.selecttype').removeClass('d-none')

            }
        }
    </script>
@endsection
