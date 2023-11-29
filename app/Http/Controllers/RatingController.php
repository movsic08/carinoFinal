<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::all();
        return view('admin.ratings.index', compact('ratings'));
    }

    public function create()
    {
        // Assuming you have a $staffMembers variable available with the list of staff members
        $staffMembers = User::all(); // Adjust this based on your staff retrieval logic
        return view('admin.ratings.create', compact('staffMembers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Rating::create($request->all());

        return redirect()->route('admin.ratings.index')->with('success', 'Rating added successfully');
    }
}
