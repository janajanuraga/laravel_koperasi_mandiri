<?php

namespace App\Http\Controllers;

use App\User;
use App\Anggota;
use App\Simpanan;
use App\Bungasimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $session = Session::all();
        if(!isset($session['user'])){
            return view("user.login");    
        } else {
            return redirect()->action([UserController::class, 'home']);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->where("status_aktif", 1)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)){
                Session::put('user', $user->id);
                return redirect("/")->with('succes','Login Sukses');
            } else {
                return redirect()->action([UserController::class, 'index'])->with('danger','Username atau password salah');
            }
        } else {
            return redirect()->action([UserController::class, 'index'])->with('danger','Username atau password salah');
        }
    }  

    public function create()
    {
        $session = Session::all();
        if(!isset($session['user'])){
            return view("user.register");    
        } else {
            return redirect()->action([UserController::class, 'home']);
        }
    }

    public function register(Request $request)
    {
        $count = User::where('username', $request->username)->count();
        
        if($count == 0){
            $user = new User;
            $user->nik = $request->nik;
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->user_role = $request->user_role;
            $user->status_aktif = 1;
            $id = Session::get('user');

            $user->save();

            return redirect()->action([UserController::class, 'login']);
        } else {
            return redirect()->action([UserController::class, 'create'])->with('danger', 'Username sudah ada');
        }
    }

    public function show($id)
    {
           
    }

    public function home()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $year = date('Y');
            $month = date('n');
            $user = User::find($session['user']);
            $jumlahAnggota = Anggota::where("status_aktif", 1)->get()->count();
            $totalSimpanan = Simpanan::whereMonth('tanggal', $month)->sum('nominal_transaksi');
            $bungaSimpanan = Bungasimpanan::whereDate('tanggal_mulai_berlaku', "<=", date("Y-m-d"))->orderBy("tanggal_mulai_berlaku", "DESC")->first();
            $simpanan = array();

            for ($i=1; $i<=12 ; $i++) { 
                $simpananPerBulan = Simpanan::whereMonth('tanggal', $i)->whereYear('tanggal', $year)->sum('nominal_transaksi');
                array_push($simpanan, $simpananPerBulan);
            }

            return view("user.dashboard", compact("user", "jumlahAnggota", "totalSimpanan", "bungaSimpanan", "simpanan"));
        } else {
            return redirect("/login");
        }
    }

    public function edit()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            return view("user.profil", compact("user"));
        } else {
            return redirect("/login");
        }
    }

    public function update(Request $request)
    {
        $id = Session::get('user');
        
        $user = User::find($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        
        if($request->new_password == $request->new_password_confirmation){
            if(Hash::check($request->old_password, $user->password)){
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->action([UserController::class, 'edit']);
            } else {
                return redirect()->action([UserController::class, 'edit']);
            }
        } else {
            return redirect()->action([UserController::class, 'edit']);
        }
        
        $user->save();

        return redirect()->action([UserController::class, 'edit']);
    }

    public function updatePassword(Request $request)
    {
        $id = Session::get('user');

        $user = User::find($id);
        if($request->new_password == $request->confirm_new_password){
            if(Hash::check($request->old_password, $user->password)){
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->action([UserController::class, 'edit']);
            } else {
                return redirect()->action([UserController::class, 'edit']);
            }
        } else {
            return redirect()->action([UserController::class, 'edit']);
        }
    }

    public function destroy()
    {
        Session::forget('user');
        return redirect("/login");
    }
}
