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
                        <form class="contact-form row y-gap-30" action="{{route('question.store')}}" method="POST">
                            @csrf
                            <div class="col-12">

                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Savol nomi</label>

                                <input type="text" name="question">
                            </div>

                            <div class="col-12">

                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Savol o'rni</label>

                                <input type="number" name="sort">
                            </div>

                            <div class="col-12">

                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10 mt-40">Savol type</label>
                                <div class="form-select">
                                    <select class="selectize wide js-selectize-seachable" onchange="getType(this);" name="category_id">
                                        @isset($category)
                                            @foreach ($category as $item)
                                                <option value="{{ $item->type }}">{{ $item->category }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="selecttype d-none">
                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Savol nomi</label>

                                @for ($i = 0; $i < 7; $i++)
                                <div class="col-12 mb-10">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="questions[]">
                                        </div>
                                        <div class="col-4 pt-20">
                                            <div class="form-radio d-flex items-center ">
                                                <div class="radio">
                                                    <input type="radio" name="answer">
                                                    <div class="radio__mark">
                                                        <div class="radio__icon"></div>
                                                    </div>
                                                </div>
                                                {{-- <div class="lh-1 text-14 text-dark-1 ml-12">Javob</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
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
            <div class="col-12">
                <div class="text-18 lh-1 text-dark-1 fw-500 mb-30">Table</div>
                <table class="table w-1/1">
                  <thead>
                    <tr>
                      <th>Nomi</th>
                      <th>Sort</th>
                      <th>Harakat</th>
                    </tr>
                  </thead>
                  <tbody>

                    @isset($questions)
                        @foreach ($questions as $item)
                            <tr>
                                <td>{{$item->question}}</td>
                                <td>{{$item->sort}}</td>
                                <td>
                                    @if ($item->category_id != 1)
                                        <a href="{{route('question.edit',$item->id)}}"> <span class="badge badge-primary">edit</span> </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endisset



                  </tbody>
                </table>
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
