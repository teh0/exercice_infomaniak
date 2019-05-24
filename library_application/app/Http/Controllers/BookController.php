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

    /**
     * search
     *
     * @param Request $request
     * @return void
     */
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
     * borrow
     *
     * @param mixed $id_book
     * @return void
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
     * unborrow
     *
     * @param mixed $id_book
     * @return void
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
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('books.create');
    }


    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required',
            'book_category' => 'required',
            'book_author' => 'required',
            'book_description' => 'required',
            'book_pageCount' => 'required|integer',
            'book_lang' => 'required',
        ]);

        $book = new Book;
        $book->fromApi = 0;
        $book->category_id = Category::where('slug',$request->input('book_category'))->first()->id;
        $book->title = $request->input('book_title');
        $book->authors = $request->input('book_author');
        $book->description = urlencode($request->input('book_description'));
        $book->pageCount = $request->input('book_pageCount');
        $book->lang = $request->input('book_lang');

        //Set default thumbnail if user doesn't add new thumb
        if(!$request->file('book_large_thumbnail')){
            $book->small_thumbnail = "default_small_thumbnail.jpg";
            $book->large_thumbnail = "default_small_thumbnail.jpg";
        }
        //Create 2 thumb (large and small) from thumb chosen by user
        else if ($request->file('book_large_thumbnail')){
            $data_large_thumbnail = $request->file('book_large_thumbnail');
            $prefix_thumbnail = $this->formateString($book->title).time();
            $name_large_thumbnail = $prefix_thumbnail.'_large.'. $data_large_thumbnail->getClientOriginalExtension();
            $name_small_thumbnail = $prefix_thumbnail.'_small.'. $data_large_thumbnail->getClientOriginalExtension();

            Image::make($data_large_thumbnail)->save( public_path('/upload/thumbnails/'.$name_large_thumbnail) );
            Image::make($data_large_thumbnail)->resize(128,181)->save( public_path('/upload/thumbnails/'.$name_small_thumbnail) );
            $book->large_thumbnail = $name_large_thumbnail;
            $book->small_thumbnail = $name_small_thumbnail;
            //Pass fromApi to 0 for condition on src attribute of img in front
        }

        $book->save();
        return redirect()->route('singleBook', ['slug_categ'=> $book->category->slug, 'id_book' => $book->id]);
    }


    /**
     * show
     *
     * @param mixed $slug_categ
     * @param mixed $id_book
     * @return void
     */
    public function show($slug_categ, $id_book)
    {
        $book = Book::find($id_book);
        return view('books.single', compact('book'));
    }


    /**
     * edit
     *
     * @param mixed $id_book
     * @return void
     */
    public function edit($id_book)
    {
        $book = Book::find($id_book);
        return view('books.edit', compact('book'));
    }


    /**
     * update
     *
     * @param Request $request
     * @param mixed $id_book
     * @return void
     */
    public function update(Request $request, $id_book)
    {
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
            $book->small_thumbnail = "default_small_thumbnail.jpg";
            $book->large_thumbnail = "default_small_thumbnail.jpg";
        }
        //Create 2 thumb (large and small) from thumb chosen by user
        else if ($request->file('book_large_thumbnail')){
            $data_large_thumbnail = $request->file('book_large_thumbnail');
            $prefix_thumbnail = $this->formateString($book->title).time();
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
        return redirect()->route('singleBook', ['slug_categ'=> $book->category->slug, 'id_book' => $book->id]);
    }

    /**
     * destroy
     *
     * @param mixed $id_book
     * @return void
     */
    public function destroy($id_book)
    {
        $book = Book::find($id_book);
        if($book->user) {
            if(!is_null($book->user->id)){
                $user = User::find($book->user->id);
                $user->countBooks--;
                $user->save();
            }
        }
        $book->delete();

        return redirect()->route('backoffice', 'books');
    }

    /**
     * formateString
     *
     * @param mixed $str
     * @return void
     */
    public function formateString($str) {
        return strtolower(str_replace(array(' ', 'é', 'è', 'ê', 'ë', 'à', 'â', 'î', 'ï', 'ô', 'ù', 'û'), array('', 'e', 'e', 'e', 'e', 'a', 'a', 'i', 'i', 'a', 'u', 'u'),$str));
    }
}
