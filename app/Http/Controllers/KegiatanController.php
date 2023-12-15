<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Pelatih;
use Illuminate\Support\Facades\DB;
use Storage;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'jadwal' => Jadwal::where('id_jadwal', $request->id)->first(),
            'kegiatan' => Kegiatan::all(),
            'pelatih' => Pelatih::all(),
        ];

        return view('Kegiatan.index', $data);
    }

    public function indexCreate(Request $request)
    {
        $data = [
            'jadwal' => Jadwal::where('id_jadwal', $request->id)->first(),
            'pelatih' => Pelatih::all(),
        ];
        return view('Kegiatan.tambah', $data);
    }

    public function indexDetail(Request $request)
    {
        $data = [
            'kegiatan' => Kegiatan::where('id_kegiatan', $request->id)->first(),
            'pelatih' => Pelatih::all(),
        ];
        return view('Kegiatan.detail', $data);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            // Menambah ke tabel pelatih
            'nik_pelatih' => ['required'],
            'nama_kegiatan' => ['required'],
            'id_jadwal' => ['required'],
            'tipe_kegiatan' => ['required'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required'],
            'foto_kegiatan' => ['nullable'],
            'detail_kegiatan' => ['required'],
            // 'laporan_kegiatan' => ['required'],

        ]);

         // Memanggil fungsi untuk mendapatkan ID kustom
         $customId = DB::selectOne("SELECT function_id_kegiatan() as custom_id")->custom_id;
         $data['id_kegiatan'] = $customId;

        //Upload foto kegiatan
        if ($request->hasFile('foto_kegiatan')) {
            $path = $request->file("foto_kegiatan")->storePublicly("foto_kegiatan", "public");
            $data['foto_kegiatan'] = $path;
        };

        $kegiatan = new Kegiatan($data);
        $kegiatan->save();

        if ($kegiatan) {
            $pesan = [
                'success' => true,
                'pesan' => 'Kegiatan berhasil ditambah'
            ];
        } else {
            $pesan = [
                'success' => true,
                'pesan' => 'Kegiatan gagal ditambah'
            ];
        }

        return response()->json($pesan);
    }

    public function createLaporan(Request $request)
    {
        $data = $request->validate([
            'laporan_kegiatan' => ['required'],
        ]);

        $kegiatan = Kegiatan::find($request->input('id_kegiatan'));

        $kegiatan->laporan_kegiatan = $data['laporan_kegiatan'];
        $kegiatan->save();

        if ($kegiatan) {
            $pesan = [
                'success' => true,
                'pesan' => 'Laporan Kegiatan berhasil ditambah'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Laporan Kegiatan gagal ditambah'
            ];
        }

        return response()->json($pesan);
    }

    public function edit(Request $request)
    {
        $data = $request->validate([
            'nik_pelatih' => ['required'],
            'nama_kegiatan' => ['required'],
            'id_jadwal' => ['required'],
            'tipe_kegiatan' => ['required'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required'],
            'detail_kegiatan' => ['required'],
            'foto_kegiatan' => ['nullable']
        ]);

        $kegiatan = Kegiatan::find($request->input('id_kegiatan'));

        if ($request->hasFile('foto_kegiatan')) {
            Storage::disk('public')->delete($kegiatan->foto_kegiatan);
            $path = $request->file('foto_kegiatan')->storePublicly('foto_kegiatan', 'public');
            $data['foto_kegiatan'] = $path;
            $kegiatan->foto_kegiatan = $path;
        }

        $kegiatan->fill($data);

        if ($kegiatan->save()) {
            return response()->json(['success' => true, 'pesan' => 'Kegiatan berhasil diedit']);
        } else {
            return response()->json(['success' => false, 'pesan' => 'Kegiatan gagal diedit']);
        }
    }

    public function delete(Kegiatan $kegiatan, Request $request)
    {
        $idKegiatan = $request->id;

        $kegiatan = Kegiatan::where('id_kegiatan', $idKegiatan)->first();

        if ($kegiatan) {

            // //hapus foto profil
            // if ($admin->user->foto_profil) {
            //     Storage::disk('public')->delete($admin->user->foto_profil);
            // }

            $kegiatan = Kegiatan::where('id_kegiatan', $kegiatan->id_kegiatan)->first();
            if ($kegiatan) {
                $kegiatan->delete();
            }

            $pesan = [
                'success' => true,
                'pesan' => 'Kegiatan Berhasil Dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Kegiatan Gagal Dihapus'
            ];
        }

        return response()->json($pesan);
    }
}
