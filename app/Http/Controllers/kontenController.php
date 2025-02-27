<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Userkonten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class kontenController extends Controller
{
    public function index()
    {
        $TugasKonten = Konten::all();
        return view('tugaskonten.index', ['TugasKontens' => $TugasKonten]);
    }

    public function create()
    {
        return view('tugaskonten.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        \App\Models\Konten::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('tugaskonten.index');
    }

    public function userkonten($id) {
        $userkonten = \App\Models\Userkonten::with('kontentugas')->where('tourguide_id', $id)->get();

        // return response()->json($userkonten);
        return view('tugaskonten.kontendetailuser', ['userkontens' => $userkonten]);
    }

    public function detailuserkonten($id) {
        $userkonten = Userkonten::with('kontentugas')->where('id', $id)->firstOrFail();

        // return response()->json($userkonten);
        return view('tugaskonten.detailuserkonten', ['detailkonten' => $userkonten], compact('id')) ;
    }
}
