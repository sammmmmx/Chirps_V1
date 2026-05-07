<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Models\Like;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with(['user', 'likes'])->latest()->get();
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

    public function destroy(Chirp $chirp)
    {
        if ($chirp->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $chirp->delete();

        return redirect()->route('chirps.index')->with('success', 'Chirp deleted!');
    }
        public function edit(Chirp $chirp)
    {
        if ($chirp->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('chirps.edit', compact('chirp'));
    }

    public function update(Request $request, Chirp $chirp)
    {
        if ($chirp->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'message' => 'required|max:280'
        ]);

        $chirp->update([
            'message' => $request->message
        ]);

        return redirect()->route('chirps.index')->with('success', 'Chirp updated!');
    }

    public function like(Chirp $chirp)
    {
        $user = auth()->user();

        if ($chirp->isLikedBy($user)) {
            // Unlike
            $chirp->likes()->where('user_id', $user->id)->delete();
        } else {
            // Like
            $chirp->likes()->create(['user_id' => $user->id]);
        }

        return redirect()->route('chirps.index');
    }
}