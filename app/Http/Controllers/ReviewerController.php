<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewerController extends Controller
{
    public function index()
    {
        $reviews = Review::where('reviewer_id', Auth::id())
            ->with('proposal.user')->latest()->paginate(10);
        return view('reviewer.index', compact('reviews'));
    }

    public function submitFeedback(Request $request, Review $review)
    {
        $request->validate([
            'feedback'       => 'required|string',
            'recommendation' => 'required|in:approved,approved_with_recommendation,resubmission,disapproved',
        ]);
        $review->update([
            'feedback'       => $request->feedback,
            'recommendation' => $request->recommendation,
            'status'         => 'completed',
        ]);
        return back()->with('success', 'Feedback berhasil dikirim!');
    }
}