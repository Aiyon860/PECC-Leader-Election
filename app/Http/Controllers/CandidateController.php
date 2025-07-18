<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the candidates.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $candidates = Candidate::withCount('votes')->get();
        $routeName = $request->route()->getName();

        // Simplified view selection
        $viewMap = [
            'candidate.result' => 'admin.result',
            'candidate.index' => 'admin.candidates.display-candidates',
            'default' => 'user.vote'
        ];

        $view = $viewMap[$routeName] ?? $viewMap['default'];
        
        return $candidates->isEmpty() 
            ? view($view) 
            : view($view, compact('candidates'));
    }

    /**
     * Show the form for creating a new candidate.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.candidates.add-candidate-form');
    }

    /**
     * Store a newly created candidate in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::where('name', $request->name)->first();

        if (!$user) {
            return back()->with("error", "User not found!");
        }
        
        if (Candidate::where('user_id', $user->user_id)->exists()) {
            return back()->with("error", "This user is already registered as a candidate!");
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        try {
            $photoPath = $this->uploadCandidatePhoto($request->file('photo'));

            $candidate = Candidate::create([
                'name' => $request->name,
                'color' => $request->color,
                'vision' => $request->vision,
                'mission' => $request->mission,
                'photo' => $photoPath,
                'user_id' => $user->user_id,
            ]);

            // Consider moving role assignment to a service or observer
            $candidate->assignRole('candidate');

            return redirect()->route("candidate.index")
                ->with("success", "Candidate added successfully!");
        } catch (\Exception $e) {
            Log::error('Candidate creation failed: ' . $e->getMessage());
            return back()->with("error", "Failed to add candidate: " . $e->getMessage());
        }
    }

    /**
     * Upload candidate photo
     * 
     * @param \Illuminate\Http\UploadedFile $photo
     * @return string
     */
    private function uploadCandidatePhoto($photo): string
    {
        $photoName = time() . '.' . $photo->extension();
        $photoPath = $photo->storeAs('images', $photoName, 'public');
        return $photoPath; // returns 'images/xxx.jpg'
    }


    /**
     * Show the form for editing the specified candidate.
     *
     * @param  int  $candidateId
     * @return \Illuminate\View\View
     */
    public function edit($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);
        return view('admin.candidates.edit-candidate-form', compact('candidate'));
    }

    /**
     * Update the specified candidate in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $candidateId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        try {
            // Handle photo update
            if ($request->hasFile('photo')) {
                // Remove old photo
                if ($candidate->photo && file_exists(public_path($candidate->photo))) {
                    unlink(public_path($candidate->photo));
                }
                
                $candidate->photo = $this->uploadCandidatePhoto($request->file('photo'));
            }

            // Update other fields
            $candidate->fill($request->only(['name', 'vision', 'mission']));
            $candidate->save();

            return redirect()->route("candidate.index")
                ->with("success", "Candidate updated successfully!");
        } catch (\Exception $e) {
            Log::error('Candidate update failed: ' . $e->getMessage());
            return back()->with("error", "Failed to update candidate: " . $e->getMessage());
        }
    }

    /**
     * Remove the specified candidate from storage.
     *
     * @param  int  $candidateId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);
        
        try {
            if ($candidate->photo && Storage::disk('public')->exists($candidate->photo)) {
                Storage::disk('public')->delete($candidate->photo);
            }
            
            $candidate->delete();

            return redirect()->route("candidate.index")
                ->with("success", "Candidate deleted successfully!");
        } catch (\Exception $e) {
            Log::error('Candidate deletion failed: ' . $e->getMessage());
            return back()->with("error", "Failed to delete candidate: " . $e->getMessage());
        }
    }

    /**
     * Get candidates with vote count for JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVotes(): JsonResponse
    {
        $candidates = Candidate::withCount('votes')
            ->get(['candidate_id', 'name', 'color', 'photo']);
        
        return response()->json($candidates);
    }
}