<?php

namespace App\Http\Controllers;

use App\Models\nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class nilaiController extends Controller
{
    public function index()
    {
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        $allmapelmurid = DB::table('mapel')->where('id_kelas', $user->id_kelas)->get();
        $semuaguru = DB::table('users')->where('role', 'guru')->get();
        $semuakelas = DB::table('kelas')->get();
        $nilaimurid = DB::table('nilai')->where('id_murid', $user->id)->get();
        if($user->role === 'murid')
        {
            return view('portal.nilai.index', compact('user', 'allmapelmurid','semuaguru','semuakelas','nilaimurid'));
        }
        else if($user->role === 'guru')
        {
            $ajarmapel = DB::table('mapel')->where('id_guru', $user->id)->get();
            return view('portal.nilai.index', compact('user', 'ajarmapel','semuaguru','semuakelas'));
        }
        else if($user->role === 'superadmin'||$user->role=='admin')
        {
            return view('portal.nilai.index', compact('user','semuakelas'));
        }
        else
        {
            return view('portal.nilai.index', compact('user'));
        }
    }

    public function kelas($id)
    {
        $user = DB::table('users')->where('id', session('user_id'))->first();
        if($user->role === 'superadmin' || $user->role === 'admin')
        {
            if($id)
            {
                session(['lihatkelas' => $id]);
                return redirect()->to("/nilai/kelas");
            }
        }
        return redirect()->to("/nilai");
    }

    public function showmapelkelas(){
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        if($user->role === 'superadmin' || $user->role === 'admin') {
            $semuaguru = DB::table('users')->where('role', 'guru')->get();
            $semuakelas = DB::table('kelas')->get();
            $allmapel = DB::table('mapel')->get();
            $kelaspilihan = DB::table('kelas')->where('id', session('lihatkelas'))->first();
            return view('portal.nilai.lihat', compact('user', 'semuakelas', 'semuaguru', 'allmapel', 'kelaspilihan'));
        }
        return redirect()->to("/nilai");
    }

    public function mapel($id)
    {
        $iduser=session('user_id');
        $user = DB::table('users')->where('id', $iduser)->first();
        if($user->role === 'superadmin' || $user->role === 'guru'|| $user->role === 'admin') {
            if($id) {
                try {
                    $decryptedid = Crypt::decrypt($id);
                    session(['lihatmapel' => $decryptedid]);
                    return redirect()->to("/nilai/mapel");
                } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                    return redirect()->to("/nilai");
                }
            }
        }
        return redirect()->to("/nilai");
    }

    public function shownilaimapel(){
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        if($user->role == 'murid')
        {
            return redirect()->to("/nilai");
        }
        $mapelpil = DB::table('mapel')->where('id', session('lihatmapel'))->first();
        $kelaspil = DB::table('kelas')->where('id', $mapelpil->id_kelas)->first();
        $allkelas = DB::table('kelas')->get();
        $allmurid = DB::table('users')->where('role', 'murid')->where('id_kelas', $mapelpil->id_kelas)->get();
        $allmapelthisclass = DB::table('mapel')->where('id_kelas', $mapelpil->id_kelas)->get();
        $nilaimapel = DB::table('nilai')->where('id_mapel', $mapelpil->id)->get();
        $allmapelguru = DB::table('mapel')->where('id_guru', $user->id)->get();
        if($user->role=='guru')
        {
            return view('portal.nilai.mapel', compact('user','allmapelguru','mapelpil','allkelas','kelaspil','allmurid','nilaimapel'));

        }
        return view('portal.nilai.mapel', compact('user','allmapelthisclass','mapelpil','kelaspil','allmurid','nilaimapel'));
    }

    public function editnilai($idmurid,$idmapel)
    {
        $iduser=session('user_id');
        $user = DB::table('users')->where('id', $iduser)->first();
        if($user->role === 'superadmin' || $user->role === 'guru') {
            if($idmurid) {
                try {
                    $decryptedid = Crypt::decrypt($idmurid);
                    session(['editnilaimurid' => $decryptedid]);
                } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                    return redirect()->to("/nilai/mapel");
                }
            }
            if($idmapel) {
                try {
                    $decryptedidmapel = Crypt::decrypt($idmapel);
                    session(['editnilaimapel' => $decryptedidmapel]);
                } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                    return redirect()->to("/nilai/mapel");
                }
            }
            return redirect()->to("/nilai/edit");
        }
        return redirect()->to("/nilai");
    }
    public function editnilaimurid(){
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        if($user->role == 'murid'||$user->role == 'admin')
        {
            return redirect()->to("/nilai");
        }
        $mapelpil = DB::table('mapel')->where('id', session('editnilaimapel'))->first();
        $muridpil = DB::table('users')->where('role', 'murid')->where('id', session('editnilaimurid'))->first();
        $nilai = DB::table('nilai')->where('id_murid', $muridpil->id)->where('id_mapel', $mapelpil->id)->first();
        $kelas = DB::table('kelas')->where('id',$mapelpil->id_kelas)->first();
        return view('portal.nilai.edit', compact('user','mapelpil','muridpil','nilai','kelas'));
    }

    public function editnilaifinal(Request $request)
    {
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        if($user->role == 'murid'||$user->role == 'admin')
        {
            return redirect()->to("/nilai");
        }
        $condition = [
            'id_murid' => $request->input('idmurid'),
            'id_mapel' => $request->input('idmapel'),
        ];
        $data = [
            'id_murid' => $request->input('idmurid'),
            'id_mapel' => $request->input('idmapel'),
            'kehadiran' => $request->input('kehadiran'),
            'perilaku' => $request->input('perilaku'),
            'praktek' => $request->input('praktek'),
            'tugas' => $request->input('tugas'),
            'uts' => $request->input('uts'),
            'uas' => $request->input('uas'),
            'akhir' => $request->input('akhir'),
        ];
        nilai::updateOrCreate($condition, $data);
        session(['success' => 'Berhasil Mengubah Nilai']);
        $IdMapel = Crypt::encrypt($request->input('idmapel'));
        return redirect()->to('/nilai/mapel/'. $IdMapel);
    }

    public function cetak($id)
    {
        if($id)
        {
            session(['cetak' => $id]);
        }
        return redirect()->to("/nilai/cetak");
    }

    public function cetaknilai()
    {
        if(session('cetak'))
        {
            $user = DB::table('users')->where('id', session('user_id'))->first();
            $allmapelmurid = DB::table('mapel')->where('id_kelas', $user->id_kelas)->get();
            $semuaguru = DB::table('users')->where('role', 'guru')->get();
            $semuakelas = DB::table('kelas')->get();
            $nilaimurid = DB::table('nilai')->where('id_murid', session('cetak'))->get();
            $murid = DB::table('users')->where('id', session('cetak'))->first();
            if($user->role === 'murid')
            {
                return view('portal.nilai.cetak', compact('user','murid', 'allmapelmurid','semuaguru','semuakelas','nilaimurid'));
            }
        }
        return redirect()->to("/nilai");
    }
}