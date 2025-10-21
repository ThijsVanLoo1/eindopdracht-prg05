<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('book')->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //For dropdown menu
        $books = Book::all();
        return view('reviews.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validatie
        $request->validate([
            'comment' => 'required'
        ]);

        //INSERT INTO sql
        $review = new Review();
        $review->rating = 4; //Hardcoded
        $review->comment = $request->input('comment');
        $review->user_id = 1; //Hardcoded
        $review->book_id = $request->input('book_id');

        $review->save();
        return redirect()->route('reviews.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //Mag niet
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
