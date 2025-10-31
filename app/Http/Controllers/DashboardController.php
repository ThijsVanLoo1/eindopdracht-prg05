<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(User $user) {
        $users = User::all();
        $books = Book::all();

        return view('dashboard', compact('users', 'books'));
    }

    public function destroy(User $user)
    {
        Gate::authorize('admin-access');

        $user->delete();
        return redirect()->route('dashboard');
    }
}
