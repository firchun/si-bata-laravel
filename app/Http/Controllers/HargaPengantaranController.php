<?php

namespace App\Http\Controllers;

use App\Models\HargaPengantaran;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class HargaPengantaranController extends Controller
{
    public function index()
    {
        $id_seller = null;
        if (Auth::user()->role == 'Seller') {
            $seller = Seller::where('id_user', Auth::id())->first();
            $id_seller = $seller->id;
        }
        $data = [
            'title' => 'Harga Pengantaran',
            'id_seller' => $id_seller
        ];
        return view('admin.harga_pengantaran.index', $data);
    }
    public function getHargaPengantaranDataTable()
    {
        $user = Auth::user();
        $harga_pengantaran = HargaPengantaran::orderByDesc('id');
        if ($user->role == 'Seller') {
            $seller = Seller::where('id_user', Auth::id())->first();
            $harga_pengantaran->where('id_seller', $seller->id);
        }

        return DataTables::of($harga_pengantaran)
            ->addColumn('action', function ($HargaPengantaran) {
                return view('admin.harga_pengantaran.components.actions', compact('HargaPengantaran'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'harga' => 'required|string|max:20',
            'id_seller' => 'required|string',
        ]);

        $HargaPengantaranData = [
            'area' => $request->input('area'),
            'harga' => $request->input('harga'),
            'id_seller' => $request->input('id_seller'),
        ];

        if ($request->filled('id')) {
            $HargaPengantaran = HargaPengantaran::find($request->input('id'));
            if (!$HargaPengantaran) {
                return response()->json(['message' => 'HargaPengantaran not found'], 404);
            }

            $HargaPengantaran->update($HargaPengantaranData);
            $message = 'HargaPengantaran updated successfully';
        } else {
            HargaPengantaran::create($HargaPengantaranData);
            $message = 'HargaPengantaran created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $harga_pengantaran = HargaPengantaran::find($id);

        if (!$harga_pengantaran) {
            return response()->json(['message' => 'HargaPengantaran not found'], 404);
        }

        $harga_pengantaran->delete();

        return response()->json(['message' => 'HargaPengantaran deleted successfully']);
    }
    public function edit($id)
    {
        $HargaPengantaran = HargaPengantaran::find($id);

        if (!$HargaPengantaran) {
            return response()->json(['message' => 'HargaPengantaran not found'], 404);
        }

        return response()->json($HargaPengantaran);
    }
}
