<?php

namespace App\Http\Controllers;

use App\karyawan;
use App\User;
use App\Simpanan;
use App\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $karywan = karyawan::get();
            $user = User::find($session['user']);

            $karywan = array();
            
            $karyawan = karyawan::get();
            return view("karyawan.list", compact("karyawan", "user"));
            
        } else {
            return redirect("/login");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            

            return view("karyawan.add", compact("user"));
            
        } else {
            return redirect("/login");
        }
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $count = karyawan::where('username', $request->username)->count();
        
        if($count == 0){
            $karyawan = new karyawan;
            $karyawan->nik = $request->nik;
            $karyawan->nama = $request->nama;
            $karyawan->username = $request->username;
            $karyawan->password = Hash::make($request->password);
            $karyawan->user_role = $request->user_role;
            $karyawan->status_aktif = 1;
            $karyawan->save();
            $id = Session::get('user');

            $karyawan->save();

            return redirect('/karyawan')->with('success','Data Berhasil Dibuat');
        } else {
            return redirect()->action([karyawanController::class, 'create'])->with('danger', 'Username sudah ada');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            $current_user = User::find($id);
            $transaksi = Simpanan::where("id_user", $id)->orderBy("id", "DESC")->take(10)->get();
            $no_anggota = array();

            for ($i=0; $i < sizeof($transaksi); $i++) { 
                $anggota = Anggota::find($transaksi[$i]->anggota_id);
                array_push($no_anggota, $anggota->no_anggota);
            }

            return view("karyawan.viewkaryawan", compact("user", "current_user", "no_anggota", "transaksi"));
        } else {
            return redirect("/login");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            $karyawan = karyawan::find($id);
            
            return view("karyawan.edit", compact("user", 'karyawan'));

        } else {
            return redirect("/login");
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $karyawan = karyawan::find($id);
        $karyawan->nik = $request->nik;
        $karyawan->nama = $request->nama;
        $karyawan->username = $request->username;
        $karyawan->user_role = $request->user_role;
        $karyawan->save();

        return redirect('/karyawan')->with('success', 'Data Karyawan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = karyawan::find($id);
        $karyawan->status_aktif = 2 ;

        $karyawan->save();
        return redirect('/karyawan')->with('success', 'User telah dinonaktifkan');
    }
}
