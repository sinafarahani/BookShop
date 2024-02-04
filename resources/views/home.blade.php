<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        <style>
            .checked {
                color: orange;
            }
            .rating {
                display: inline-block;
                position: relative;
                height: 50px;
                line-height: 50px;
            }

            .rating label {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                cursor: pointer;
            }

            .rating label:last-child {
                position: static;
            }

            .rating label:nth-child(1) {
                z-index: 10;
            }

            .rating label:nth-child(2) {
                z-index: 9;
            }

            .rating label:nth-child(3) {
                z-index: 8;
            }

            .rating label:nth-child(4) {
                z-index: 7;
            }

            .rating label:nth-child(5) {
                z-index: 6;
            }
            .rating label:nth-child(6) {
                z-index: 5;
            }

            .rating label:nth-child(7) {
                z-index: 4;
            }

            .rating label:nth-child(8) {
                z-index: 3;
            }

            .rating label:nth-child(9) {
                z-index: 2;
            }

            .rating label:nth-child(10) {
                z-index: 1;
            }

            .rating label input {
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0;
            }

            .rating label .icon {
                float: left;
                color: transparent;
            }

            .rating label:last-child .icon {
                color: #000;
            }

            .rating:not(:hover) label input:checked ~ .icon,
            .rating:hover label:hover input ~ .icon {
                color: #09f;
            }

            .rating label input:focus:not(:checked) ~ .icon:last-child {
                color: #000;
                text-shadow: 0 0 5px #09f;
            }
        </style>
    </head>
    <body class="antialiased">
    <script type="text/javascript">
        var OrderNumber = 1;
        function set(){
            document.getElementById('OrderNumber').innerHTML = OrderNumber;
            document.getElementById('number').value = OrderNumber;
        }
        function inc(){
            OrderNumber++;
            set();
        }function dec(){
            OrderNumber--;
            if(OrderNumber < 1){
                OrderNumber = 1;
            }
            set();
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
        <nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white dark:bg-gray-800 border-b-2 border-collapse border-gray-100 dark:border-gray-600 w-full">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="flex justify-between h-16 w-full space-x-4">
                    <div class="flex w-full space-x-8">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                        </div>

                            <form class="w-full" action="/" autocomplete="off" method="GET" role="search">
                                <label for="query" class=" text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="relative h-full w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="search" id="query" name="query" class="block w-full h-full p-4 ps-10 text-sm text-gray-900 border-1 border-collapse bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-900 dark:focus:border-blue-900" placeholder="Search" required>
                                    <button type="submit" class="text-white absolute end-2.5 bottom-3.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                </div>
                            </form>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex justify-end">
                            @if (Route::has('login'))
                                @auth
                                @else
                                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                        {{ __('Login') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                        {{ __('Register') }}
                                    </x-nav-link>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @auth
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>
                                        <img class="object-cover rounded-full min-w-10 min-h-10 size-10 text-white flex justify-center text-2xl font-light text-center border border-gray-700 items-center bg-blue-950" src="{{ "/storage/avatars/" . Auth::user()->name }}" alt="{{substr(Auth::user()->name, 0, 1)}}">
                                    </div>

                                    <div class="ml-2">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div>
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                                @endauth
                            </x-slot>

                            <x-slot name="content">
                                @auth
                                    <x-dropdown-link :href="route('dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                @endauth
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </nav>
    <div class="min-h-screen bg-dots-darker bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

<section>
    @if(isset($insideBook))
        <div class="relative sm:p-6 lg:p-8 text-left text-xl text-white">
            <div class="sm:grid lg:grid-cols-2 gap-10 justify-evenly items-center">
                <img class="m-auto shadow-2xl shadow-gray-500 rounded-2xl w-5/6 xl:w-3/5" src="{{ "/storage/images/" . $books->id }}" alt="">
                <div class="border-0">
                <table class="shadow-2xl shadow-black sm:rounded-xl m-auto w-full sm:max-w-screen-md">
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Title: ')}}</th>
                    <td>{{$books->title}}</td>
                </tr>
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Author:')}}</th>
                    <td>{{$books->author}}</td>
                </tr>
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Language:')}}</th>
                    <td>{{$books->language}}</td>
                </tr>
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Category:')}}</th>
                    <td>{{$books->category}}</td>
                </tr>
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Available:')}}</th>
                    <td>{{$books->available}}</td>
                </tr>
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Publisher:')}}</th>
                    <td>@if(is_null($books->publisher)) {{__('____')}} @endif{{$books->publisher}}</td>
                </tr>
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Publication:')}}</th>
                    <td>@if(is_null($books->Publication)) {{__('____')}} @endif{{$books->Publication}}</td>
                </tr>
                <tr>
                    <th class="p-7 lg:p-5 xl:p-7 sm:px-20 lg:px-20 xl:px-20">{{__('Description:')}}</th>
                    <td>@if(is_null($books->description)) {{__('____')}} @endif{{$books->description}}</td>
                </tr>

                </table>

                    <div class="bg-gray-800 sm:rounded-xl m-auto w-full max-w-screen-md">
                        <form method="post" action="{{ route('orderRequestOrCommentUpdate') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <input id="id" name="id" type="hidden" value="{{$insideBook}}">
                            <div class="p-6 flex gap-4 justify-between items-center text-base lg:text-base md:text-xl xl:text-xl">
                                <div class="flex items-center">
                                    {{__('Price: $')}}{{$books->price}}
                                </div>
                                <div class="flex gap-4 items-center">
                                    {{__('Number Of Order: ')}}
                                    <button class="border border-transparent bg-gray-500 rounded-full min-w-8 min-h-8 size-8 text-2xl text-white text-center transition ease-in-out duration-150 hover:bg-gray-400 active:bg-gray-600 focus:ring-gray-400" type="button" onclick="dec()">-</button>
                                    <div id="OrderNumber" class="w-fit"><script type="text/javascript">set();</script></div>
                                    <input id="number" name="number" type="hidden"><script type="text/javascript">set();</script>
                                    <button class="border border-transparent bg-gray-500 rounded-full min-w-8 min-h-8 size-8 text-2xl text-white text-center transition ease-in-out duration-150 hover:bg-gray-400 active:bg-gray-600 focus:ring-gray-400" type="button" onclick="inc()">+</button>
                                    <x-input-error class="mt-2" :messages="$errors->get('number')" />
                                </div>
                                <div>
                                    <button type="submit" class="h-fit w-fit inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-blue-500 hover:bg-blue-400 active:bg-blue-600 focus:ring-blue-400">
                                        {{ __('Place Order') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>


            <div class="p-2 my-6 md:my-16 xl:my-32 bg-gray-800 sm:rounded-xl">
                @foreach($comments as $comment)
                    <div class="sm:m-4 xl:m-8 relative">
                    <div class="flex justify-between">
                    <div class="m-2 sm:m-4 text-center flex items-center space-x-3 w-1/12">
                        <img class="border-0 rounded-full object-cover min-w-12 min-h-12 size-12 sm:min-w-16 sm:min-h-16 sm:size-16" src="{{ "/storage/avatars/" . $comment['username'] }}" alt="">
                        <div class="">{{$comment['username'] . ' '}}</div>
                    </div>
                        @if(!is_null(Auth::user()))
                        @if(Auth::user()->name == $comment['username'])
                                <button type="submit" class="absolute right-14 bottom-0 h-fit w-fit inline-flex items-center p-1 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 hover:bg-blue-400 active:bg-blue-600 focus:ring-blue-400" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-comment-edition{{$comment['commentID']}}')"><img class="w-10" src="{{"/storage/edit.png"}}" alt="{{ __('Edit Comment') }}"></button>
                            <x-modal name="confirm-comment-edition{{$comment['commentID']}}" focusable>
                                <form method="post" action="{{ route('orderRequestOrCommentUpdate') }}" class="p-6">
                                    @csrf
                                    @method('patch')
                                    <input id="commentID" name="commentID" type="hidden" value="{{$comment['commentID']}}" >


                                    <div class="rating">
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="1" @if($comment['rating'] == 1) checked @endif />
                                            <x-input-error class="mt-2" :messages="$errors->get('rating')" />
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="2" @if($comment['rating'] == 2) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="3" @if($comment['rating'] == 3) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="4" @if($comment['rating'] == 4) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="5" @if($comment['rating'] == 5) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="6" @if($comment['rating'] == 6) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="7" @if($comment['rating'] == 7) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="8" @if($comment['rating'] == 8) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="9" @if($comment['rating'] == 9) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" id="rating" name="rating" value="10" @if($comment['rating'] == 10) checked @endif/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                    </div>

                                    <div class="mt-6">
                                        <textarea id="comment" name="comment" type="text" class="p-4 border border-blue-300 bg-gray-700 rounded-3xl min-h-36 w-full">{{old('comment', $comment['comment'])}}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-blue-500 hover:bg-blue-400 active:bg-blue-600 focus:ring-blue-400">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </form>
                            </x-modal>

                                <button type="submit" class="absolute right-0 bottom-0 h-fit w-fit inline-flex items-center p-1 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 hover:bg-red-400 active:bg-red-600 focus:ring-red-400"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-comment-deletion{{$comment['commentID']}}')"
                            ><img class="w-10" src="{{"/storage/delete.png"}}" alt="{{ __('Delete Comment') }}"></button>
                            <x-modal name="confirm-comment-deletion{{$comment['commentID']}}" focusable>
                                <form method="post" action="{{ route('destroyComment') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete your comment?') }}
                                    </h2>

                                    <input id="commentID" name="commentID" type="hidden" value="{{$comment['commentID']}}" >

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            {{ __('Delete Comment') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        @endif
                        @endif
                        <div class="float-right m-6 text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl">
                            @for($i = 0; $i < $comment['rating'];$i++)
                                <span class="fa fa-star checked"></span>
                            @endfor
                                @for($i = $comment['rating']; $i < 10;$i++)
                                    <span class="fa fa-star"></span>
                                @endfor
                        </div>
                    </div>
                        <div class="p-4 border border-blue-300 bg-gray-700 rounded-xl min-h-36">{{$comment['comment']}}</div>
                    </div>
            @endforeach

            </div>

            <div class="p-2 md:my-16 xl:my-32 bg-gray-800 sm:rounded-xl">
            <form method="post" action="{{ route('postComment') }}" class="m-2 sm:m-4 space-y-2 sm:space-y-6">
            @csrf
            @method('put')
                <input id="id" name="id" type="hidden" value="{{$insideBook}}">
                    <div class="flex justify-between text-lg sm:text-xl md:text-2xl lg:text-3xl sm:m-6">
                    <label for="comment">{{__('Share your opinion with us')}}</label>

                            <div class="rating">
                                <label>
                                    <input type="radio" id="rating" name="rating" value="1" />
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="2" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="3" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="4" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="5" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="6" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="7" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="8" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="9" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" id="rating" name="rating" value="10" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                            </div>
                        </div>
                <textarea id="comment" name="comment" type="text" class="p-4 border border-blue-300 bg-gray-700 rounded-xl min-h-36 w-full"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                    <div class="flex justify-end">
                        @if (session('status') === 'not-ordered')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 8000)"
                                class="p-2 text-gray-600 dark:text-gray-400"
                            >{{ __('You have to order the book before you could post comment.') }}</p>
                        @elseif(session('status') === 'comment-saved')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 8000)"
                                class="p-2 text-gray-600 dark:text-gray-400"
                            >{{ __('Comment saved.') }}</p>
                        @endif
                        <button type="submit" class="h-fit w-fit inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-blue-500 hover:bg-blue-400 active:bg-blue-600 focus:ring-blue-400"> {{__('Post')}} </button>
                    </div>

            </form>

            </div>

        </div>


            @else
        <div class="relative p-4 sm:p-6 lg:p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 content-center text-white">
                    @foreach($books as $book)
                        <a href="?id={{$book->id}}">
                        <div class="m-4 sm:m-6 lg:m-8 transition hover:animate-pulse h-full">
                            <img class="w-full h-5/6 object-fill border-2 border-gray-900 shadow-xl shadow-gray-700 border-solid hover:border-gray-400 hover:shadow-gray-400 rounded-2xl" src="{{ "/storage/images/" . $book->id }}" alt="">
                            <div class="m-4 text-center text-3xl font-extrabold">{{$book->title}}</div>
                        </div>
                        </a>
                    @endforeach

        </div>
            @endif
</section>
    </div>
    </body>
</html>
