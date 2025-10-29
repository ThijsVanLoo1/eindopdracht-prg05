<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('search');

        $results = Book::query()
            ->where('name', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->get();

        return view('search', [
            'results' => $results,
            'query' => $query,
        ]);
    }
}
