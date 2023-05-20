<?php

namespace App\Http\Controllers;

use App\Simpanan;
use App\User;
use App\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SimpananController extends Controller
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
            $user = User::find($session['user']);

            $simpanan = array();

            for ($i=0; $i < 7; $i++) {
                $date = date_create("now");
                $date = date("Y-m-d", strtotime(date_sub($date, date_interval_create_from_date_string("$i days"))->format("Y-m-d")));
                $penyetoran_7_hari = Simpanan::where("jenis_transaksi", 1)->whereDate("tanggal", $date)->sum("nominal_transaksi");
                $penarikan_7_hari = Simpanan::where("jenis_transaksi", 2)->whereDate("tanggal", $date)->sum("nominal_transaksi");
                $object = (object) ["tanggal" => $date, "penyetoran" => $penyetoran_7_hari, "penarikan" => $penarikan_7_hari];
                array_push($simpanan, $object);
            }

            return view("transaksi.search", compact("user", "simpanan"));
             
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

            $anggotas = Anggota::where("status_aktif",1)->get();

            return view("transaksi.addtransaksi", compact("user", "anggotas"));

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
        $simpanan = new Simpanan;
        $simpanan->anggota_id =  $request->anggota_id;
        $simpanan->tanggal = date('Y-m-d H:i:s');
        $simpanan->jenis_transaksi = $request->jenis_transaksi;
        if($request->jenis_transaksi == 1){
            $simpanan->nominal_transaksi = $request->nominal_transaksi;
        }
        else{
            $saldo = Simpanan::where("anggota_id", $request->anggota_id)->sum("nominal_transaksi");
            $no_anggota = Anggota::find($request->anggota_id)->no_anggota;
            if($saldo >= $request->nominal_transaksi){
                $simpanan->nominal_transaksi = $request->nominal_transaksi*(-1);
            }
            else{
                return redirect("/cari?no_anggota=$no_anggota")->with("danger","Saldo Tidak Cukup");
            }
            
        }

        $simpanan->id_user = Session::get('user');

        $simpanan->save();

        return redirect()->action([AnggotaController::class,'show'], ["id" => $request->anggota_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            
            $anggotas = Anggota::where("status_aktif",1)->get();
            $simpanan = Simpanan::find($id);

            return view("simpanan.edit", compact("user", "anggotas", "simpanan"));

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
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $simpanan = Simpanan::find($id);
        $simpanan->anggota_id = $request->anggota_id;
        $simpanan->tanggal = date('Y-m-d H:i:s');
        $simpanan->jenis_transaksi = $request->jenis_transaksi;
        $simpanan->nominal_transaksi = $request->nominal_transaksi;
        $simpanan->id_user = Session::get('user');

        $simpanan->save();

        return redirect()->action([SimpananController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $simpanan = Simpanan::find($id);

        $simpanan->delete();

        return redirect()->action([SimpananController::class, 'index']);
    }

    public function searchResult(Request $request)
    {
        $session = Session::all();
        if(isset($session['user'])){
            
            $user = User::find($session['user']);

            $transaksi = Anggota::where("no_anggota", $request->no_anggota)->where("status_aktif", 1)->first();

            if($transaksi){
                $saldo = Simpanan::where("anggota_id", $transaksi->id)->sum("nominal_transaksi");

                return view('transaksi.addtransaksi', compact('user', 'transaksi', 'saldo'));
            } else { 
                return redirect()->action([SimpananController::class, 'index'])->with("danger","Nomor Anggota Tidak Terdaftar");
            }

        }else {
            return redirect()->action([UserController::class, 'index']);
        }                     
        
    }
}
