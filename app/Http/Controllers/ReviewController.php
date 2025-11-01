<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('book')->where('user_id', auth()->id())->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Diepere validatie
        $user = Auth::user();
        $reviewCount = $user ? $user->reviews()->count() : 0;
        $requiredReviews = 3;

        $canAddNewBook = $reviewCount >= $requiredReviews;

        //For dropdown menu
        $books = Book::all();
        $genres = Genre::all();
        return view('reviews.create', compact('books', 'genres', 'canAddNewBook', 'requiredReviews', 'reviewCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validatie
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviewComment' => 'required|string',
            'book_id' => 'nullable|exists:books,id',
            'genre_id' => 'nullable|exists:genres,id',
            'bookTitle' => 'required_without:book_id|string|max:255',
            'author' => 'required_without:book_id|string|max:255',
            'description' => 'nullable|string',
            'bookImage' => 'nullable|image|max:2048',
        ]);

        //Diepere validatie: heeft de gebruiker al 3 reviews geschreven voor bestaande boeken voordat deze een nieuw boek mag toevoegen?
        if (!$request->filled('book_id')) {
            //SELECT * FROM reviews WHERE user_id = {ingelogde gebruiker} -> en tel hoeveel
            $reviewCount = Review::where('user_id', Auth::id())->count();
            $requiredReviews = 3;

            if ($reviewCount < $requiredReviews) {
                return back()->withErrors([
                    'bookTitle' => "Je moet minstens {$requiredReviews} reviews hebben geschreven voordat je een nieuw boek kunt toevoegen."
                ])->withInput();
            }
        }

        //Is er een boek geselecteerd?
        if ($request->filled('book_id')) {
            //Ja, haal op
            $bookId = $request->input('book_id');
        } else {
            //Nee, sla nieuw boek op
            $book = new Book();
            $book->genre = $request->input('genre_id');
            $book->name = $request->input('bookTitle');
            $book->author = $request->input('author');
            $book->description = $request->input('description');

            //Afbeelding opslaan
            if ($request->hasFile('bookImage')) {
                $path = $request->file('bookImage')->store('book_images', 'public');
                $book->image = $path;
            }

            $book->save();
            $bookId = $book->id;
        }

        //EXTRA CHECK: Controleer of gebruiker niet al een review heeft geschreven voor het gekozen boek

        //SELECT * FROM reviews WHERE user_id = {ingelogde gebruiker} AND WHERE book_id = {geselecteerde boek}
        $existingReview = Review::where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->first();

        //Deze bestaat, dus herlaadt pagina
        if ($existingReview) {
            return back()->withErrors([
                'book_id' => 'Je hebt al een review geschreven voor dit boek!'
            ])->withInput();
        }

        //Review opslaan
        $review = new Review();
        $review->rating =  $request->input('rating');
        $review->comment = $request->input('reviewComment');
        $review->user_id = Auth::id();
        $review->book_id = $bookId;

        $review->save();
        return redirect()->route('reviews.index')->with('success', 'Review toegevoegd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //Doet niets, dus mag niet
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        Gate::authorize('review-access', $review);
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string'
        ]);

        $review->rating =  $request->input('rating');
        $review->comment = $request->input('review');

        $review->save();
        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        Gate::authorize('review-access', $review);

        $review->delete();
        return redirect()->route('reviews.index');
    }

    public function toggle(\App\Models\Review $review)
    {
        $review->active = !$review->active;
        $review->save();

        //.then(data) in read.js krijgt deze json binnen
        return response()->json([
            'success' => true,
            'active' => $review->active,
            'label' => $review->active ? 'Actief' : 'Inactief',
        ]);
    }
}
