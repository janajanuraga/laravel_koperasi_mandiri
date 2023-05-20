<?php

namespace App\Http\Controllers;

use App\User;
use App\Anggota;
use App\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function nasabah()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);

            return view("report.member", compact("user"));
        } else {
            return redirect("/login");
        }
    }

    public function report_nasabah(Request $request){
        if(isset($request->no_anggota)){
            $anggota = Anggota::where("no_anggota", $request->no_anggota)->where("status_aktif", 1)->first();
            if($anggota){
                return redirect()->action([AnggotaController::class, 'show'], ["id" => $anggota->id]);
            } else {
                return redirect()->action([ReportController::class, 'nasabah'])->with("danger", "Nomor Anggota Tidak Terdaftar");
            }
        } else {
            return redirect()->action([ReportController::class, 'nasabah'])->with("danger", "Mohon isikan semua form");
        }
    }

    public function harian(Request $request)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);

            if(isset($request->tanggal)){
                $tanggal = $request->tanggal;
            } else {
                $tanggal = date("Y-m-d");
            }

            $debit = Simpanan::whereIn("jenis_transaksi", [2,4])->whereDate("tanggal", $tanggal)->sum("nominal_transaksi");
            $kredit = Simpanan::whereIn("jenis_transaksi", [1,3])->whereDate("tanggal", $tanggal)->sum("nominal_transaksi");

            return view("report.harian", compact("user", "tanggal", "debit", "kredit"));
        } else {
            return redirect("/login");
        }
    }

    public function mingguan(Request $request)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);

            if(isset($request->tanggal)){
                $tanggal = $request->tanggal;
            } else {
                $tanggal = date("Y-m-d");
            }

            $hari = date("w", strtotime($tanggal));
            $tanggal_awal = date_create($tanggal);
            date_sub($tanggal_awal, date_interval_create_from_date_string("$hari days"));
            $tanggal = array();
            $debit = array();
            $kredit = array();
            $total_debit = 0;
            $total_kredit = 0;

            for($i = 0; $i < 7; $i++){
                $temp_tanggal = date_create(date_format($tanggal_awal, "Y-m-d"));
                date_add($temp_tanggal, date_interval_create_from_date_string("$i days"));
                $temp_tanggal = date_format($temp_tanggal, "Y-m-d");
                $temp_debit = Simpanan::whereIn("jenis_transaksi", [2,4])->whereDate("tanggal", $temp_tanggal)->sum("nominal_transaksi");
                $temp_kredit = Simpanan::whereIn("jenis_transaksi", [1,3])->whereDate("tanggal", $temp_tanggal)->sum("nominal_transaksi");

                $total_debit += $temp_debit;
                $total_kredit += $temp_kredit;

                array_push($tanggal, $temp_tanggal);
                array_push($debit, $temp_debit);
                array_push($kredit, $temp_kredit);
            }

            return view("report.mingguan", compact("user", "tanggal", "debit", "kredit", "total_debit", "total_kredit"));
        } else {
            return redirect("/login");
        }
    }

    public function bulanan(Request $request)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);

            if(isset($request->tanggal)){
                $tanggal = $request->tanggal;
            } else {
                $tanggal = date("Y-m-d");
            }

            $total_tanggal = date("t", strtotime($tanggal));
            $tanggal_awal = date("Y-m", strtotime($tanggal))."-1";
            $tanggal = array();
            $debit = array();
            $kredit = array();
            $total_debit = 0;
            $total_kredit = 0;

            for($i = 0; $i < $total_tanggal; $i++){
                $temp_tanggal = date_create($tanggal_awal);
                date_add($temp_tanggal, date_interval_create_from_date_string("$i days"));
                $temp_tanggal = date_format($temp_tanggal, "Y-m-d");
                $temp_debit = Simpanan::whereIn("jenis_transaksi", [2,4])->whereDate("tanggal", $temp_tanggal)->sum("nominal_transaksi");
                $temp_kredit = Simpanan::whereIn("jenis_transaksi", [1,3])->whereDate("tanggal", $temp_tanggal)->sum("nominal_transaksi");

                $total_debit += $temp_debit;
                $total_kredit += $temp_kredit;

                array_push($tanggal, $temp_tanggal);
                array_push($debit, $temp_debit);
                array_push($kredit, $temp_kredit);
            }

            return view("report.bulanan", compact("user", "tanggal", "debit", "kredit", "total_debit", "total_kredit"));
        } else {
            return redirect("/login");
        }
    }

    public function tahunan(Request $request)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);

            if(isset($request->tanggal)){
                $tanggal = $request->tanggal;
            } else {
                $tanggal = date("Y-m-d");
            }

            $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $tahun = date("Y", strtotime($tanggal));
            $debit = array();
            $kredit = array();
            $total_debit = 0;
            $total_kredit = 0;

            for($i = 1; $i <= sizeof($bulan); $i++){
                $temp_debit = Simpanan::whereIn("jenis_transaksi", [2,4])->whereMonth("tanggal", $i)->whereYear("tanggal", $tahun)->sum("nominal_transaksi");
                $temp_kredit = Simpanan::whereIn("jenis_transaksi", [1,3])->whereMonth("tanggal", $i)->whereYear("tanggal", $tahun)->sum("nominal_transaksi");

                $total_debit += $temp_debit;
                $total_kredit += $temp_kredit;

                array_push($debit, $temp_debit);
                array_push($kredit, $temp_kredit);
            }

            return view("report.tahunan", compact("user", "tahun", "bulan", "debit", "kredit", "total_debit", "total_kredit"));
        } else {
            return redirect("/login");
        }
    }
}
