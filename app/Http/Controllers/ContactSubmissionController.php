<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    // Show form submissions
    public function index()
    {
        $submissions = ContactSubmission::all();

        return view('contact_submissions.index', compact('submissions'));
    }

    // Store a new submission
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        ContactSubmission::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone_code' => $request->phone_code,
            'phone' => $request->phone,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'best_time' => $request->best_time, // This should be sent as an array
        ]);

        return redirect()->back()->with('success', 'Your submission has been received.');
    }

    // Delete a submission
    public function destroy($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return redirect()->back()->with('success', 'Submission deleted successfully.');
    }
}
