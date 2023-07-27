<div>
    <header data-add-bg="" class="header -type-3 js-header">


        <div class="header__container py-10">
            <div class="row justify-between items-center">

                <div class="col-auto">
                    <div class="header-left d-flex items-center">

                        @if ($quiz->sort != 1)
                            <div class="header__logo">
                                <span style="color: black;font-size: 14px;cursor:pointer;"
                                    wire:click="$emit('prevQuiz',{{ $quiz->sort }})">
                                    OLDINGISI
                                </span>
                            </div>
                        @endif



                    </div>
                </div>


                <div class="col-auto m-auto">
                    <div class="header-right d-flex items-center">
                        <div class="header-right__icons text-white d-flex items-center">

                            <div class="header-menu js-mobile-menu-toggle ">
                                <div class="header-menu__content">
                                    <div class="mobile-bg js-mobile-bg"></div>



                                    <div class="menu js-navList">
                                        <span class="text-dark-1 mr-90"
                                            style="color: black;font-size: 42px;">NOVATIO</span>
                                    </div>
                                </div>

                                <div class="header-menu-close" data-el-toggle=".js-mobile-menu-toggle">
                                    <div class="size-40 d-flex items-center justify-center rounded-full bg-white">
                                        <div class="icon-close text-dark-1 text-16"></div>
                                    </div>
                                </div>

                                <div class="header-menu-bg"></div>
                            </div>





                            <div class="d-none xl:d-block ml-20">
                                <div class="menu js-navList">
                                    <span class="text-dark-1 mr-90" style="color: black;font-size: 42px;">NOVATIO</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>


    <div class="content-wrapper  js-content-wrapper">


        <section class="layout-pt-lg layout-pb-lg section-bg">
            <div class="section-bg__item bg-light-6"></div>
            <div class="container">

                @if ($quiz->category_id == 1)
                    @if ($quiz->sort == 86)
                        <div class="row y-gap-20 justify-center text-center mt-20">
                            <div class="col-auto">

                                <div class="sectionTitle ">

                                    <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        Hurmatli {{ $full_name }} </h4>
                                </div>

                            </div>

                        </div>
                        <div class="row y-gap-20 justify-center text-center mt-20">
                            <div class="col-auto">

                                <div class="sectionTitle ">

                                    <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $message }} </h4>
                                    <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $message2 }} </h4>
                                        <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $message3 }} </h4>
                                        <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $message4 }} </h4>
                                        <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $message5 }} </h4>
                                        <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $message6 }} </h4>
                                        <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $message7 }} </h4>
                                </div>

                            </div>

                        </div>
                    {{-- @else
                        <div class="row y-gap-20 justify-center text-center mt-20">
                            <div class="col-auto">

                                <div class="sectionTitle ">

                                    <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $quiz->question }} </h4>


                                </div>

                            </div>

                        </div> --}}
                    @endif
                    @if ($quiz->sort == 1)
                        <div class="row y-gap-20 justify-center text-center">

                            <div class="col-auto" style="width:60%;">
                                <input class="button -md text-purple-1" wire:model="full_name"
                                    style="background: #ffffff;color:#204f59;width:100%;border:none;" autofocus
                                    type="text" @if ($full_name) value="{{ $full_name }}" @endif>
                            </div>
                            <span>{{ $error }}</span>
                        </div>

                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('inputName',{{ $quiz->sort + 1 }})">
                                    Saqlash
                                </button>
                            </div>
                        </div>
                    @elseif ($quiz->sort == 2)
                        <div class="row y-gap-20 justify-center text-center">

                            <div class="col-auto" style="width:60%;">
                                <input class="button -md text-purple-1" wire:model="age"
                                    style="background: #ffffff;color:#204f59;width:100%;border:none;" autofocus
                                    type="number">
                            </div>
                            <span>{{ $error }}</span>

                        </div>

                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('inputAge',{{ $quiz->sort + 1 }})">
                                    Saqlash
                                </button>
                            </div>
                        </div>
                    @elseif ($quiz->sort == 3)
                        <div class="row y-gap-20 justify-center text-center">

                            <div class="col-auto" style="width:60%;">
                                <input class="button -md text-purple-1" wire:model="phone"
                                    style="background: #ffffff;color:#204f59;width:100%;border:none;" autofocus
                                    type="text" id="phone" placeholder="(99) 999-99-99" onkeyup="myPhone()">
                            </div>
                            <span>{{ $error }}</span>

                        </div>

                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('inputPhone',{{ $quiz->sort + 1 }})">
                                    Saqlash
                                </button>
                            </div>
                        </div>
                    @elseif ($quiz->sort == 5)
                        <div class="row y-gap-20 justify-center text-center">

                            <div class="col-auto" style="width:60%;">
                                <input class="button -md text-purple-1" wire:model="weight"
                                    style="background: #ffffff;color:#204f59;width:100%;border:none;" autofocus
                                    type="number">
                            </div>
                            <span>{{ $error }}</span>

                        </div>

                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('inputWeight',{{ $quiz->sort + 1 }})">
                                    Saqlash
                                </button>
                            </div>
                        </div>
                    @elseif ($quiz->sort == 6)
                        <div class="row y-gap-20 justify-center text-center">

                            <div class="col-auto" style="width:60%;">
                                <input class="button -md text-purple-1" wire:model="length"
                                    style="background: #ffffff;color:#204f59;width:100%;border:none;" autofocus
                                    type="number">
                            </div>
                            <span>{{ $error }}</span>

                        </div>

                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('inputLength',{{ $quiz->sort + 1 }})">
                                    Saqlash
                                </button>
                            </div>
                        </div>
                    @elseif ($quiz->sort == $uyqu_text)
                        <div class="row y-gap-20 justify-center text-center mt-20">
                            <div class="col-auto">
                                <div class="sectionTitle ">
                                    <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $quiz->question }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('prevQuiz',{{ $uyqu }})">
                                    Davom etish
                                </button>
                            </div>
                        </div>
                    @elseif ($quiz->sort == $kayfiyat_text)
                        <div class="row y-gap-20 justify-center text-center mt-20">
                            <div class="col-auto">
                                <div class="sectionTitle ">
                                    <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $quiz->question }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('prevQuiz',{{ $kayfiyat }})">
                                    Davom etish
                                </button>
                            </div>
                        </div>
                    @elseif ($quiz->sort == $asab_text)
                        <div class="row y-gap-20 justify-center text-center mt-20">
                            <div class="col-auto">
                                <div class="sectionTitle ">
                                    <h4 class=""
                                        style="text-transform: uppercase;
                                    font-size: 3rem;
                                    line-height: 2.8125rem;
                                    color: #1d4d57;
                                    ">
                                        {{ $quiz->question }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row y-gap-20 justify-center text-center mt-90">

                            <div class="col-auto" style="width:30%;">
                                <button type="button" class="button -md text-purple-1"
                                    style="background: #565aff;color:white;width:100%;"
                                    wire:click="$emit('prevQuiz',{{ $asab }})">
                                    Davom etish
                                </button>
                            </div>
                        </div>
                    @endif
                @elseif($quiz->category_id == 2)
                    <div class="row y-gap-20 justify-center text-center mt-20">
                        <div class="col-auto">

                            <div class="sectionTitle ">

                                <h4 class=""
                                    style="text-transform: uppercase;
                                font-size: 3rem;
                                line-height: 2.8125rem;
                                color: #1d4d57;
                                ">
                                    {{ $quiz->question }} </h4>


                            </div>

                        </div>

                    </div>
                    @foreach ($quiz->select->questions as $key => $q)
                        <div class="row y-gap-20 justify-center text-center">
                            <div class="col-auto" style="width:60%;">
                                <button class="button -md text-purple-1 allbutton"
                                    style="background: #ffffff;color:#204f59;width:100%;"
                                    wire:click="$emit('buttonSelect',{{ $quiz->sort + 1 }},{{ $key }})">
                                    {{ $q }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row y-gap-20 justify-center text-center mt-20">
                        <div class="col-auto">

                            <div class="sectionTitle ">

                                <h4 class=""
                                    style="text-transform: uppercase;
                                font-size: 3rem;
                                line-height: 2.8125rem;
                                color: #1d4d57;
                                ">
                                    {{ $quiz->question }} </h4>


                            </div>

                        </div>

                    </div>
                    @foreach ($quiz->select->questions as $key => $q)
                        <div class="row y-gap-20 justify-center text-center">
                            <div class="col-auto" style="width:60%;">
                                <button wire:click="$emit('checkboxAdd',{{ $key }})"
                                    class="button -md text-purple-1 allbutton"
                                    style="background: #ffffff;
                                @if (in_array($key, $values)) background:#204f59;
                                color:white;
                                @else
                                background:white;
                                color:#204f59; @endif
                                width:100%;"
                                    onclick="check(`check{{ $key }}`,`checks{{ $key }}`)"
                                    id="checks{{ $key }}">
                                    {{-- <div class="row">
                                    <div class="col-2">

                                    </div>
                                    <div class="col-10">

                                    </div>
                                </div> --}}
                                    <input type="checkbox" value="{{ $q }}"
                                        style="margin-left: -30%;margin-right: 30%;display:none;"
                                        id="check{{ $key }}">

                                    {{ $q }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                    <div class="row y-gap-20 justify-center text-center mt-90">
                        <span>{{ $error }}</span>

                        <div class="col-auto" style="width:30%;">
                            <button type="button" class="button -md text-purple-1"
                                style="background: #565aff;color:white;width:100%;"
                                wire:click="$emit('inputCheckbox',{{ $quiz->sort + 1 }})">
                                Saqlash
                            </button>
                        </div>
                    </div>
                    <script>
                        function check(id, bid) {
                            var box = document.getElementById(id);
                            var button = document.getElementById(bid);

                            if (box.checked == true) {
                                button.style.backgroundColor = 'white';
                                button.style.color = '#204f59';
                                box.checked = false
                            } else {
                                button.style.backgroundColor = '#204f59';
                                button.style.color = 'white';
                                box.checked = true
                            }

                        }
                    </script>
                @endif

            </div>

        </section>



    </div>
</div>
