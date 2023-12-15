<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use App\Models\Tim;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengirim variabel data ke view dalam isi array data pelatih dan user
        $data = [
            'pelatih' => Pelatih::all(),
            'user' => User::all()
        ];
        return view('Pelatih.index', $data);
    }

    /**
     * Menampilkan halaman tambah pelatih
     */
    public function indexCreate()
    {
        return view('Pelatih.tambah');
    }

    /**
     * Menampilkan halaman detail pelatih
     */
    public function indexDetail(Request $request)
    {
        $data = [
            'pelatih' => Pelatih::where('nik_pelatih', $request->id)->first(),
            'tim' => Tim::all(),
        ];

        // dd($data);

        return view('Pelatih.detail', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $data = $request->validate([
            // Menambah ke tabel pelatih
            'nik_pelatih' => ['required'],
            'nama_pelatih' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'deskripsi_pelatih' => ['nullable'],

            // Menambah ke tabel user
            'username' => ['nullable'],
            'password' => ['required'],
            'role' => ['required'],
            'foto_profil' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        //Upload foto profil
        $path = $request->file("foto_profil")->storePublicly("foto_profil", "public");
        $data['foto_profil'] = $path;

        //hash password
        $data['password'] = Hash::make($data['password']);

        DB::transaction(function () use ($data) {
            $user = new User([
                'username' => $data['username'],
                'password' => $data['password'],
                'role' => $data['role'],
                'foto_profil' => $data['foto_profil']
            ]);

            $user->save();

            $pelatih = new Pelatih($data);
            $pelatih->id_user = $user->id_user;
            $pelatih->save();
        });

        return redirect('/pelatih')
            ->with('success', 'User baru berhasil ditambahkan!');
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
    public function show(Pelatih $pelatih)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
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

        return redirect()->to('/pelatih')->with('success', 'Pelatih Berhasil Diupdate');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelatih $pelatih)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Pelatih $pelatih, Request $request)
    {
        //

        $nik = $request->id;

        $pelatih = Pelatih::where('nik_pelatih', $nik)->first();

        if ($pelatih) {

            //hapus foto profil
            if ($pelatih->user->foto_profil) {
                Storage::disk('public')->delete($pelatih->user->foto_profil);
            }

            //menghapus pelatih
            $pelatih->delete();

            //menghapus user
            $user = User::where('id_user', $pelatih->id_user)->first();
            if ($user) {
                $user->delete();
            }

            $pesan = [
                'success' => true,
                'pesan' => 'Pelatih Berhasil Dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Pelatih Gagal Dihapus'
            ];
        }

        return response()->json($pesan);
    }

    /**
     * Menampilkan halaman cetak data pelatih
     */
    public function cetakPelatih()
    {
        $data = [
            'pelatih' => Pelatih::get(),
            'user' => User::get()
        ];
        return view('Pelatih.cetak', $data);
    }

    public function print()
    {
        $data = Pelatih::limit(10)->get();
        $pdf = PDF::loadView('pelatih.cetak', compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('daftar-pelatih.pdf');
    }
}
