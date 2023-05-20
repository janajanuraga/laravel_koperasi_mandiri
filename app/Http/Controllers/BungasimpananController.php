<?php

namespace App\Http\Controllers;

use App\Bungasimpanan;
use App\User;
use App\Anggota;
use App\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BungasimpananController extends Controller
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
            $bunga = Bungasimpanan::get();
            $user = User::find($session['user']);

            
            return view("bungasimpanan.list", compact("user", "bunga"));
            
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
            
            
            return view("bungasimpanan.create", compact("user"));
            
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
        $tanggal = date("dd", strtotime($request->tanggal_mulai_berlaku));
        $bulan = date("m", strtotime($request->tanggal_mulai_berlaku));
        $tahun = date("Y", strtotime($request->tanggal_mulai_berlaku));
        $tanggalSekarang = date("dd");
        $bulanSekarang = date("m");
        $tahunSekarang = date("Y");

        if($tahun > $tahunSekarang) {
            $bunga = new Bungasimpanan;
            $bunga->persentase = $request->persentase;
            $bunga->tanggal_mulai_berlaku = $request->tanggal_mulai_berlaku;
            $bunga->save();

            return redirect()->action([BungasimpananController::class, 'index'])->with('success','Bunga Simpanan Berhasil Dibuat');
        } elseif($tahun == $tahunSekarang && $bulan >= $bulanSekarang ){
            $bunga = new Bungasimpanan;
            $bunga->persentase = $request->persentase;
            $bunga->tanggal_mulai_berlaku = $request->tanggal_mulai_berlaku;
            $bunga->save();

            return redirect()->action([BungasimpananController::class, 'index'])->with('success','Bunga Simpanan Berhasil Dibuat');
        } else {
            return redirect()->action([BungasimpananController::class, 'create'])->with('danger','Gagal Membuat Bunga Simpanan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bungasimpanan  $bungaSimpanan
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bungasimpanan  $bungaSimpanan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            
            
            $bunga = Bungasimpanan::find($id);
            return view("bungasimpanan.edit", compact("user", "bunga"));
            
        } else {
            return redirect("/login");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bungasimpanan  $bungaSimpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bunga = Bungasimpanan::find($id);
        $bulan_mulai_berlaku = date("m", strtotime($request->tanggal_mulai_berlaku));
        $bulan_mulai_berlaku_db = date("m", strtotime($bunga->tanggal_mulai_berlaku));
        $tahun_mulai_berlaku = date("Y", strtotime($request->tanggal_mulai_berlaku));
        $tahun_mulai_berlaku_db = date("Y", strtotime($bunga->tanggal_mulai_berlaku));
        $tanggal_mulai_berlaku = date_create($request->tanggal_mulai_berlaku);
        $tanggal_sekarang = date_create("now");
        $perbedaan_tanggal = date_diff($tanggal_sekarang, $tanggal_mulai_berlaku);

        if($perbedaan_tanggal->format("%R") == "+"){
            if($tahun_mulai_berlaku == $tahun_mulai_berlaku_db && $bulan_mulai_berlaku == $bulan_mulai_berlaku_db){
                $bunga->persentase = $request->persentase;
                $bunga->tanggal_mulai_berlaku = $request->tanggal_mulai_berlaku;

                $bunga->save();

                return redirect()->action([BungasimpananController::class, 'index'])->with('success', 'Data Bunga Simpanan Berhasil Diubah');
            } else {
                return redirect("/bungasimpanan/$id/edit");    
            }
        } else {
            return redirect("/bungasimpanan/$id/edit");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bungasimpanan  $bungaSimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bunga = Bungasimpanan::find($id);

        $bunga->delete();

        return redirect()->action([BungasimpananController::class, 'index']);
    }
    public function create_generate()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $tahun = date("Y");
            $bunga_simpanan = BungaSimpanan::whereDate('tanggal_mulai_berlaku', "<=", date("Y-m-d"))->orderBy("tanggal_mulai_berlaku", "DESC")->first();
            $status_generate = DB::table('tb_trx_perhitungan_bunga_simpanan')->where("trx_bulan", date("m"))->where("trx_tahun", date("Y"))->count();
            $detail = (object) ["bulan" => $bulan[date("n") - 1], "tahun" => $tahun, "persentase_bunga" => $bunga_simpanan->persentase, "status" => $status_generate];

            $transaksi = DB::table('tb_trx_perhitungan_bunga_simpanan')->orderBy("tanggal_proses", "DESC")->get();

            $users = array();

            for ($i=0; $i < sizeof($transaksi); $i++) { 
                $temp_user = User::find($transaksi[$i]->id_user);
                array_push($users, $temp_user->nama);
            }

            return view("bungasimpanan.generate", compact("user", "detail", "transaksi", "users"));
        } else {
            return redirect("/login");
        }
    }

    public function generate()
    {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $bulan = date("m");
        $tahun = date("Y");
        $tanggal_sekarang = date_create("now");
        $jumlah_tanggal_bulan_ini = date("t", strtotime($tanggal_sekarang->format("Y-m-d")));
        $jumlah_tanggal_bulan_lalu = date("t", strtotime(date_sub($tanggal_sekarang, date_interval_create_from_date_string("$jumlah_tanggal_bulan_ini days"))->format("Y-m-d")));
        $tanggal_dua_bulan_lalu = date("Y-m-d", strtotime(date_sub($tanggal_sekarang, date_interval_create_from_date_string("$jumlah_tanggal_bulan_lalu days"))->format("Y-m-d")));
        $anggotas = Anggota::where("status_aktif", 1)->get();
        $bunga_simpanan = BungaSimpanan::whereDate('tanggal_mulai_berlaku', "<=", date("Y-m-d"))->orderBy("tanggal_mulai_berlaku", "DESC")->first();

        for($i = 0; $i < count($anggotas); $i++){
            $saldo = Simpanan::where("anggota_id", $anggotas[$i]->id)->whereDate("tanggal", "<=", $tanggal_dua_bulan_lalu)->sum("nominal_transaksi");
            $bunga = ($saldo * $bunga_simpanan->persentase) / 100;
            
            $simpanan = new Simpanan;
            $simpanan->anggota_id = $anggotas[$i]->id;
            $simpanan->tanggal = date('Y-m-d H:i:s');
            $simpanan->jenis_transaksi = 3;
            $simpanan->nominal_transaksi = $bunga;
            $simpanan->id_user = Session::get("user");

            $simpanan->save();
        }

        DB::table('tb_trx_perhitungan_bunga_simpanan')->insert([
            "trx_bulan" => $bulan,
            "trx_tahun" => $tahun,
            "tanggal_proses" => date('Y-m-d H:i:s'),
            "persentase_bunga" => $bunga_simpanan->persentase,
            "id_user" => Session::get("user")
        ]);

        return redirect()->action([BungasimpananController::class, 'create_generate'])->with("success", "Berhasil memproses bunga simpanan");
    }
}