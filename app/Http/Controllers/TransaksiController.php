<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $transaksi = Transaksi::where('id_user', $user->id)->paginate(8);

        return view('pages.transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_user' => 'required',
            'id_sampah' => 'required',
            'qty' => 'required',
        ]);

        $sampah = Sampah::find($request->id_sampah);

        $validateData['total'] = $sampah->harga * $request->qty;

        Transaksi::create($validateData);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::find($id);

        return view('pages.transaksi.invoice', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sampah()
    {
        $sampah = Sampah::paginate(15);

        return view('pages.transaksi.sampah', compact('sampah'));
    }

    public function riwayat()
    {
        $transaksi = Transaksi::paginate(8);

        return view('pages.transaksi.riwayat', compact('transaksi'));
    }
}