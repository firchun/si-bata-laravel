<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAdmin;
use App\Models\BankSeller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Bank'
        ];
        return view('admin.bank.index', $data);
    }
    public function admin()
    {
        $data = [
            'title' => 'Data Bank Admin'
        ];
        return view('admin.bank_admin.index', $data);
    }
    public function seller()
    {
        $data = [
            'title' => 'Data Bank Seller'
        ];
        return view('admin.bank_seller.index', $data);
    }
    public function getBankDataTable()
    {
        $bank = Bank::orderByDesc('id');

        return DataTables::of($bank)
            ->addColumn('action', function ($bank) {
                return view('admin.bank.components.actions', compact('bank'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getBankAdminDataTable()
    {
        $bank = BankAdmin::orderByDesc('id');

        return DataTables::of($bank)
            ->addColumn('action', function ($bank) {
                return view('admin.bank_admin.components.actions', compact('bank'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getBankSellerDataTable()
    {
        $bank = BankSeller::with(['seller', 'bank'])->orderByDesc('id');

        return DataTables::of($bank)
            ->addColumn('action', function ($bank) {
                return view('admin.bank_seller.components.actions', compact('bank'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'bank' => 'required|string|max:255',
            'warna' => 'required|string|max:20',
        ]);

        $bankData = [
            'bank' => $request->input('bank'),
            'warna' => $request->input('warna'),
        ];

        if ($request->filled('id')) {
            $Bank = Bank::find($request->input('id'));
            if (!$Bank) {
                return response()->json(['message' => 'Bank not found'], 404);
            }

            $Bank->update($bankData);
            $message = 'Bank updated successfully';
        } else {
            Bank::create($bankData);
            $message = 'Bank created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function store_admin(Request $request)
    {
        $request->validate([
            'id_bank' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'no_rek' => 'required|string|max:20',
        ]);

        $bankData = [
            'id_bank' => $request->input('id_bank'),
            'nama' => $request->input('nama'),
            'no_rek' => $request->input('no_rek'),
        ];

        if ($request->filled('id')) {
            $Bank = BankAdmin::find($request->input('id'));
            if (!$Bank) {
                return response()->json(['message' => 'Bank not found'], 404);
            }

            $Bank->update($bankData);
            $message = 'Rekening updated successfully';
        } else {
            BankAdmin::create($bankData);
            $message = 'Rekening created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function store_seller(Request $request)
    {
        $request->validate([
            'id_seller' => 'required|string|max:255',
            'id_bank' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'no_rek' => 'required|string|max:20',
        ]);

        $bankData = [
            'id_seller' => $request->input('id_seller'),
            'id_bank' => $request->input('id_bank'),
            'nama' => $request->input('nama'),
            'no_rek' => $request->input('no_rek'),
        ];

        if ($request->filled('id')) {
            $Bank = BankSeller::find($request->input('id'));
            if (!$Bank) {
                return response()->json(['message' => 'Bank not found'], 404);
            }

            $Bank->update($bankData);
            $message = 'Rekening updated successfully';
        } else {
            BankSeller::create($bankData);
            $message = 'Rekening created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $bank = Bank::find($id);

        if (!$bank) {
            return response()->json(['message' => 'bank not found'], 404);
        }

        $bank->delete();

        return response()->json(['message' => 'bank deleted successfully']);
    }
    public function destroy_admin($id)
    {
        $bank = BankAdmin::find($id);

        if (!$bank) {
            return response()->json(['message' => 'bank not found'], 404);
        }

        $bank->delete();

        return response()->json(['message' => 'bank deleted successfully']);
    }
    public function edit($id)
    {
        $Bank = Bank::find($id);

        if (!$Bank) {
            return response()->json(['message' => 'Bank not found'], 404);
        }

        return response()->json($Bank);
    }
    public function edit_admin($id)
    {
        $Bank = BankAdmin::find($id);

        if (!$Bank) {
            return response()->json(['message' => 'Rekening not found'], 404);
        }

        return response()->json($Bank);
    }
}
