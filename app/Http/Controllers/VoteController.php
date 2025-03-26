<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index(Request $request)
    {
        $existingVote = Vote::where('user_id', Auth::id())->first();
        
        if ($existingVote) {
            return redirect()->route('vote.thank-you');
        }

        return view('user.vote');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'candidate_id' => 'required|exists:candidates,candidate_id',
        ]);

        $existingVote = Vote::where('user_id', Auth::id())->first();
        
        if ($existingVote) {
            return redirect()->route('vote.thank-you');
        }

        $voteData = [
            'user_id' => Auth::id(),
            'candidate_id' => $validated['candidate_id'],
        ];

        Vote::create($voteData);

        $user = Auth::user();
        $user->status = 'Sudah';
        $user->save();

        return redirect()->route('vote.thank-you');
    }

    public function thankYou()
    {
        return view('user.thank-you');
    }
}
