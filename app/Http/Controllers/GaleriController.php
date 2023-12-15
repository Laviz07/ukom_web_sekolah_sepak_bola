<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'galeri' => Galeri::all()
        ];

        // return $data;

        return view("Galeri.index", $data);
    }

    /**
     * Menampilkan halaman tambah foto untuk galeri
     */
    public function indexCreate()
    {
        return view('Galeri.tambah');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $data = $request->validate([
            'foto' => ['required'],
            'keterangan_foto' => ['required'],
        ]);

        // Memanggil fungsi untuk mendapatkan ID kustom
        $customId = DB::selectOne("SELECT function_id_galeri() as custom_id")->custom_id;
        $data['id_galeri'] = $customId;

        $path = $request->file('foto')->storePublicly('foto_galeri', 'public');
        $data['foto'] = $path;

        $galeri = Galeri::create($data);
        $galeri->save();

        return redirect('/galeri')
            ->with('success', 'Foto berhasil ditambahkan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $idGaleri = $request->id; // Ubah menjadi idGaleri sesuai dengan variabel yang Anda gunakan di route.

        // Cari galeri berdasarkan ID
        $galeri = Galeri::find($idGaleri);

        if (!$galeri) {
            // Jika galeri tidak ditemukan, kirimkan pesan kesalahan
            $pesan = [
                'success' => false,
                'pesan' => 'Foto tidak ditemukan'
            ];
        } else {
            // Hapus foto dari penyimpanan
            Storage::disk('public')->delete($galeri->foto);

            // Hapus galeri dari database
            $galeri->delete();

            $pesan = [
                'success' => true,
                'pesan' => 'Foto berhasil dihapus'
            ];
        }

        return response()->json($pesan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'keterangan_foto' => ['nullable'],
            'foto' => ['nullable'],
        ]);


        $galeri = Galeri::find($request->input('id_galeri'));

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($galeri->foto);
            $path = $request->file('foto')->store('foto_galeri', 'public');
            $galeri->foto = $path;
        }

        $galeri->keterangan_foto = $request->input('keterangan_foto');
        $galeri->save();

        return redirect()->to('/galeri')->with('success', 'Galeri berhasil diupdate');
        // return response()->json($galeri);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        //
    }
}
