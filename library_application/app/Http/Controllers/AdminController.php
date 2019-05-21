<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function displayBackoffice($page) {
        switch ($page) {
            case 'users':
            $users = User::all();
            $lastuser = User::all()->sortBy('created_at')->last();
            $currentpage = $page;
            return view('admins.backoffice_'.$page, compact('users','page','lastuser'));
            break;
            
            case 'books':
            $books = Book::all();
            return view('admins.backoffice_'.$page, compact('books', 'page'));
            break;

        }
    }
}
