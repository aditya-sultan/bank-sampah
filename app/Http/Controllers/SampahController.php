<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Sampah;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();

        $sampah = Sampah::paginate(15);

        return view('pages.sampah.index', compact('jenis', 'sampah'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_jenis' => 'required',
            'nama' => 'required',
            'foto' => 'nullable',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);

        $picture_file = $request->file('foto');
        $picture_extension = $picture_file->extension();
        $picture_name = "Picture-"  . date('ymdhis') . "." .$picture_extension;
        $picture_file->move(public_path('image'), $picture_name);

        $validateData['foto'] = $picture_name;

        Sampah::create($validateData);

        return redirect()->back()->with('success', 'data telah ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'id_jenis' => 'required',
            'nama' => 'required',
            'foto' => 'nullable',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);

        $sampah = Sampah::find($id);

        if ($request->hasFile('foto')) {
            $picture_file = $request->file('foto');
            if ($picture_file->isValid()) {
                $picture_extension = $picture_file->extension();
                $picture_name = "Picture-" . date('ymdhis') . "." . $picture_extension;
                $picture_file->move(public_path('image'), $picture_name);

                // Hapus gambar lama jika berhasil mengunggah gambar baru
                File::delete(public_path('image') . '/' . $sampah->picture);

                $validateData['foto'] = $picture_name;
            } else {
                return redirect()->back()->withInput()->withErrors(['picture' => 'File gambar tidak valid.']);
            }
        }

        $sampah->update($validateData);

        return redirect()->back()->with('success', 'data telah diubah');
    }

    public function destroy(string $id)
    {
        $sampah = Sampah::find($id);

        $sampah->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}