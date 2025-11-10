<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

abstract class Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view('siswa.index', compact('siswas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'kelas' => 'required|string|max:10',
            'alamat' => 'required|string|max:255',
        ]);

        Siswa::create($validatedData);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required|string|max:10',
            'alamat' => 'required|string|max:255',
        ]);

        $siswa->update($validatedData);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
