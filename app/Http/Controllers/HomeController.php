<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Haal boeken op met tenminste 1 actieve review
        $books = Book::whereHas('reviews', function ($query) {
            $query->where('active', true);
        })
            //Laad die reviews ook gelijk --> Maar eentje nodig
            ->with(['reviews' => function ($query) {
                $query->where('active', true)->limit(1)->with('user');
            }])->inRandomOrder()
            ->get();

        return view('home', compact('books'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::when($query, function ($queryBuilder, $query) {
            $queryBuilder->where(function ($q) use ($query) {
                // WHERE (name LIKE '%$input%' OR author LIKE '%$input%')
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('author', 'like', '%' . $query . '%');
            });
        })->get();

        return view('home', compact('books', 'query'));
    }
}

