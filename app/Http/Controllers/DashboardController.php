<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function getBook(Request $request): View
    {
        if($request->user()->name == env('ADMIN_USERNAME', 'Admin')) {
            if ($request->has('id')) {

                // SELECT * FROM books WHERE id = $request->input('id');
                $book = Book::find($request->input('id'));
                return view('dashboard', [
                    'books' => $book,
                    'query' => $request->input('id'),
                ]);
            }
            elseif ($request->has('name')) {

                // SELECT * FROM users WHERE name = $request->input('name');
                $user = User::find($request->input('name'));

                $ordersInfo = [];

                // SELECT * FROM orders WHERE user_name = $request->input('name');
                $orders = $user->orders()->get();

                foreach ($orders as $order){
                    $commentsInfo = [];

                    // SELECT * FROM books WHERE id = $order->book_id;
                    $book = Book::find($order->book_id);

                    // SELECT * FROM comments WHERE user_name = $request->input('name') AND book_id = $book->id;
                    $comments = $user->comments()->where('book_id', $book->id)->get();

                    foreach ($comments as $comment){
                        $commentsInfo[] = [
                            'rating' => $comment->rating,
                            'comment' => $comment->comment,
                            'created_at' => $comment->created_at,
                            'updated_at' => $comment->updated_at,
                        ];
                    }
                    $ordersInfo[] = [
                        'book' => $book,
                        'number' => $order->number,
                        'created_at' => $order->created_at,
                        'comments' => $commentsInfo,
                    ];
                }
                return view('dashboard', [
                    'orders' => $ordersInfo,
                    'user' => $user,
                ]);
            }
            else {
                // SELECT * FROM users EXCEPT SELECT * FROM users WHERE name = $request->user()->name;
                $users = User::all()->except($request->user()->name);
                return view('dashboard', [
                    // SELECT * FROM books;
                    'books' => Book::all(),
                    'users' => $users,
                ]);
            }

        }

        else {
            $ordersInfo = [];

            // SELECT * FROM orders WHERE user_name = $request->user()->name;
            $orders = Order::whereBelongsTo($request->user())->get();

            foreach ($orders as $order){

                // SELECT * FROM books WHERE id = $order->book_id;
                $book = Book::find($order->book_id);

                $ordersInfo[] = [
                    'book_id' => $book->id,
                    'book_title' => $book->title,
                    'book_author' => $book->author,
                    'book_price' => $book->price,
                    'number' => $order->number,
                    'created_at' => $order->created_at,
                ];
            }
            return view('dashboard', [
                'orders' => $ordersInfo,
            ]);
        }
    }
    /**
     * Create the book.
     */
    public function create(BookUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        //INSERT INTO books
        //(title, author, language, category, price, available, publisher, Publication, description)
        //VALUES(
        //$request->input('title'),
        // $request->input('author'),
        // $request->input('language'),
        // $request->input('category'),
        // $request->integer('price'),
        // $request->integer('available'),
        // $request->input('publisher'),
        // $request->integer('Publication'),
        // $request->input('description'));
        $book = Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'language' => $request->input('language'),
            'category' => $request->input('category'),
            'price' => $request->integer('price'),
            'available' => $request->integer('available'),
            'publisher' => $request->input('publisher'),
            'Publication' => $request->integer('Publication'),
            'description' => $request->input('description'),
        ]);

        if($request->has('image')){
            $request->validate([
                'image' => 'image'
            ]);
            $request->file('image')->storeAs('images', $book->id, 'public');
        }

        return Redirect(RouteServiceProvider::HOME)->with('status', 'book-created');
    }
    /**
     * Update the book information.
     */
    public function update(BookUpdateRequest $request): RedirectResponse
    {
        $request->validated();
        //UPDATE books
        //SET title = $request->input('title'),
        //    author = $request->input('author'),
        //    language = $request->input('language'),
        //    category = $request->input('category'),
        //    price = $request->integer('price'),
        //    available = $request->integer('available'),
        //    publisher = $request->input('publisher'),
        //    Publication = $request->integer('Publication'),
        //    description = $request->input('description'))
        // WHERE id = $request->input('id');
        $book = Book::find($request->input('id'));
        $book->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'language' => $request->input('language'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'available' => $request->integer('available'),
        ]);
        if($request->has('publisher'))
            $book->update(['publisher' => $request->input('publisher')]);
        if($request->has('Publication'))
            $book->update(['Publication' => $request->integer('Publication')]);
        if($request->has('description'))
            $book->update(['description' => $request->input('description')]);

        if($request->has('image')){
            $request->validate([
                'image' => 'image'
            ]);
            $request->file('image')->storeAs('images', $book->id, 'public');
        }

        return Back()->with('status', 'book-updated');
    }

    /**
     * Delete the book.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if($request->has('id')){

            //DELETE FROM books
            //WHERE id = $request->input('id');
            Book::find($request->input('id'))->delete();

            if (Storage::disk('public')->exists('images/' . $request->input('id'))) {
                Storage::disk('public')->delete('images/' . $request->input('id'));
            }
            return Redirect(RouteServiceProvider::HOME)->with('status', 'book-deleted');
        }
        else{
            return Back()->with('status', 'book-deletion-failed');
        }
    }
}
