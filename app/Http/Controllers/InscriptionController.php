<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use App\Models\Formation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class InscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $user = Auth::user();
        $inscriptions = Inscription::with('formation.formateur:id,name,email')
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'inscriptions' => $inscriptions,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'etudiant') {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Only students can enroll in courses.',
            ], 403);
        }

        $request->validate([
            'formation_id' => 'required|exists:formations,id',
        ]);

        // Check if already enrolled
        $existingInscription = Inscription::where('user_id', $user->id)
            ->where('formation_id', $request->formation_id)
            ->first();

        if ($existingInscription) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already enrolled in this course.',
            ], 409);
        }

        $inscription = Inscription::create([
            'user_id' => $user->id,
            'formation_id' => $request->formation_id,
            'date_inscription' => now(),
            'statut' => 'active',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Enrolled successfully',
            'inscription' => $inscription,
        ], 201);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $inscription = Inscription::find($id);

        if (! $inscription) {
            return response()->json([
                'status' => 'error',
                'message' => 'Enrollment not found',
            ], 404);
        }

        if ($inscription->user_id !== $user->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You can only cancel your own enrollments.',
            ], 403);
        }

        $inscription->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Enrollment cancelled successfully',
        ]);
    }
}
