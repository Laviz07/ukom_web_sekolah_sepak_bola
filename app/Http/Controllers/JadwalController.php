<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'jadwal' => Jadwal::all()
        ];
        return view("Jadwal.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function indexDetail(Request $request)
    {
        $data = [
            'jadwal' => Jadwal::where('tanggal_kegiatan', $request->id)->first()
        ];

        return view('jadwal.detail', $data);
    }

    public function indexCreate()
    {
        return view('Jadwal.tambah');
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            // Menambah ke tabel jadwal
            'tanggal_kegiatan' => ['required'],
            'judul_kegiatan' => ['required']
        ]);

        $dataInsert = Jadwal::create($data);
        if ($dataInsert) {
            return redirect()->to('/jadwal')->with('success', 'Jadwal berhasil ditambah');
        }
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
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $data = $request->validate([
            'id_jadwal' => ['required'],
            'tanggal_kegiatan' => ['required'],
            'judul_kegiatan' => ['required']
        ]);

        $jadwal = Jadwal::where('id_jadwal', $request->input('id_jadwal'))->first();
        $jadwal->fill($data);
        $jadwal->save();

        return redirect()->to('/jadwal')->with('success', 'jadwal Berhasil Diupdate');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Jadwal $jadwal, Request $request)
    {

        $id = $request->id;

        $jadwal = Jadwal::where('id_jadwal', $id)->first();

        if ($jadwal) {

            // //hapus foto profil
            // if ($admin->user->foto_profil) {
            //     Storage::disk('public')->delete($admin->user->foto_profil);
            // }



            //menghapus user
            $jadwal = Jadwal::where('id_jadwal', $jadwal->id_jadwal)->first();
            if ($jadwal) {
                $jadwal->delete();
            }

            $pesan = [
                'success' => true,
                'pesan' => 'Admin Berhasil Dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Admin Gagal Dihapus'
            ];
        }

        return response()->json($pesan);
    }

    // public function indexDetail($jadwal) {
    //     $jadwal = Kegiatan::where('tanggal_kegiatan', $jadwal)->get();
    //     return view('jadwal.kegiatan', compact('activities', 'tanggal'));
    // }

    public function cetakJadwal()
    {
        $data = [
            'jadwal' => jadwal::get()
        ];
        return view('Jadwal.cetak', $data);
    }

    public function print()
    {
        $data = Jadwal::limit(10)->get();
        $pdf = PDF::loadView('jadwal.cetak', compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('daftar-jadwal.pdf');
    }
}
