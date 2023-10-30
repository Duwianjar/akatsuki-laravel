<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;




class authController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('google')->user();
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;

        $cek = User::where('email', $email)->count();
        if($cek > 0) {
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'google_id' => $id
                ]
            );
            $encryptedId = Crypt::encrypt($user->id);
            return redirect()->to("http://portal.sman1bgs.test/request/$encryptedId");
        } else {
            return redirect()->to('http://portal.sman1bgs.test/authent/login/gagal')->with('error', 'Mohon maaf, akun Anda tidak terdaftar pada sistem kami');
        }
    }
    public function logingagal()
    {
        return redirect()->to('http://portal.sman1bgs.test/authent/login')->with('error', 'Mohon maaf, akun Anda tidak terdaftar pada sistem kami');
    }
    public function request($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $user = DB::table('users')->where('id', $id)->first();
        session(['user_id' => $user->id]);
        session(['user_role' => $user->role]);
        if($user->role=='superadmin'){
            $inisial='Super Admin';
            return redirect()->to("profil")->with('success', 'Selamat data kembali di Portal <strong>' . $inisial . '</strong>');
        }
        else if($user->role=='admin'){
            $inisial='Admin';
            return redirect()->to("profil")->with('success', 'Selamat data kembali di Portal <strong>' . $inisial . '</strong>');
        }
        else if($user->role=='guru'){
            $inisial='Bpk/Ibu '. $user->fullname;
            return redirect()->to("profil")->with('success', 'Selamat data kembali di Portal <strong>' . $inisial . '</strong>');
        }
        else if($user->role=='murid'){
            $inisial='Sodara '. $user->fullname;
            return redirect()->to("profil")->with('success', 'Selamat data kembali di Portal <strong>' . $inisial . '</strong>');
        }


    }
    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
            'pass' => [
                'required',
                'string',
                'not_html_or_hyphen_or_single_quote',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->with('error', 'Input tidak valid. Pastikan tidak ada karakter khusus.')
            ->withErrors($validator)
            ->withInput();
        }
        $username = $request->input('user');
        $password = $request->input('pass');
        $userByFullname = DB::table('users')->where('fullname', $username)->first();
        $userByTelepon = DB::table('users')->where('telepon', $username)->first();
        if ($userByFullname) {
            $pass = Crypt::decrypt($userByFullname->password);
            if($pass === $password){
                session(['user_id' => $userByFullname->id]);
                session(['user_role' => $userByFullname->role]);
                $encryptedId = Crypt::encrypt($userByFullname->id);
                return redirect()->to("/request/$encryptedId");
            }
        } elseif ($userByTelepon) {
            $pass = Crypt::decrypt($userByTelepon->password);
            if($pass === $password){
                session(['user_id' => $userByTelepon->id]);
                session(['user_role' => $userByTelepon->role]);
                $encryptedId = Crypt::encrypt( $userByTelepon->id);
                return redirect()->to("/request/$encryptedId");
            }
        }
            return redirect()->to('authent')->with('error', 'Username atau password salah'); // Ganti 'auth' dengan rute halaman login
    }
    public function invalid()
    {
        return view('auth.invalid');
    }
    public function logout()
    {
        session()->forget('user_id');
        session()->forget('user_role');
        session()->flush();
        return redirect()->to('http://portal.sman1bgs.test/authent')->with('success', 'Anda sudah berhasil logout');
    }
    public function enkripsi($data)
    {
        $encryptedData = Crypt::encrypt($data);
        return 'Data : ' . $data . '<br>Encrypt AES-256-CBC : ' . $encryptedData;
    }
    public function deskripsi($data)
    {
        $decryptedData = Crypt::decrypt($data);
        return 'Data : ' . $data . '<br>Decrypt AES-256-CBC : ' . $decryptedData;
    }
}
