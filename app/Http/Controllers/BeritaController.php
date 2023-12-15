<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'berita' => Berita::all(),
            'user' => User::all()
        ];
        return view('Berita.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function indexCreate()
    {
        return view('Berita.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        //
        $data = $request->validate([
            'judul_berita' => ['required'],
            'isi_berita' => ['required'],
            'foto_berita' => ['required'],
            'nik_admin' => ['required'],
        ]);

        // Memanggil fungsi untuk mendapatkan ID kustom
        $customId = DB::selectOne("SELECT function_id_berita() as custom_id")->custom_id;
        $data['id_berita'] = $customId;

        $path = $request->file('foto_berita')->storePublicly('foto_berita', 'public');
        $data['foto_berita'] = $path;

        $nik_admin = $request->input('nik_admin');
        $admin = Admin::where('nik_admin', $nik_admin)->first();

        if ($admin) {
            $berita = new Berita($data);
            $berita->admin()->associate($admin);
            $berita->save();

            return redirect('/berita')
                ->with('success', 'Berita berhasil ditambahkan');

            // response()->json([$data]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function delete(Request $request)
    {
        $id_berita = $request->id; // Ubah menjadi idBerita sesuai dengan variabel yang Anda gunakan di route.

        // Cari berita berdasarkan ID
        $berita = Berita::find($id_berita);

        if ($berita->foto_berita) {
            Storage::disk('public')->delete($berita->foto_berita);
        }

        if (!$berita) {
            // Jika berita tidak ditemukan, kirimkan pesan kesalahan
            $pesan = [
                'success' => false,
                'pesan' => 'Berita tidak ditemukan'
            ];
        } else {
            // Hapus berita dari penyimpanan
            Storage::disk('public')->delete($berita->id_berita);

            // Hapus berita dari database
            $berita->delete();

            $pesan = [
                'success' => true,
                'pesan' => 'Berita berhasil dihapus'
            ];
        }

        return response()->json($pesan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Berita $berita)
    {
        //
        $data = $request->validate([
            'judul_berita' => ['required'],
            'foto_berita' => ['nullable'],
            'isi_berita`' => ['nullable']
        ]);

        $berita = Berita::where('id_berita', $request->input('id_berita'));
        // Cek apakah pengguna mengunggah foto berita baru
        if ($request->hasFile('foto_berita')) {
            // Storage::disk('public')->delete($berita->foto_berita);
            $path = $request->file('foto_berita')->storePublicly('foto_berita', 'public');
            $data['foto_berita'] = $path;
            $berita->foto_berita = $path;
        }

        $berita->update($data);
        // $berita->save();

        return redirect()->to('/berita')->with('success', 'Berita berhasil diupdate');
    }

    /**
     * Update the specified resource in storage.
     */
    public function indexDetail(Request $request)
    {
        $data = [
            'berita' => Berita::where('id_berita', $request->id)->first()
        ];

        return view('Berita.detail', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        //
    }
}
