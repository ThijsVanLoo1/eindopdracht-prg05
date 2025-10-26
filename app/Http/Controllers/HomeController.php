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
            //Laad die reviews ook gelijk
            ->with(['reviews' => function ($query) {
                $query->where('active', true);
            }])
            ->get();

        return view('home', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validatie
        //errors tonen
        //beveiliging
        //data terugschrijven in form fields

        //INSERT INTO sql
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
