<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.welcome.index');
    }
    public function about()
    {
        return view('dashboard.welcome.index');
    }
    public function infrastruktur()
    {
        return view('dashboard.welcome.index');
    }
    public function berita()
    {
        return view('dashboard.berita.index');
    }
    public function berita_detail()
    {
        return view('dashboard.berita.detail');
    }
    public function pengumuman()
    {
        return view('dashboard.pengumuman.index');
    }
    public function pengumuman_detail()
    {
        return view('dashboard.pengumuman.detail');
    }
    public function agenda()
    {
        return view('dashboard.agenda.index');
    }
    public function struktur()
    {
        return view('dashboard.struktur.index');
    }
    public function prestasi_sekolah()
    {
        return view('dashboard.prestasi.sekolah');
    }
    public function prestasi_siswa()
    {
        return view('dashboard.prestasi.siswa');
    }
    public function data_guru()
    {
        return view('dashboard.data.guru');
    }
    public function data_murid()
    {
        return view('dashboard.data.murid');
    }
    public function data_mapel()
    {
        return view('dashboard.data.mapel');
    }

}