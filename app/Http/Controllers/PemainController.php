<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PemainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengirimkan data ke view dengan isi array data user dan pemain
        $data = [
            'pemain' => Pemain::all(),
            'user' => User::all()
        ];
        return view('Pemain.index', $data);
    }

    /**
     * Menampilkan halaman tambah pemain
     */
    public function indexCreate()
    {
        return view('Pemain.tambah');
    }

    /**
     * Menampilkan halaman detail pemain
     * mengirimkan data ke view dengan isi array data user dan pemain
     */
    public function indexDetail(Request $request)
    {
        $data = [
            'pemain' => Pemain::where('nisn_pemain', $request->id)->first(),
            'tim' => Tim::all()
        ];

        return view('Pemain.detail', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $data = $request->validate([
            // Menambah ke tabel pemain
            'nisn_pemain' => ['required'],
            'nama_pemain' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'no_punggung' => ['required'],
            'posisi' => ['required'],
            'kategori_umur' => ['required'],
            'deskripsi_pemain' => ['nullable'],

            // Menambah ke tabel user
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required'],
            'foto_profil' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        //Upload foto profil
        $path = $request->file("foto_profil")->storePublicly("foto_profil", "public");
        $data['foto_profil'] = $path;

        //hash password
        $data['password'] = Hash::make($data['password']);

        // Get the current user
        // $user = Auth::user();

        //menggabungkan data pemain dan user
        DB::transaction(function () use ($data) {
            $user = new User([
                'username' => $data['username'],
                'password' => $data['password'],
                'role' => $data['role'],
                'foto_profil' => $data['foto_profil']
            ]);

            $user->save();

            $pemain = new Pemain($data);
            $pemain->id_user = $user->id_user;
            $pemain->save();
        });

        return redirect('/pemain')
            ->with('success', 'User baru berhasil ditambahkan!');
    }

    /**
     * edit the specified resource.
     */
    public function edit(Request $request)
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

        return redirect()->to('/pemain')->with('success', 'Pemain Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Pemain $pemain, Request $request)
    {
        //

        $nisn = $request->id;

        $pemain = Pemain::where('nisn_pemain', $nisn)->first();

        if ($pemain) {

            //hapus foto profil
            if ($pemain->user->foto_profil) {
                Storage::disk('public')->delete($pemain->user->foto_profil);
            }

            //menghapus pemain
            $pemain->delete();

            //menghapus user
            $user = User::where('id_user', $pemain->id_user)->first();
            if ($user) {
                $user->delete();
            }

            $pesan = [
                'success' => true,
                'pesan' => 'Pemain Berhasil Dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Pemain Gagal Dihapus'
            ];
        }

        return response()->json($pesan);
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
    public function show(Pemain $pemain)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemain $pemain)
    {
        //
    }

    public function cetakPemain()
    {
        $data = [
            'pemain' => Pemain::get(),
            'user' => User::get(),
            'tim' => Tim::get()
        ];
        return view('Pemain.cetak', $data);
    }

    public function print()
    {
        $data = Pemain::limit(10)->get();
        $pdf = PDF::loadView('pemain.cetak', compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('daftar-pemain.pdf');
    }
}
