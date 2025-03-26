<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the form to add a new voter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.voters.display-voters');
    }
    
    /**
     * Store a newly created voter in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // First, check if user already exists
        $existingUser = User::where('name', $request->name)
            ->orWhere('nim', $request->nim)
            ->first();

        if ($existingUser) {
            $errorMessage = $existingUser->name === $request->name 
                ? "A user with this name already exists!" 
                : "A user with this NIM already exists!";

            return redirect()->back()
                ->withInput($request->except('password'))
                ->with('error', $errorMessage);
        }

        // If no existing user, proceed with validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:7',
        ]); 

        try {
            $voter = User::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'password' => Hash::make($request->password),
                'status' => 'Belum',
                'remember_token' => Str::random(10),
            ]);

            $voter->assignRole('voter');

            return redirect()->route("voters.index")
                ->with("success", "Voter added successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->except('password'))
                ->with("error", "An unexpected error occurred: " . $e->getMessage());
        }
    }

    public function viewAddForm()
    {
        return view('admin.voters.add-voter-form');
    }

    public function viewImportForm()
    {
        return view('admin.voters.import-voters');
    }

    public function importVoters()
    {
        return redirect()->route("voters.index")->with("success", "Voters list exported succesfully!");
    }
}
