<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\User;
use App\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AnggotaController extends Controller
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
            $anggotas = Anggota::get();
            $user = User::find($session['user']);

            $anggota = array();

            for ($i=0; $i < count($anggotas); $i++) { 
                $id = $anggotas[$i]->id;
                $no_anggota = $anggotas[$i]->no_anggota;
                $nama = $anggotas[$i]->nama;
                $alamat = $anggotas[$i]->alamat;
                $telepon = $anggotas[$i]->telepon;
                $noktp = $anggotas[$i]->noktp;
                $kelamin_id = $anggotas[$i]->kelamin_id;
                $saldo = Simpanan::where("anggota_id", $id)->sum("nominal_transaksi");
                $status_aktif = $anggotas[$i]->status_aktif;

                $object = (object) ["id" => $id, "no_anggota" => $no_anggota, "nama" => $nama, "alamat" => $alamat, "telepon" => $telepon, "noktp" => $noktp, "kelamin_id" => $kelamin_id, "saldo" => $saldo, "status_aktif" => $status_aktif];
                array_push($anggota, $object);
            }
            
            return view("anggota.list", compact("anggota", "user"));
            
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
            
            
            return view("anggota.add", compact("user"));
            
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
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $tahun = date("Y");
        $nomer = Anggota::where("no_anggota", "like", date("Y"). "%")->count();
        $no_anggota = sprintf("%s%'.04d", date("Y"), $nomer + 1);
        
            $anggota = new Anggota;
            $anggota->no_anggota = $no_anggota;
            $anggota->nama = $request->nama;
            $anggota->alamat = $request->alamat;
            $anggota->telepon = $request->telepon;
            $anggota->noktp = $request->noktp;
            $anggota->kelamin_id = $request->kelamin_id;
            $anggota->status_aktif = 1 ;
            $anggota->user_id = Session::get('user');
            $anggota->save();        
       

        return redirect('/anggota')->with('success','Data Anggota Berhasil Dibuat');
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
            $anggota = Anggota::find($id);
                
            $saldo = Simpanan::where("anggota_id", $id)->sum("nominal_transaksi");

            $transaksi = Simpanan::where("anggota_id", $id)->orderBy("id", "DESC")->take(10)->get();            
            
            return view("transaksi.list", compact("anggota", "saldo", "transaksi", "user"));
            
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
            $anggota = Anggota::find($id);
            
            
            return view("anggota.edit", compact("user", 'anggota'));
            
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
        $anggota = Anggota::find($id);
        $anggota->nama = $request->nama;
        $anggota->alamat = $request->alamat;
        $anggota->telepon = $request->telepon;
        $anggota->noktp = $request->noktp;
        $anggota->kelamin_id = $request->kelamin_id;
        $anggota->user_id = Session::get('user');
        $anggota->save();

        return redirect('/anggota')->with('success', 'Data Anggota Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $anggota = Anggota::find($id);
        $anggota->status_aktif = 2 ;

        $anggota->save();
        return redirect('/anggota')->with('success','Anggota Berhasil Dinonaktifkan');
    }
    
}