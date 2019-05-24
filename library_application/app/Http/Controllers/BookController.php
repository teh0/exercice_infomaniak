<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Image;

class BookController extends Controller
{

    public function search(Request $request) {
        $query = $request->input('search-book');
        if(!empty($query)) {
            $books = Book::with('category')->where('title', 'LIKE', '%' . $query . '%')->paginate(10);
            return view('books.search', compact('books'));
        }
        else {
            return redirect('/')->with('message', 'Veuillez saisir une valeur svp');
        }
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
    public function edit($id_book)
    {
        $book = Book::find($id_book);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_book)
    {
        // dd($request);
        $request->validate([
            'book_title' => 'required',
            'book_category' => 'required',
            'book_author' => 'required',
            'book_description' => 'required',
            'book_pageCount' => 'required',
            'book_lang' => 'required',
        ]);

        $book = Book::find($id_book);
        $book->title = $request->input('book_title');
        $book->description = urlencode($request->input('book_description'));
        $book->authors = $request->input('book_author');
        $book->category_id = Category::where('slug',$request->input('book_category'))->first()->id;
        $book->pageCount = $request->input('book_pageCount');
        $book->lang = $request->input('book_lang');

        //Set default thumbnail if user doesn't add new thumb and no thumb is set in BDD
        if(!$request->file('book_large_thumbnail') && !$book->small_thumbnail) {
            $book->small_thumbnail = public_path('/upload/thumbnails/default_small_thumbnail.jpg');
            $book->large_thumbnail = public_path('/upload/thumbnails/default_large_thumbnail.jpg');
        }
        //Create 2 thumb (large and small) from thumb chosen by user
        else if ($request->file('book_large_thumbnail')){
            $data_large_thumbnail = $request->file('book_large_thumbnail');
            $prefix_thumbnail = $book->id;
            $name_large_thumbnail = $prefix_thumbnail.'_large.'. $data_large_thumbnail->getClientOriginalExtension();
            $name_small_thumbnail = $prefix_thumbnail.'_small.'. $data_large_thumbnail->getClientOriginalExtension();

            Image::make($data_large_thumbnail)->save( public_path('/upload/thumbnails/'.$name_large_thumbnail) );
            Image::make($data_large_thumbnail)->resize(128,181)->save( public_path('/upload/thumbnails/'.$name_small_thumbnail) );
            $book->large_thumbnail = $name_large_thumbnail;
            $book->small_thumbnail = $name_small_thumbnail;
            //Pass fromApi to 0 for condition on src attribute of img in front
            $book->fromApi = 0;
        }
        
        $book->save();
        return redirect()->route('backoffice', 'books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_book)
    {
        $book = Book::find($id_book);
        if($book->user) {
            $user = User::find($book->user->id);
            $user->countBooks--;
            $user->save();
        }
        $book->delete();

        return redirect()->route('backoffice', 'books');
    }
}
