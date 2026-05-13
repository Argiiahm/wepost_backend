<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use Illuminate\Http\Request;

class FavoritController extends Controller
{


    public function ActivityFavorit(Request $request)
    {
        $user = $request->user();

        $ActivityFavs = Favorit::where('user_id', $user->id)
            ->with('post')
            ->get();

        return response()->json($ActivityFavs);
    }


    public function Favorit(Request $request, $id)
    {
        $user = $request->user();

        // Check if the user has already favorit the post
        $favorit = Favorit::where('user_id', $user->id)->where('post_id', $id)
            ->first();

        if ($favorit) {
            // If the favorit exists, remove it
            $favorit->delete();
            return response()->json([
                'message' => 'unFav',
                'isFav' => false
            ]);
        } else {
            // If the fav does not exist, create it
            Favorit::create([
                "user_id"   =>   $user->id,
                "post_id"   =>   $id
            ]);
            return response()->json([
                'message' => 'Fav',
                'isFav' => true
            ]);
        }
    }
}
