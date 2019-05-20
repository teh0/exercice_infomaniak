<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class BookController extends Controller
{

    public function search(Request $request) {
        $query = $request->input('search-book');
        $books = DB::table('books')->where('title', 'LIKE', '%' . $query . '%')->paginate(10);
        return view('books.search', compact('books'));
        
    }

    /**
     * Update isBorrowed and user_id of Book send in param.
     *
     * @return \Illuminate\Http\Response
     */
    public function borrow($id_book) {
        $user = Auth::user();
        $user->countBooks++;
        $book=Book::find($id_book);
        $book->isBorrowed=1;
        $book->user_id=$user->id;
        $book->save();
        $user->save();

        return redirect('book/collection/'.$book->category->slug.'/'.$book->id);
        
    }

    /**
     * Update isBorrowed and user_id of Book send in param.
     *
     * @return \Illuminate\Http\Response
     */
    public function unborrow($id_book) {
        $user = Auth::user();
        $user->countBooks--;

        $book=Book::find($id_book);
        $book->isBorrowed=0;
        $book->user_id=0;

        $book->save();
        $user->save();

        return redirect('user/profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($slug_categ, $id_book)
    {
        $book = Book::find($id_book);
        return view('books.single', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
