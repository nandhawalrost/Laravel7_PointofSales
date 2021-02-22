<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; //access the authenticated user via the Auth facade
use DB; //query builder
use App\Transaksi;
use App\Rinciantransaksi;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        //select id terakhir tabel transaksi
        //$id_transaksi_terakhir = DB::table('transaksi')->latest()->first()->id;
        $id_transaksi_terakhir = DB::table('transaksi')->orderByDesc('id')->first()->id;
        //$id_transaksi_terakhir = Transaksi::all()->last()->id;
        
        //select transaksi
        $data_transaksi = DB::table('transaksi')->get();

        //select id_transaksi from rincian_transaksi where id_transaksi = $id_transaksi_terakhir
        $data_rinciantransaksi = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get();

        //sum harga from rincian_transaksi
        $sum_harga = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get()->sum('harga');

        return view('transaksi.index', compact('id_transaksi_terakhir','data_transaksi','data_rinciantransaksi','sum_harga'));
    }

    /*
     Bunga matahari tertiup angin
    Menghadap matahari bertumbuh dan mekar
    Ke langit biru yang tiada berbatas
    Kedua tanganku direntangkannya
    Meskipun diterpa derasnya hujan
    Tanpa menyeka air mata yang jatuh
    Yakin bahwa dibalik kesedihan
    Kan ada cerahnya masa depan
     */
    public function createRincian(Request $request)
    {        
        //insert rincian
        DB::table('rincian_transaksi')->insert([
            'id_transaksi'=>$request->id_transaksi,
            'nama_produk'=>$request->nama_produk,
            'qty'=>$request->qty,
            'harga'=>$request->harga,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        return redirect('transaksi');
    }

    public function createTransaksi(Request $request)
    {
        \App\Transaksi::create($request->all());
    }

    public function bayarTransaksi(Request $request)
    {
        //pengecualian parameter
        //\App\Transaksi::create($request->except(['total_harga','dibayar','kembalian']));

        //insert transaksi baru null values
        DB::table('transaksi')->insert([
            'total_harga'=>'0',
            'dibayar'=>'0',
            'kembalian'=>'0',
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        //select signed in id from user
        $id_user = Auth::id();
        
        //update transaksi
        $transaksi = DB::table('transaksi')->where('id', $request->id_transaksi)->update([
            'id_pelanggan'=>$request->id_pelanggan,
            'total_harga'=>$request->total_harga,
            'dibayar'=>$request->dibayar,
            'kembalian'=>$request->kembalian,
            'id_user'=>$request->user()->id,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);
        
        return redirect('/transaksi');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
