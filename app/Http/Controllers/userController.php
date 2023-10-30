<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\Mime\Part\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use App\Models\sampah_users;

class userController extends Controller
{
    public function editprofil()
    {
        $id=session('user_id');
        $user = DB::table('users')->where('id', $id)->first();
        if($user->role)
        {
            return view('portal.profil.edit', compact('user'));
        }
    }
    public function editprofilfinal(Request $request){
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        $validator = Validator::make($request->all(), [
            'namalengkap' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
            'telepon' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
            'email' => [
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
            'fullname' => $request->input('namalengkap'),
            'telepon' => $request->input('telepon'),
            'email' => $request->input('email'),
        ];
        DB::table('users')->where('id', $id_user)->update($data);
        return redirect()->to('/profil/edit')->with('success' , 'Berhasil Mengupdate Profil');
    }
    public function editpassword(Request $request)
    {
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        $validator = Validator::make($request->all(), [
            'passwordlama' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
            'passwordbaru' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
            'konfirmasipassword' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
        ]);
        if ($validator->fails()) {
            return redirect('/profil/edit')
                ->with('error', 'Input tidak valid. Pastikan tidak ada karakter khusus dan tidak kosong.')
                ->withErrors($validator)
                ->withInput();
        }
        $passworduser = Crypt::decrypt($user->password);
        if ($request->input('passwordlama')!=$passworduser)
        {
            return redirect('/profil/edit')
            ->with('error', 'Password lama anda tidak sesuai')
            ->withErrors(['passwordlama' => 'Password lama anda tidak sesuai'])
            ->withInput();
        }
        if ($request->input('passwordbaru')!=$request->input('konfirmasipassword'))
        {
            return redirect('/profil/edit')
            ->with('error', 'Pastikan Konfirmasi password dan password baru sama')
            ->withErrors([
                'passwordbaru' => 'Konfirmasi password tidak cocok.',
                'konfirmasipassword' => 'Konfirmasi password tidak cocok.',
            ])
            ->withInput();
        }
        $passwordbaruencrypt = Crypt::encrypt($request->input('passwordbaru'));
        $data = [
            'password' => $passwordbaruencrypt,
        ];
        DB::table('users')->where('id', $id_user)->update($data);
        return redirect()->to('/profil/edit')->with('success' , 'Berhasil Mengganti Password');
    }
    public function lupapassword()
    {
            return view('portal.profil.lupapassword');
    }
    public function editfoto(Request $request)
    {
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        $validator = Validator::make($request->all(), [
                'photo' => 'mimes:jpeg,jpg,png,gif',
            ], [
                'photo.mimes' => 'Foto harus berekstensi JPEG, JPG, PNG dan GIF',
        ]);
        if ($validator->fails()) {
            return redirect('/profil/edit')
                ->with('error', 'Foto harus berekstensi JPEG, JPG, PNG dan GIF')
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('photo')) {
            $foto_file = $request->file('photo');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymdhis') . ".$foto_ekstensi";
            $foto_file->move(public_path('foto'), $foto_baru);


            $foto_lama = $user->id_foto;
            if($foto_lama!='default.png')
            {
                $filePath = public_path('foto') . "/" . $foto_lama;
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file jika ada
                }
            }
            $data = [
                'id_foto' => $foto_baru
            ];
            DB::table('users')->where('id', $id_user)->update($data);
        }
        return redirect()->to('/profil/edit')->with('success' , 'Berhasil Mengganti foto Profil');
    }

    public function users()
    {
        $user = DB::table('users')->where('id', session('user_id'))->first();
        $semuakelas = DB::table('kelas')->get();
        if($user->role === 'superadmin')
        {
            return view('portal.users.index', compact('user','semuakelas'));
        }
        return redirect()->to('/profil');
    }

    public function usersadmin()
    {
        session(['lihat' => 'admin']);
        return redirect()->to('/users/user');
    }
    public function usersguru()
    {
        session(['lihat' => 'guru']);
        return redirect()->to('/users/user');
    }
    public function usersmurid($idkelas)
    {
        session(['lihat' => 'murid']);
        session(['kelasid' => $idkelas]);
        return redirect()->to('/users/user');
    }
    public function usersuser()
    {
        session()->forget('lihatusermurid');
        $user = DB::table('users')->where('id', session('user_id'))->first();
        $semuakelas = DB::table('kelas')->get();
        if(session('lihat')=='admin')
        {
            $users = DB::table('users')->where('role', 'admin')->paginate(10);
        }
        else if(session('lihat')=='guru')
        {
            $users = DB::table('users')->where('role', 'guru')->paginate(10);
        }
        else if(session('lihat')=='murid')
        {
            $users = DB::table('users')->where('role', 'murid')->where('id_kelas', session('kelasid'))->paginate(10);
            session()->forget('kelasid');
            session(['lihatusermurid' => 'murid']);
        }
        return view('portal.users.index', compact('user','users','semuakelas'));
    }

    public function usersedit($id)
    {
        if (session('user_role')!='superadmin'){
            return redirect()->to("/profil");
        }
        try {
            $decryptedId = Crypt::decrypt($id);
            session(['editusers' => $decryptedId]);
            return redirect()->to("/users/edit");
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->to("/users/edit");
        }
    }
    public function userseditindex()
    {
        $id_edit=session('editusers');
        session()->forget('editusers');
        $id_user=session('user_id');
        $user = DB::table('users')->where('id', $id_user)->first();
        $users = DB::table('users')->where('id', $id_edit)->first();
        $semuakelas = DB::table('kelas')->get();
        if(!$users)
        {
            return redirect()->to("/users");
        }
        else
        {
            return view('portal.users.edit', compact('user','users','semuakelas'));
        }
    }
    public function userseditfinal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namalengkap' => [
                'required',
                'string',
            ],
            'telepon' => [
                'required',
                'integer',
            ],
            'email' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
        ]);

        if ($validator->fails()) {
            $errorMessage = 'Gagal merubah data, karena data berikut ini kosong: ';
            if (!$request->filled('namalengkap')) {
                $errorMessage .= 'Nama Lengkap, ';
            }
            if (!$request->filled('telepon')) {
                $errorMessage .= 'Telepon, ';
            }
            if (!$request->filled('email')) {
                $errorMessage .= 'Email, ';
            }
            if (!$request->filled('password')) {
                $errorMessage .= 'Password, ';
            }
            $errorMessage = rtrim($errorMessage, ', ');
            session(['error' => $errorMessage]);
            if($request->input('role')=='admin'||$request->input('role')=='guru')
            {
                return redirect()->to('/users/'. $request->input('role'));
            }
            if($request->input('role')=='murid')
            {
                return redirect()->to('/users/murid/'.$request->input('id_kelas'));
            }
        }
        $kelas=NULL;
        if($request->input('role')!='murid'){
            $kelas=NULL;
        }
        if($request->input('role')==='murid'){
            $kelas=$request->input('id_kelas');
        }
        $passwordencrypt = Crypt::encrypt($request->input('password'));
        $data = [
            'fullname' => $request->input('namalengkap'),
            'telepon' => $request->input('telepon'),
            'email' => $request->input('email'),
            'password' => $passwordencrypt,
            'role' => $request->input('role'),
            'id_kelas' => $kelas,
        ];
        DB::table('users')->where('id', $request->input('id'))->update($data);
        session(['success' => 'Berhasil Mengubah Data Users']);
        if($request->input('role')=='admin'||$request->input('role')=='guru')
        {
            return redirect()->to('/users/'. $request->input('role'));
        }
        if($request->input('role')=='murid')
        {
            return redirect()->to('/users/murid/'.$request->input('id_kelas'));
        }
    }
    public function usersbaru(){
        $semuakelas = DB::table('kelas')->get();
        $user = DB::table('users')->where('id', session('user_id'))->first();
        return view('portal.users.create', compact('user','semuakelas'));
    }

    public function usersbaruindex(Request $request){
        $validator = Validator::make($request->all(), [
            'namalengkap' => [
                'required',
                'string',
            ],
            'telepon' => [
                'required',
                'integer',
            ],
            'email' => [
                'required',
                'string',
            ],
            'password' => [
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
        $kelas=NULL;
        if($request->input('role')!='murid'){
            $kelas=NULL;
        }
        if($request->input('role')==='murid'){
            $kelas=$request->input('id_kelas');
        }
        $passwordencrypt = Crypt::encrypt($request->input('password'));
        $data = [
            'name' => $request->input('namalengkap'),
            'fullname' => $request->input('namalengkap'),
            'telepon' => $request->input('telepon'),
            'email' => $request->input('email'),
            'password' => $passwordencrypt,
            'role' => $request->input('role'),
            'id_kelas' => $kelas,
        ];
        DB::table('users')->where('id', $request->input('id'))->insert($data);
        session(['success' => 'Berhasil Menambah Users']);
        if($request->input('role')=='admin'||$request->input('role')=='guru')
        {
            return redirect()->to('/users/'. $request->input('role'));
        }
        if($request->input('role')=='murid')
        {
            return redirect()->to('/users/murid/'.$request->input('id_kelas'));
        }
    }
    public function usersdelete($id)
    {
        $decryptedid = Crypt::decrypt($id);
        $users = DB::table('users')->where('id', $decryptedid)->first();
        session(['success' => 'Berhasil mengapus data users '.$users->fullname]);
        $condition = ['id_users' => $users->id];
        $data = [
            'id_users' => $users->id,
            'name' => $users->name,
            'fullname' => $users->fullname,
            'telepon' => $users->telepon,
            'email' => $users->email,
            'password' => $users->password,
            'created_at' => $users->created_at,
            'updated_at' => $users->updated_at,
            'google_id' => $users->google_id,
            'role' => $users->role,
            'id_penghapus' => session('user_id'),
            'id_kelas' => $users->id_kelas,
        ];
        sampah_users::updateOrCreate($condition, $data);
        DB::table('users')->where('id', $decryptedid)->delete();
        if($users->role=='admin'||$users->role=='guru')
        {
            return redirect()->to('/users/'. $users->role);
        }
        if($users->role=='murid')
        {
            return redirect()->to('/users/murid/'.$users->id_kelas);
        }
    }
}