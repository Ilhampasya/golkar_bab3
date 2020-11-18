<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use BadMethodCallException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = $this->resolveModelQueryByRequest($request, User::query());
        } catch (BadMethodCallException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
        }

        try {
            return response()->json([
                'success' => true,
                'data' => $query->paginate($request->perPage ?: 10)
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
        } 
    }

    public function profile(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    }

    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function update(User $user)
    {
        
    }

    public function destroy(User $user)
    {
        return response()->json([
            'success' => $user->delete(),
            'data' => $user
        ]);
    }
}
