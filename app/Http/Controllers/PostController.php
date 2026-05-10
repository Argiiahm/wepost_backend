<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // getAll
    public function index()
    {
        $posts = Posts::with("category", "user")
            ->inRandomOrder()
            ->latest()
            ->get();
        return response($posts);
    }

    // show by id
    public function show($id)
    {
        $post = Posts::with("user")->where("id", $id)->first();
        return response($post);
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:3",
            "content" => "required|min:3",
        ]);

        $userId = Auth::user()->id;
        $categoryId = $request->category_id;

        $post = Posts::create([
            "title" => $request->title,
            "content" => $request->content,
            "user_id" => $userId,
            "category_id" => $categoryId,
        ]);

        return response()->json([
            "message" => "Post Created!",
            "post" => $post,
        ]);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|min:3",
            "content" => "required|min:3",
        ]);

        $userId = Auth::user()->id;
        $categoryId = $request->category_id;

        $post = Posts::findOrFail($id);

        // Cek Postingan ini dibuat oleh user yang sama atau bukan
        if ($post->user_id !== $userId) {
            return response()->json(
                [
                    "message" => "Lu siape?",
                ],
                403,
            );
        }

        $post->update([
            "title" => $request->title,
            "content" => $request->content,
            "category_id" => $categoryId,
        ]);

        return response()->json([
            "message" => "Post Updated!",
            "post" => $post,
        ]);
    }

    // Delete
    public function delete($id)
    {
        $userId = Auth::user()->id;
        $post = Posts::findOrFail($id);
        // Cek Postingan ini dibuat oleh user yang sama atau bukan
        if ($post->user_id !== $userId) {
            return response()->json(
                [
                    "message" => "Lu siape?",
                ],
                403,
            );
        }
        $post->delete();

        return response()->json([
            "message" => "post deleted",
        ]);
    }
}
