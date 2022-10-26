<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Barang;
use DB;
use Validator;


class Utama extends Controller
{
    public function index(){
        $barang = DB::table('tbl_barang')->get();

        return view('Utama',['barang' => $barang]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[ 
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);   

        if($validator->fails()) {          
            
            return response()->json(['error'=>$validator->errors()], 401);                        
         }  

        $image_path = $request->file('gambar')->store('','public');


        $barang = new M_Barang;
        $barang->nama_produk = $request->nama_produk;
        $barang->harga = $request->harga;
        $barang->gambar = $image_path;
        $timestamps = false;
        
        $barang->save();

        return response()->json([
            "success" => true,
            "message" => "data berhasil ditambahkan",
            "data" => $barang
        ], 200);
    }
}
