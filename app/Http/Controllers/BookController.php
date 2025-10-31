<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function show(Book $book) {
        //Laad reviews van boek en users van de reviews
        $book->load(['reviews' => function ($query) {
            $query->where('active', true)->with('user');
        }]);

        return view('details', compact('book'));
    }

    public function destroy(Book $book) {
        Gate::authorize('admin-access');

        $book->delete();
        return redirect()->route('dashboard');
    }
}
