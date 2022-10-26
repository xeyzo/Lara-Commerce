<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;


class Order extends Controller
{
    public function order(Request $req){
        DB::table('tbl_keranjang')->insert([
            'id_user'=> Session::get('id'),
            'id_barang'=> $req->id_barang,
            'jumlah'=> $req->jumlah
        ]);

        return redirect('/');
    }

    public function cart(){
        $Keranjang = DB::table('keranjang')->get();

        return view('Keranjang',['keranjang' => $Keranjang]);
    }

    public function checkout(){
        $id_chek = rand().rand().rand();
        $total = 0;
        $data = DB::table('tbl_keranjang')->where('id_user',Session::get('id'))->get();
        foreach ($data as $krj) {
            $barang = DB::table('tbl_barang')->where('id', $krj->id_barang)->get();
            foreach ($barang as $brg) {
                $total =+ ($krj->jumlah * $brg->harga);
                DB::table('detail_checkout')->insert([
                    'id_checkout'=> $id_chek,
                    'id_barang'=> $krj->id_barang,
                    'jumlah'=> $krj->jumlah
                ]);
            }
        }
        DB::table('tbl_checkout')->insert([
            'id'=> $id_chek,
            'id_user'=> Session::get('id'),
            'total'=> $total
        ]);

        return redirect('/Checkout_list');
    }

    public function checkoutList(){
        $checkout = DB::table('checkout')->get();

        return view('Checkout',['checkout'=>$checkout]);
    }

    public function confirm(){
        return view('Confirm');
    }

    public function saveConfirm(Request $req){
        $this->validate($req, [
            'file' => 'required|max:2048'
        ]);

        $file = $req->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'konfirmasi';
        if($file->move($tujuan_upload,$nama_file)){
            DB::table('tbl_konfirmasi')->insert([
                'id_user' => Session::get('id'),
                'id_checkout' => $req->id_token,
                'bukti' => $nama_file
            ]);
            return redirect('/Confirm');
        }
    }
}

