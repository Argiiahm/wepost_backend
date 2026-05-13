<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    // like activity
    public function likeActivity(Request $request)
    {
        $user = $request->user();

        // Get the user's like activity
        $likeActivity = Like::where('user_id', $user->id)
            ->with('post') // Eager load the related post
            ->get();

        return response()->json($likeActivity);
    }

    // like or unlike a post
    public function like(Request $request, $id)
    {
        $user = $request->user();

        // Check if the user has already liked the post
        $like = Like::where('user_id', $user->id)
            ->where('post_id', $id)
            ->first();

        if ($like) {
            // If the like exists, remove it (unlike)
            $like->delete();
            return response()->json(['message' => 'Post unliked']);
        } else {
            // If the like does not exist, create it (like)
            Like::create([
                'user_id' => $user->id,
                'post_id' => $id,
            ]);
            return response()->json(['message' => 'Post liked']);
        }
    }
}
