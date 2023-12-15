<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use App\Models\Pemain;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'tim' => Tim::all(),
            'pelatih' => Pelatih::all(),
        ];
        return view('Tim.index', $data);
    }

    public function indexCreate()
    {
        $data = [
            'pelatih' => Pelatih::all(),
        ];
        return view('Tim.tambah', $data);
    }

    /**
     * Menampilkan halaman detail tim
     */
    public function indexDetail(Request $request)
    {
        $data = [
            'tim' => Tim::where('id_tim', $request->id)->first(),
            'pelatih' => Pelatih::all(),
            'pemain' => Pemain::all(),
            'user' => User::all(),
        ];

        return view('Tim.detail', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'nik_pelatih' => ['required'],
            'nama_tim' => ['required'],
            'deskripsi_tim' => ['required'],

            'foto_tim' => ['nullable'],
        ]);

        // Memanggil fungsi untuk mendapatkan ID kustom
        $customId = DB::selectOne("SELECT function_id_tim() as custom_id")->custom_id;
        $data['id_tim'] = $customId;

        $path = $request->file('foto_tim')->storePublicly('foto_tim', 'public');
        $data['foto_tim'] = $path;

        $tim = new Tim($data);
        $tim->save();

        return redirect('/tim')
            ->with('success', 'Tim berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $data = $request->validate([
            'nama_tim' => ['required'],
            'nik_pelatih' => ['required'],
            'deskripsi_tim' => ['required'],
            'foto_tim' => ['nullable'],
        ]);

        $tim = Tim::query()->find($request->input('id_tim'));

        if ($request->hasFile('foto_tim')) {
            Storage::disk('public')->delete($tim->foto_tim);
            $path = $request->file('foto_tim')->storePublicly('foto_tim', 'public');
            $data['foto_tim'] = $path;
            $tim->foto_tim = $path;
        }

        $tim->update($data);

        return redirect()->to('/tim')->with('success', 'Tim Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Tim $tim, Request $request)
    {
        //
        $idTim = $request->id;

        $tim = Tim::where('id_tim', $idTim)->first();

        if ($tim) {

            //hapus foto tim
            if ($tim->foto_tim) {
                Storage::disk('public')->delete($tim->foto_tim);
            }

            //menghapus tim
            $tim->delete();

            $pesan = [
                'success' => true,
                'pesan' => 'Tim berhasil dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'tim gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }

    public function createAnggota(Request $request)
    {
        $data = $request->validate([
            'nisn_pemain' => ['required'],
            'id_tim' => ['required'],
        ]);

        $tim = Tim::find($data['id_tim']);
        $pemain = Pemain::find($data['nisn_pemain']);

        $tim->pemain()->save($pemain);

        // return redirect('/tim/detail/{id}')->with('success', 'Anggota tim berhasil ditambahkan');

        return response()->json(['message' => $tim->pemain()]);
    }

    public function deleteAnggota(Tim $tim, Request $request)
    {
        $this->validate($request, [
            'nisn_pemain' => 'required'
        ]);

        $pemain = Pemain::find($request->nisn_pemain);

        if ($pemain) {
            $pemain->update(['id_tim' => null]); // Dissociate the Pemain from Tim
            return response()->json(['success' => true, 'pesan' => 'Pemain berhasil dihapus dari anggota tim']);
        } else {
            return response()->json(['success' => false, 'pesan' => 'Gagal menghapus pemain dari anggota tim']);
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
    public function show(Tim $tim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tim $tim)
    {
        //
    }
}
