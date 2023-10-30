<?php

namespace App\Http\Controllers;


use id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Models\sampah_mapel;

class portalController extends Controller
{
    public function index()
    {
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        if($user->role)
        {
            return view('portal.profil.index', compact('user'));
        }
    }
    public function mapel()
    {
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        $mapel = DB::table('mapel')->where('id_kelas', $user->id_kelas)->get();
        $semuaguru = DB::table('users')->where('role', 'guru')->get();
        $semuakelas = DB::table('kelas')->get();
        if($user->role === 'murid')
        {
            return view('portal.mapel.index', compact('user', 'mapel','semuaguru','semuakelas'));
        }
        else if($user->role === 'guru')
        {
            $ajarmapel = DB::table('mapel')->where('id_guru', $user->id)->get();
            return view('portal.mapel.index', compact('user', 'ajarmapel','semuaguru','semuakelas'));
        }
        else if($user->role === 'superadmin'||$user->role=='admin')
        {
            return view('portal.mapel.index', compact('user','semuakelas'));
        }
        else
        {
            return view('portal.mapel.index', compact('user'));
        }
    }
    public function mapelfromkelas($id)
    {
        if($id)
        {
            session(['lihatkelas' => $id]);
        }
        return redirect()->to("/mapel/index");
    }
    public function mapelindex(){
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        $semuaguru = DB::table('users')->where('role', 'guru')->get();
        $semuakelas = DB::table('kelas')->get();
        $allmapel = DB::table('mapel')->get();
        return view('portal.mapel.lihat', compact('user','semuakelas','semuaguru','allmapel'));
    }
    public function mapeldetail($id)
    {
        $decryptedid = Crypt::decrypt($id);
        session(['detail' => $decryptedid]);
        return redirect()->to("/mapel/detail");
    }
    public function mapeldetailindex()
    {
        $iddetail=session('detail');
        session()->forget('detail');
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        $mapel = DB::table('mapel')->where('id', $iddetail)->first();
        if(!$mapel)
        {
            return redirect()->to("/mapel");
        }
        else
        {
            $guru = DB::table('users')->where('id', $mapel->id_guru)->first();
            $kelas = DB::table('kelas')->where('id', $mapel->id_kelas)->first();
            return view('portal.mapel.detail', compact('user','mapel','guru','kelas'));
        }

    }
    public function mapeledit($id)
    {
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        if ($user->role=='superadmin'||$user->role=='admin'){
            try {
                $decryptedId = Crypt::decrypt($id);
                session(['edit' => $decryptedId]);
                return redirect()->to("/mapel/edit");
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return redirect()->to("/mapel/edit");
            }
        }
        return redirect()->to("/mapel");
    }
    public function mapeleditindex()
    {
        $id_edit=session('edit');
        session()->forget('edit');
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        $mapel = DB::table('mapel')->where('id', $id_edit)->first();
        if(!$mapel)
        {
            return redirect()->to("/mapel");
        }
        else
        {
            $gurusekarang= DB::table('users')->where('id', $mapel->id_guru)->first();
            $kelassekarang = DB::table('kelas')->where('id', $mapel->id_kelas)->first();
            $semuakelas = DB::table('kelas')->get();
            $semuaguru = DB::table('users')->where('role', 'guru')->get();
            return view('portal.mapel.edit', compact('user','mapel','gurusekarang','kelassekarang','semuakelas','semuaguru'));
        }
    }
    public function mapeleditfinal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namamapel' => [
                'required',
                'string',
            ],
            'id_guru' => [
                'required',
                'integer',
            ],
            'id_kelas' => [
                'required',
                'integer',
            ],
            'deskripsi' => [
                'required',
                'string',
            ],
        ]);

        if ($validator->fails()) {
            $errorMessage = 'Gagal merubah data, karena data berikut ini kosong: ';
            if (!$request->filled('namamapel')) {
                $errorMessage .= 'Nama Mapel, ';
            }
            if (!$request->filled('id_guru')) {
                $errorMessage .= 'ID Guru, ';
            }
            if (!$request->filled('id_kelas')) {
                $errorMessage .= 'ID Kelas, ';
            }
            if (!$request->filled('deskripsi')) {
                $errorMessage .= 'Deskripsi, ';
            }
            $errorMessage = rtrim($errorMessage, ', ');
            session(['error' => $errorMessage]);
            return redirect()->to('/mapel/index/'.$request->input('id'));
        }
        $data = [
            'namamapel' => $request->input('namamapel'),
            'id_guru' => $request->input('id_guru'),
            'id_kelas' => $request->input('id_kelas'),
            'deskripsi' => $request->input('deskripsi'),
        ];
        DB::table('mapel')->where('id', $request->input('id'))->update($data);
        $id_user=session('user_id');
        session(['success' => 'Berhasil Mengubah data']);
        return redirect()->to('/mapel/index/'.$request->input('id_kelas'));
    }
    public function mapeldelete($id)
    {
        $decryptedid = Crypt::decrypt($id);
        $mapel = DB::table('mapel')->where('id', $decryptedid)->first();
        $id_kelas=$mapel->id_kelas;
        session(['success' => 'Berhasil mengapus mata pelajaran '.$mapel->namamapel]);
        $condition = ['id_mapel' => $mapel->id];
        $data = [
            'namamapel' => $mapel->namamapel,
            'id_guru' => $mapel->id_guru,
            'id_kelas' => $mapel->id_kelas,
            'deskripsi' => $mapel->deskripsi,
            'id_penghapus' => session('user_id'),
        ];
        sampah_mapel::updateOrCreate($condition, $data);
        DB::table('mapel')->where('id', $decryptedid)->delete();
        return redirect()->to('/mapel/index/'.$id_kelas);
    }
    public function newmapelcheck($id){
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        if ($user->role=='superadmin'||$user->role=='admin'){
            return redirect()->to("/mapel/baru");
        }
        return redirect()->to("/mapel/");
    }
    public function newmapel(){
        $semuakelas = DB::table('kelas')->get();
        $semuaguru = DB::table('users')->where('role', 'guru')->get();
        $user = DB::table('users')->where('id', session('user_id'))->first();
        return view('portal.mapel.create', compact('user','semuakelas','semuaguru'));
    }
    public function newmapelindex(Request $request){
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        if ($user->role=='guru'||$user->role=='murid'){
            return redirect()->back();
        }
        $validator = Validator::make($request->all(), [
            'namamapel' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
            'id_guru' => [
                'required',
                'integer',
            ],
            'id_kelas' => [
                'required',
                'integer',
            ],
            'deskripsi' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->with('error', 'Input tidak valid. Pastikan tidak ada karakter khusus dan tidak kosong.')
            ->withErrors($validator)
            ->withInput();
        }
        $data = [
            'namamapel' => $request->input('namamapel'),
            'id_guru' => $request->input('id_guru'),
            'id_kelas' => $request->input('id_kelas'),
            'deskripsi' => $request->input('deskripsi'),
        ];
        DB::table('mapel')->where('id', $request->input('id'))->insert($data);
        $id_user=session('user_id');
        session(['success' => 'Berhasil Menambah data']);
        return redirect()->to('/mapel/index/'.$request->input('id_kelas'));
    }


}