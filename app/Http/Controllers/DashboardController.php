<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(User $user) {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard');
    }
}
