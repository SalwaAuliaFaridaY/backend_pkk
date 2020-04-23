<?php

namespace App\Http\Controllers;
use App\Pemesanan;
use Auth;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index(){
        $data = Pemesanan::all();
        return response($data);
    }
    public function show($id){
        $data = Pemesanan::where('id',$id)->get();
        return response ($data);
    }
    public function store (Request $request){
        try {
            $data = new Pemesanan();
            $data->nama_pemesan   = $request->input('nama_pemesan');
            $data->layanan        = $request->input('layanan');
            $data->tanggal_serah  = $request->input('tanggal_serah');
            $data->tanggal_ambil  = $request->input('tanggal_ambil');
            $data->kecamatan      = $request->input('kecamatan');
            $data->alamat         = $request->input('alamat');
            $data->kontak         = $request->input('kontak');
            $data->save();
            return response()->json([
                'status'    => '1',
                'message'   => 'Tambah Data Pemesan Berhasil!'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status'    => '0',
                'message'   =>  'Tambah Data Pemesan Gagal!'

            ]);
        }
    }
    public function delete($id)
    {
        try{

            $delete = Pemesanan::where("id", $id)->delete();

            if($delete){
              return response([
                "status"  => 1,
                  "message"   => "Data pemesanan berhasil dihapus."
              ]);
            } else {
              return response([
                "status"  => 0,
                  "message"   => "Data pemesanan gagal dihapus."
              ]);
            }
            
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
                "message"   => $e->getMessage()
            ]);
        }
    }
}