<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\Retur;
use App\Models\DetailRetur;
use DB;
use Alert;
class ReturController extends Controller
{
    public function index()
    {
    //
        $pembelian=\App\Models\Pembelian::All();
        return view('retur.retur',['pembelian'=>$pembelian]);
    }
    public function edit($id)
    {
        $AWAL = 'RTR';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = \App\Models\Retur::max('no_retur');
        $no = 1;
        $format=sprintf("%03s", abs((int)$noUrutAkhir + 1)). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
        //No otomatis untuk jurnal
        $AWALJurnal = 'JRU';
        $bulanRomawij = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhirj = \App\Models\Jurnal::max('no_jurnal');
        $noj = 1;
        $formatj=sprintf("%03s", abs((int)$noUrutAkhirj + 1)). '/' . $AWALJurnal .'/' . $bulanRomawij[date('n')] .'/' . date('Y');
       
        $decrypted = Crypt::decryptString($id);
        $detail = DB::table('tampil_pembelian')->where('no_beli',$decrypted)->get();
        $pemesanan = DB::table('pemesanan')->where('no_pesan',$decrypted)->get();
        $akunkas = DB::table('setting')->where('nama_transaksi','Kas')->get();
        $akunretur = DB::table('setting')->where('nama_transaksi','Retur')->get();
        return view('retur.beli',['beli'=>$detail,'format'=>$format,'no_pesan'=>$decrypted,'pemesanan'=>$pemesanan,'formatj'=>$formatj,'kas'=>$akunkas,'retur'=>$akunretur]);
    }
         public function simpan(Request $request)
        {
            if (Retur::where('no_retur', $request->no_retur)->exists()) {
            Alert::warning('Pesan ','Retur sudah dilakukan ');
            return redirect('retur');
            }else{
            //SIMPAN DATA KE TABEL DETAIL PEMBELIAN
            $kdbrg = $request->kd_brg;
            $qtyretur = $request->jml_retur;
            $harga = $request->harga;
            $total=0;
            foreach($kdbrg as $key => $no)
            {
            $input['no_retur'] = $request->no_retur;
            $input['kd_brg'] = $kdbrg[$key];
            $input['qty_retur'] = $qtyretur[$key];
            $input['sub_retur'] = $harga[$key]*$qtyretur[$key];
            DetailRetur::insert($input);
            $total=$harga[$key]*$qtyretur[$key];
            }
            //Simpan ke table retur
            $tambah_pembelian=new \App\Models\Retur;
            $tambah_pembelian->no_retur = $request->no_retur;
            $tambah_pembelian->tgl_retur = $request->tgl;
            $tambah_pembelian->total_retur = $total;
            $tambah_pembelian->save();
            //SIMPAN ke table jurnal bagian debet
            $tambah_jurnaldebit=new \App\Models\Jurnal;
            $tambah_jurnaldebit->no_jurnal = $request->no_jurnal;
            $tambah_jurnaldebit->keterangan = 'Kas';
            $tambah_jurnaldebit->tgl_jurnal = $request->tgl;
            $tambah_jurnaldebit->no_akun = $request->kas;
            $tambah_jurnaldebit->debit = $total;
            $tambah_jurnaldebit->kredit = '0';
            $tambah_jurnaldebit->save();

            //SIMPAN ke table jurnal bagian kredit
            $tambah_jurnalkredit=new \App\Models\Jurnal;
            $tambah_jurnalkredit->no_jurnal = $request->no_jurnal;
            $tambah_jurnalkredit->keterangan = 'Retur Pembelian';
            $tambah_jurnalkredit->tgl_jurnal = $request->tgl;
            $tambah_jurnalkredit->no_akun = $request->retur;
            $tambah_jurnalkredit->debit ='0';
            $tambah_jurnalkredit->kredit = $total;
            $tambah_jurnalkredit->save();
            Alert::success('Pesan ','Data berhasil disimpan');
            return redirect('/retur');
         }
        }
 }