<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Galeri;
use App\Models\logs;
use App\Models\Tim;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Berita;
use App\Models\Pelatih;
use App\Models\Pemain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [
            'tim' => Tim::all(),
            'pelatih' => Pelatih::all(),
            'pemain' => Pemain::all(),
            'admin' => Admin::all(),
            'user' => Auth::user(),
        ];

        // dd($data);

        return view('Profil.index', $data);
    }

    public function editPemain(Request $request)
    {
        //
        $data = $request->validate([
            'nama_pemain' => ['required'],
            'alamat' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],
            'deskripsi_pemain' => ['nullable']
        ]);

        $pemain = Pemain::where('nisn_pemain', $request->input('nisn_pemain'))->first();
        $pemain->fill($data);
        $pemain->save();

        // dd($pemain);

        return redirect()->to('/profil')->with('success', 'Profil Berhasil Diupdate');
    }


    public function editPelatih(Request $request)
    {
        //
        $data = $request->validate([
            'nama_pelatih' => ['required'],
            'alamat' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],
            'deskripsi_pelatih' => ['nullable']
        ]);

        $pelatih = Pelatih::where('nik_pelatih', $request->input('nik_pelatih'))->first();
        $pelatih->fill($data);
        $pelatih->save();

        return redirect()->to('/profil')->with('success', 'Pelatih Berhasil Diupdate');
    }
}
