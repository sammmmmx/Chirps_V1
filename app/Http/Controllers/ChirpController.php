<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')->latest()->get();
        return view('chirps.index', compact('chirps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|max:280'
        ]);

        $request->user()->chirps()->create([
            'message' => $request->message
        ]);

        return redirect()->route('chirps.index');
    }
}