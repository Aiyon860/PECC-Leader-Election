<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CandidateApiController extends Controller
{
    public function getVotes(): JsonResponse
    {
        $candidates = Candidate::withCount('votes')
            ->get(['candidate_id', 'name', 'color', 'photo']);
        
        return response()->json($candidates);
    }
}