<x-app-layout>
    @if (Auth::user()->name == env('ADMIN_USERNAME', 'Admin'))
            @if(isset($query))
            <x-slot name="header">
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $books->title }}
                </h2>
            </x-slot>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 relative">
                            <form method="post" action="{{ route('book.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <input id="id" name="id" type="hidden" value="{{$query}}">

                                <div class="flex items-center justify-center w-full">
                                    <label for="image" class="flex flex-col items-center justify-center border-2 min-h-12 min-w-12 border-gray-300 rounded-xl cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <img class="rounded-xl max-w-full max-h-screen" src="{{ "/storage/images/" . $books->id }}" alt="Upload Image">
                                        <input id="image" name="image" type="file" class="hidden" />
                                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                    </label>
                                </div>
                                <div class="flex w-full gap-4">
                                <div class="w-full">
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $books->title)" required autofocus autocomplete="title" />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <div class="w-full">
                                    <x-input-label for="author" :value="__('Author')" />
                                    <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $books->author)" required autofocus autocomplete="author" />
                                    <x-input-error class="mt-2" :messages="$errors->get('author')" />
                                </div>
                                </div>
                                <div class="flex w-full gap-4">
                                <div class="w-full">
                                    <x-input-label for="language" :value="__('Language')" />
                                    <x-text-input id="language" name="language" type="text" class="mt-1 block w-full" :value="old('language', $books->language)" required autofocus autocomplete="language" />
                                    <x-input-error class="mt-2" :messages="$errors->get('language')" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="category" :value="__('Category')" />
                                    <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" :value="old('category', $books->category)" required autofocus autocomplete="category" />
                                    <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                </div>
                                </div>
                                    <div class="flex w-full gap-4">
                                <div class="w-full">
                                    <x-input-label for="price" :value="__('Price')" />
                                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $books->price)" required autofocus autocomplete="price" />
                                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="available" :value="__('Available Numbers')" />
                                    <x-text-input id="available" name="available" type="number" class="mt-1 block w-full" :value="old('available', $books->available)" required autofocus autocomplete="available" />
                                    <x-input-error class="mt-2" :messages="$errors->get('available')" />
                                </div>
                                </div>
                                        <div class="flex w-full gap-4">
                                <div class="w-full">
                                    <x-input-label for="publisher" :value="__('Publisher')" />
                                    <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full" :value="old('publisher', $books->publisher)" autofocus autocomplete="publisher" />
                                    <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="Publication" :value="__('Publication')" />
                                    <x-text-input id="Publication" name="Publication" type="number" class="mt-1 block w-full" :value="old('Publication', $books->Publication)" autofocus autocomplete="Publication" />
                                    <x-input-error class="mt-2" :messages="$errors->get('Publication')" />
                                </div>
                                </div>
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $books->description)" autofocus autocomplete="description" />
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'book-updated')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600 dark:text-gray-400"
                                        >{{ __('Book Updated.') }}</p>
                                    @endif
                                </div>
                            </form>
                            <form method="post" action="{{ route('book.destroy') }}" class="p-6 absolute bottom-0 right-0">
                                @csrf
                                @method('delete')
                                <input id="id" name="id" type="hidden" value="{{$query}}">
                                <x-danger-button class="ms-3">
                                    {{ __('Delete Book') }}
                                </x-danger-button>
                                @if (session('status') === 'book-deleted')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Book Deleted.') }}</p>
                                @elseif(session('status') === 'book-deletion-failed')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Failed to delete the book') }}</p>
                                @endif
                            </form>
                        </div>
                    </div>
            </div>
        </div>
                @elseif(isset($orders))
            <x-slot name="header">
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $user->name }}
                </h2>
            </x-slot>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($orders as $order)
                        <ul class="flex justify-between w-full shadow-2xl shadow-gray-950 font-bold text-lg">
                            <li class="p-6">{{__('Ordered Book ID: ') .$order['book']->id}}</li>
                            <li class="p-6">{{__('Ordered Book Title: ') .$order['book']->title}}</li>
                            <li class="p-6">{{__('Ordered Number: ') .$order['number']}}</li>
                            <li class="p-6">{{__('Ordered At: ') .$order['created_at']}}</li>
                        </ul>
                        @foreach($order['comments'] as $comment)
                            <table class="text-center my-6 border w-full shadow-2xl shadow-gray-900">
                                <tr class="shadow-2xl shadow-gray-900">
                                    <th class="py-2 px-4 w-1/6 border shadow-2xl shadow-gray-900">{{__('Rating: ')}}</th>
                                    <td class="py-2 px-4 w-1/12 border shadow-2xl shadow-gray-900">{{$comment['rating']}}</td>
                                    <td class="p-4 align-text-top text-left border shadow-2xl shadow-gray-900" rowspan="5">{{$comment['comment']}}</td>
                                </tr>
                                <tr class="shadow-2xl shadow-gray-900">
                                    <th class="pt-2 w-1/4 border-t shadow-2xl shadow-gray-900" colspan="2">{{__('Comment Posted At: ')}}</th>
                                </tr>
                                <tr class="shadow-2xl shadow-gray-900">
                                    <td class="pb-2 px-4 w-1/4 shadow-2xl shadow-gray-900" colspan="2">{{$comment['created_at']}}</td>
                                </tr>
                                <tr class="shadow-2xl shadow-gray-900">
                                    <th class="pt-2 px-4 w-1/4 border-t shadow-2xl shadow-gray-900" colspan="2">{{__('Comment Updated At: ')}}</th>
                                </tr>
                                <tr class="shadow-2xl shadow-gray-900">
                                    <td class="pb-2 px-4 w-1/4 shadow-2xl shadow-gray-900" colspan="2">{{$comment['updated_at']}}</td>
                                </tr>
                            </table>
                        @endforeach
                    @endforeach
                    <br>
                </div>
                </div>
                </div>
                </div>
                @else
            <x-slot name="header">
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 xl:grid-cols-2 gap-10">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form method="post" action="{{ route('book.create') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                    </div>
                                    <input id="image" name="image" type="file" class="hidden" />
                                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                </label>
                            </div>

                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <x-input-label for="author" :value="__('Author')" />
                                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" required autofocus autocomplete="author" />
                                <x-input-error class="mt-2" :messages="$errors->get('author')" />
                            </div>
                            <div>
                                <x-input-label for="language" :value="__('Language')" />
                                <x-text-input id="language" name="language" type="text" class="mt-1 block w-full" required autofocus autocomplete="language" />
                                <x-input-error class="mt-2" :messages="$errors->get('language')" />
                            </div>
                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <x-text-input id="category" name="category" type="text" class="mt-1 block w-full"  required autofocus autocomplete="category" />
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div>
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" required autofocus autocomplete="price" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                            <div>
                                <x-input-label for="available" :value="__('Available Numbers')" />
                                <x-text-input id="available" name="available" type="number" class="mt-1 block w-full" required autofocus autocomplete="available" />
                                <x-input-error class="mt-2" :messages="$errors->get('available')" />
                            </div>
                            <div>
                                <x-input-label for="publisher" :value="__('Publisher')" />
                                <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full" autofocus autocomplete="publisher" />
                                <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
                            </div>
                            <div>
                                <x-input-label for="Publication" :value="__('Publication')" />
                                <x-text-input id="Publication" name="Publication" type="number" class="mt-1 block w-full" autofocus autocomplete="Publication" />
                                <x-input-error class="mt-2" :messages="$errors->get('Publication')" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" autofocus autocomplete="description" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'book-created')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Book created.') }}</p>
                                @endif
                            </div>

                        </form>
                        {{-- @dd($books) --}}
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-auto shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="text-center shadow-2xl w-full">
                            <tr class="border-b-2 shadow-xl shadow-gray-900">
                                <th class="p-3">{{__('Title')}}</th>
                                <th class="p-3">{{__('Author')}}</th>
                                <th class="p-3">{{__('Account Created At')}}</th>
                                <th class="p-3">{{__('Profile Updated At')}}</th>
                            </tr>
                            @foreach($books as $book)
                                <tr class="shadow-gray-700 shadow-inner">
                                    <td class="p-3"><a href="?id={{$book->id}}" >{{$book->title}}</a></td>
                                    <td class="p-3"><a href="?id={{$book->id}}" >{{$book->author}}</a></td>
                                    <td class="p-3"><a href="?id={{$book->id}}" >{{$book->created_at}}</a></td>
                                    <td class="p-3"><a href="?id={{$book->id}}" >{{$book->updated_at}}</a></td>
                                </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
             <div class="bg-white dark:bg-gray-800 overflow-auto shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="text-center shadow-2xl">
                        <tr class="border-b-2 shadow-xl shadow-gray-900">
                            <th class="p-3">{{__('Username')}}</th>
                            <th class="p-3">{{__('First Name')}}</th>
                            <th class="p-3">{{__('Last Name')}}</th>
                            <th class="p-3">{{__('Email')}}</th>
                            <th class="p-3">{{__('Email Verified At')}}</th>
                            <th class="p-3">{{__('Address')}}</th>
                            <th class="p-3">{{__('Account Created At')}}</th>
                            <th class="p-3">{{__('Profile Updated At')}}</th>
                        </tr>
                        @foreach($users as $user)
                            <tr class="shadow-gray-700 shadow-inner">
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->name}}</a></td>
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->firstname}}</a></td>
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->lastname}}</a></td>
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->email}}</a></td>
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->email_verified_at}}</a></td>
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->address}}</a></td>
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->created_at}}</a></td>
                                <td class="p-3"><a href="?name={{$user->name}}" >{{$user->updated_at}}</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        </div>
    @endif
    @else
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order history') }}
            </h2>
        </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-xl">
                <div class="sm:p-2 md:p-4 lg:p-6 text-gray-900 dark:text-gray-100 w-full">
                    @if(!$orders)
                        <div class="text-xl">
                        {{__('you haven\'t placed any orders.')}}
                        </div>
                    @endif
                    @foreach($orders as $order)
                        <div class="shadow-xl shadow-gray-950 bg-gray-800 sm:rounded-xl p-6 my-6 mx-auto md:w-11/12 h-1/3 flex justify-between items-center relative">
                            <div class="w-1/6 text-center">
                                <img class="rounded-xl shadow-xl" src="{{ "/storage/images/" . $order['book_id'] }}"  alt=""/>
                            </div>
                            <div class="h-full">
                                <h1 class="p-2 pt-8 sm:text-xl md:text-2xl lg:text-3xl font-extrabold">{{$order['book_title']}}</h1>
                                <h3 class="sm:text-lg md:text-xl text-center">{{$order['book_author']}}</h3>
                            </div>
                            <div>
                                <div class="font-black sm:text-xl md:text-2xl">{{__('Count: ') . $order['number']}}</div>
                            </div>
                            <div class="h-full text-right">
                                <div class="sm:text-xl md:text-2xl font-extrabold">{{__('Total price: $') . $order['number'] * $order['book_price']}}</div>
                            </div>
                            <div class="absolute top-6 sm:top-10 right-6 text-gray-400">{{$order['created_at']}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
