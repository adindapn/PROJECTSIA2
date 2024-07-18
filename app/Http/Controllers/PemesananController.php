<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pemesanan;
use App\Models\Pemesanan_tem;
use App\Models\Temp_pesan;
use Alert;


class PemesananController extends Controller
{
    public function index ()
    {
    $akun=\App\Models\Akun::All();
    $barang=\App\Models\Barang::All();
    $supplier=\App\Models\Supplier::All();
    $temp_pesan=\App\Models\Temp_pesan::All();
    //No otomatis untuk transaksi pemesanan
    $AWAL = 'TRX';
    $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
    $noUrutAkhir = \App\Models\Pemesanan::max('no_pesan');
    $no = 1;
    $formatnya=sprintf("%03s", abs((int)$noUrutAkhir + 1)). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
    return view('pemesanan.pemesanan' ,   
     ['barang' => $barang,    'akun' => $akun,    'supplier'=>$supplier,
    'temp_pemesanan'=>$temp_pesan,
    'formatnya'=>$formatnya]);
    }
     public function tambahOrder()
    {
             return view('pemesanan');
    }
    public function store(Request $request)
    {
            //Validasi jika barang sudah ada paada tabel temporari maka QTY akaan di edit
            if (Pemesanan_tem::where('kd_brg', $request->brg)->exists()) {
            Alert::warning('Pesan ','barang sudah ada.. QTY akan terupdate ?');
            Pemesanan_tem::where('kd_brg', $request->brg)->update(['qty_pesan' => $request->qty]);
            return redirect('transaksi');
            }else{
            Pemesanan_tem::create([
            'qty_pesan' => $request->qty,
            'kd_brg' => $request->brg
    ]);
        return redirect('transaksi');
    }
    }
        public function destroy($kd_brg)
    {
    //
        $barang=\App\Models\Pemesanan_tem::findOrFail($kd_brg);
        $barang->delete();
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect('transaksi');
    }
}