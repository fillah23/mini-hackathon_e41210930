<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use Illuminate\Http\Request;

class BudayaController extends Controller
{
    public function index()
    {
        $budayas = Budaya::all();
        return view('backend.budaya.index', compact('budayas'));
    }

    public function create()
    {
        return view('backend.budaya.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'tahun_ditemukan' => 'required',
        ]);

        Budaya::create($request->all());

        return redirect()->route('budaya.index')
            ->with('success', 'Data Budaya baru telah berhasil disimpan');
    }

    public function edit($id)
    {
        $budaya = Budaya::find($id);
        return view('backend.budaya.edit', compact('budaya'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'tahun_ditemukan' => 'required',
        ]);

        $budaya = Budaya::find($id);
        $budaya->update($request->all());

        return redirect()->route('budaya.index')
            ->with('success', 'Data Budaya telah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $budaya = Budaya::find($id);
        $budaya->delete();

        return redirect()->route('budaya.index')
            ->with('success', 'Data Budaya telah berhasil dihapus');
    }
}
