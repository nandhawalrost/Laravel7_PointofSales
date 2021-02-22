<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
{
    public function index()
    {
        //select produk
        $data_produk = DB::table('produk')->get();

        return view('produk.index',['produk' => $data_produk]);
    }

    public function create(Request $request)
    {  
        //insert produk
        DB::table('produk')->insert([
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga
        ]);

        return redirect('produk');
        
    }
    public function edit($id)
    {
        //select produk where id
        $produk = DB::table('produk')->where('id',$id)->first(); //or find()
        return view('produk.edit',['produk' => $produk]);
        
    }

    public function update(Request $request, $id)
    {
        $produk = DB::table('produk')->where('id', $request->id)->update([
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga
        ]);

        return redirect('/produk');
    }

    public function delete($id)
    {
        $produk = DB::table('produk')->where('id',$id)->delete();

        return redirect('/produk');
    }   
}
