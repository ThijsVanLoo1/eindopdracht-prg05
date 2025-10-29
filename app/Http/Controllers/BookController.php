<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(Book $book) {
        //Laad reviews van boek en users van de reviews
        $book->load(['reviews' => function ($query) {
            $query->where('active', true)->with('user');
        }]);

        return view('details', compact('book'));
    }
}
