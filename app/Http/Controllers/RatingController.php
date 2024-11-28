<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_seller' => 'required',
            'id_pesanan' => 'required',
            'rating' => 'required|integer',
            'ulasan' => 'required|string',
        ]);

        $RatingData = [
            'id_user' => $request->input('id_user'),
            'id_seller' => $request->input('id_seller'),
            'id_pesanan' => $request->input('id_pesanan'),
            'rating' => $request->input('rating'),
            'ulasan' => $request->input('ulasan'),
        ];

        if ($request->filled('id')) {
            $Rating = Rating::find($request->input('id'));
            if (!$Rating) {
                return response()->json(['message' => 'Rating not found'], 404);
            }

            $Rating->update($RatingData);
            return back();
        } else {
            Rating::create($RatingData);
            return back();
        }
    }
    public function destroy($id)
    {
        $Ratings = Rating::find($id);

        if (!$Ratings) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        $Ratings->delete();

        return response()->json(['message' => 'Rating deleted successfully']);
    }
    public function edit($id)
    {
        $Rating = Rating::find($id);

        if (!$Rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        return response()->json($Rating);
    }
}
