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
            $currentpage = $page;
            return view('admins.backoffice_'.$page, compact('users','page'));
            break;
            
            case 'books':
            $books = Book::all();
            return view('admins.backoffice_users_'.$page, compact($books));
            break;

        }
    }
}
