<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
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

        //Haal alle genres op om op te filteren
        $genres = Genre::all();

        return view('home', compact('books', 'genres'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $genreId = $request->input('genre_id');

        $books = Book::query()
            //Zoekbalk maakt query aan die filtert op Boek modellen
            ->when($query, function ($queryBuilder, $query) {
                $queryBuilder->where(function ($q) use ($query) {
                    //WHERE name LIKE '%$input%' OR author LIKE '%$input%'
                    $q->where('name', 'like', '%' . $query . '%')
                        ->orWhere('author', 'like', '%' . $query . '%');
                });
            })
            //Wanneer er een genre is geselecteerd om op te filteren
            ->when($genreId, function ($queryBuilder, $genreId) {
                //WHERE genre_id IS $genreId
                $queryBuilder->where('genre', $genreId);
            })
            ->get();

        //Nieuwe pagina moet ook alle genres hebben om opnieuw te kunnen filteren
        $genres = Genre::all();

        return view('home', compact('books', 'query', 'genres', 'genreId'));
    }
}

