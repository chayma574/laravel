<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class FormationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $formations = Formation::with('formateur:id,name,email')->get();
        return response()->json([
            'status' => 'success',
            'formations' => $formations,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'formateur') {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Only formateurs can create courses.',
            ], 403);
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
        ]);

        $formation = Formation::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'duree' => $request->duree,
            'prix' => $request->prix,
            'formateur_id' => $user->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Course created successfully',
            'formation' => $formation,
        ], 201);
    }

    public function show($id)
    {
        $formation = Formation::with('formateur:id,name,email')->find($id);

        if (! $formation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'formation' => $formation,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $formation = Formation::find($id);

        if (! $formation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found',
            ], 404);
        }

        if ($user->role !== 'formateur' || $formation->formateur_id !== $user->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You can only update your own courses.',
            ], 403);
        }

        $request->validate([
            'titre' => 'string|max:255',
            'description' => 'nullable|string',
            'duree' => 'integer|min:1',
            'prix' => 'numeric|min:0',
        ]);

        $formation->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Course updated successfully',
            'formation' => $formation,
        ]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $formation = Formation::find($id);

        if (! $formation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found',
            ], 404);
        }

        if ($user->role !== 'formateur' || $formation->formateur_id !== $user->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You can only delete your own courses.',
            ], 403);
        }

        $formation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Course deleted successfully',
        ]);
    }
}
