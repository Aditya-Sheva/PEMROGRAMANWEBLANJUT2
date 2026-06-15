<?php
namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isSecretary() || $user->isAdmin()) {
            $data = [
                'total'         => Proposal::count(),
                'pending'       => Proposal::where('status','pending')->count(),
                'under_review'  => Proposal::where('status','under_review')->count(),
                'approved'      => Proposal::where('status','approved')->count(),
                'proposals'     => Proposal::with('user')->latest()->take(6)->get(),
                'users_pending' => User::where('is_active', false)->count(),
            ];
        } elseif ($user->isReviewer()) {
            $data = [
                'assigned'  => $user->reviews()->count(),
                'pending'   => $user->reviews()->where('status','pending')->count(),
                'completed' => $user->reviews()->where('status','completed')->count(),
                'proposals' => Proposal::whereHas('reviews', fn($q) =>
                    $q->where('reviewer_id', $user->id))->with('user')->latest()->take(6)->get(),
            ];
        } elseif ($user->isKetua()) {
            $data = [
                'waiting_signature' => Proposal::where('status', 'waiting_signature')
                    ->whereHas('decision', fn($q) => $q->where('chief_id', $user->id))
                    ->count(),
                'signed' => Proposal::whereHas('decision', fn($q) =>
                    $q->where('chief_id', $user->id)->whereNotNull('signed_at'))
                    ->count(),
                'published' => Proposal::where('status', 'published')
                    ->whereHas('decision', fn($q) => $q->where('chief_id', $user->id))
                    ->count(),
                'proposals' => Proposal::whereHas('decision', fn($q) =>
                    $q->where('chief_id', $user->id))->latest()->take(6)->get(),
            ];
        } else {
            $data = [
                'total'     => $user->proposals()->count(),
                'pending'   => $user->proposals()->whereIn('status',[
                    'pending','document_check','under_review','data_confirmation','waiting_signature'
                ])->count(),
                'approved'  => $user->proposals()->where('status','published')->count(),
                'proposals' => $user->proposals()->latest()->take(6)->get(),
            ];
        }

        return view('dashboard', compact('data'));
    }
}