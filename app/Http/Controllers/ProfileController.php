<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getUser($id)
    {
        $user = User::with("posts")->find($id);

        return response()->json([
            'user' => $user,
        ]);
    }
}
