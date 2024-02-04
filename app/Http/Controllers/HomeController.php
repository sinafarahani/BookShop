<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

    public function getBook(Request $request): View
    {
        if ($request->has('id')) {

            // SELECT * FROM books WHERE id = $request->input('id');
            $book = Book::find($request->input('id'));

            $commentsInfo = [];

            // SELECT * FROM comments WHERE book_id = $request->input('id');
            $comments = Comment::whereBelongsTo($book)->get();

            foreach ($comments as $comment){
                $commentsInfo[] = [
                    'commentID' => $comment->id,
                    'username' => $comment->user_name,
                    'rating' => $comment->rating,
                    'comment' => $comment->comment,
                ];
            }
            return view('home', [
                'books' => $book,
                'comments' => $commentsInfo,
                'insideBook' => $request->input('id'),
            ]);
        } else if ($request->has('query') && ! is_null($request->input('query'))) {

            // SELECT * FROM books WHERE title = $request->input('query') OR author = $request->input('query');
            $book = Book::where('title', $request->input('query'))->orWhere('author', $request->input('query'))->get();

            return view('home', [
                'books' => $book,
            ]);
        }
        else {
            return view('home', [

                // SELECT * FROM books
                'books' => Book::all(),
            ]);
        }
    }

    /**
     * post the comment.
     */
    public function postComment(Request $request): RedirectResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'max:10', 'min:0'],
            'comment' => ['nullable', 'string', 'max:65535'],
        ]);

        // SELECT * FROM orders WHERE book_id = $request->input('id') AND user_name = $request->user()->name;
        $order = Order::whereBelongsTo($request->user())->where('book_id' , $request->input('id'))->firstor(function () use ($request) {
            return Back()->with('status', 'not-ordered');
        });
        if($order instanceof RedirectResponse){
            return $order;
        }

        //INSERT INTO comments
        //(user_name, book_id, rating, comment)
        //VALUES
        //($request->user()->name, $request->input('id'), $request->input('rating'), $request->input('comment'));
        $request->user()->comments()->create([
            'book_id' => $request->input('id'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return Back()->with('status', 'comment-saved');
    }
    /**
     * order the book or update the comment.
     */
    public function orderRequestOrCommentUpdate(Request $request): RedirectResponse
    {
        if($request->has('commentID')) {
            $request->validate([
                'rating' => ['required', 'integer', 'max:10', 'min:0'],
                'comment' => ['nullable', 'string', 'max:65535'],
            ]);

            //UPDATE comments
            //SET rating = $request->input('rating'),
            //    comment = $request->input('comment')
            //WHERE id = $request->input('commentID') AND user_name = $request->user()->name;
            $comment = $request->user()->comments()->find($request->input('commentID'));
            $comment->rating = $request->input('rating');
            $comment->comment = $request->input('comment');
            $comment->save();

            return Back()->with('status', 'comment-saved');
        }
        else {
            // SELECT * FROM books WHERE id = $request->input('id');
            $book = Book::find($request->input('id'));
            $size = $book->available;

            $request->validate([
                'number' => ['required', 'integer', "max:$size", 'min:1'],
            ]);

            //UPDATE books
            //SET number = $request->input('number')
            //WHERE id = $request->input('id');
            $size-= $request->input('number');
            $book->available = $size;
            $book->save();

            //INSERT INTO orders
            //(user_name, book_id, number)
            //VALUES
            //($request->user()->name, $request->input('id'), $request->input('number'));
            $request->user()->orders()->create([
                'book_id' => $request->input('id'),
                'number' => $request->input('number'),
            ]);

            return Back()->with('status', 'order-made');
        }
    }

    /**
     * delete the comment.
     */
    public function destroyComment(Request $request): RedirectResponse
    {
        if($request->has('commentID')) {
            //DELETE FROM comments
            //WHERE id = $request->input('commentID') AND user_name = $request->user()->name;
            $request->user()->comments()->where('id', $request->input('commentID'))->delete();

            return Back()->with('status', 'comment-deleted');
        }else{
            return Back()->with('status', 'commentID-not-set');
        }
    }

}
