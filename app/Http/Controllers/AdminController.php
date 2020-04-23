<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function index()
    {
    	try{
	        $data["count"] = Admin::count();
	        $Admin = array();
            $dataAdmin = DB::table('admin')->join('users','users.id','=','admin.id_users')
                                            ->join('pemesanan','pemesanan.id','=','admin.id_pemesanan')
                                            ->select('admin.id', 'admin.id_users','admin.id_pemesanan','pemesanan.nama_pemesan','pemesanan.layanan',
                                            'pemesanan.kecamatan','pemesanan.alamat', 'admin.berat_barang','admin.biaya_layanan',
                                            'admin.jarak','admin.ongkir','admin.total_bayar')
	                                        ->get();

	        foreach ($dataAdmin as $p) {
	            $item = [
	                "id"          		    => $p->id,
                    "id_users"              => $p->id_users,
                    "id_pemesanan"          => $p->id_pemesanan,
	                "nama_pemesan"  		=> $p->nama_pemesan,
	                "layanan"               => $p->layanan,
	                "kecamatan"    	        => $p->kecamatan,
                    "alamat"                => $p->alamat,
                    "berat_barang"          => $p->berat_barang,
                    "biaya_layanan"         => $p->biaya_layanan,
                    "jarak"                 => $p->jarak,
                    "ongkir"                => $p->ongkir,
                    "total_bayar"           => $p->total_bayar,
	            ];

	            array_push($Admin, $item);
	        }
	        $data["Admin"] = $Admin;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function getAll($limit = 10, $offset = 0)
    {
    	try{
	        $data["count"] = Admin::count();
	        $Admin = array();
            $dataAdmin = DB::table('admin')->join('users','users.id','=','admin.id_users')
                                            ->join('pemesanan','pemesanan.id','=','admin.id_pemesanan')
                                            ->select('admin.id', 'admin.id_users','admin.id_pemesanan','pemesanan.nama_pemesan','pemesanan.layanan',
                                            'pemesanan.kecamatan','pemesanan.alamat', 'admin.berat_barang','admin.biaya_layanan',
                                            'admin.jarak','admin.ongkir','admin.total_bayar')
	                                        ->get();

	        foreach ($dataAdmin as $p) {
	            $item = [
	                "id"          		    => $p->id,
                    "id_users"              => $p->id_users,
                    "id_pemesanan"          => $p->id_pemesanan,
	                "nama_pemesan"  		=> $p->nama_pemesan,
	                "layanan"               => $p->layanan,
	                "kecamatan"    	        => $p->kecamatan,
                    "alamat"                => $p->alamat,
                    "berat_barang"          => $p->berat_barang,
                    "biaya_layanan"         => $p->biaya_layanan,
                    "jarak"                 => $p->jarak,
                    "ongkir"                => $p->ongkir,
                    "total_bayar"           => $p->total_bayar,
	            ];

	            array_push($Admin, $item);
	        }
	        $data["Admin"] = $Admin;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function store(Request $request)
    {
      try{
    		$validator = Validator::make($request->all(), [
                'id_users'    		=> 'required|numeric',
                'id_pemesanan'    	=> 'required|numeric',
                'berat_barang'		=> 'required|max:100',
                'biaya_layanan'	    => 'required|max:100',
                'jarak'			  	=> 'required|max:100',
                'ongkir'			=> 'required|max:100',
                'total_bayar'	    => 'required|max:100',
    		]);

    		if($validator->fails()){
    			return response()->json([
    				'status'	=> 0,
    				'message'	=> $validator->errors()
    			]);
    		}

    		$data = new Admin();
            $data->id_users = $request->input('id_users');
            $data->id_pemesanan = $request->input('id_pemesanan');
            $data->berat_barang = $request->input('berat_barang');
            $data->biaya_layanan = $request->input('biaya_layanan');
            $data->jarak = $request->input('jarak');
            $data->ongkir = $request->input('ongkir');
            $data->total_bayar = $request->input('total_bayar');
            $data->save();

    		return response()->json([
    			'status'	=> '1',
    			'message'	=> 'Data layanan berhasil ditambahkan!'
    		], 201);

      } catch(\Exception $e){
            return response()->json([
                'status' => '0',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
      try {
      	$validator = Validator::make($request->all(), [
            'id_users'    		=> 'required|numeric',
            'id_pemesanan'    	=> 'required|numeric',
            'berat_barang'		=> 'required|max:100',
            'biaya_layanan'	    => 'required|max:100',
            'jarak'			  	=> 'required|max:100',
            'ongkir'			=> 'required|max:100',
            'total_bayar'	    => 'required|max:100',
		]);

      	if($validator->fails()){
      		return response()->json([
      			'status'	=> '0',
      			'message'	=> $validator->errors()
      		]);
      	}

      	//proses update data
      	$data = Admin::where('id', $id)->first();
          $data->id_users = $request->input('id_users');
          $data->id_pemesanan = $request->input('id_pemesanan');
          $data->berat_barang = $request->input('berat_barang');
          $data->biaya_layanan = $request->input('biaya_layanan');
          $data->jarak = $request->input('jarak');
          $data->ongkir = $request->input('ongkir');
          $data->total_bayar = $request->input('total_bayar');
          $data->save();

      	return response()->json([
      		'status'	=> '1',
      		'message'	=> 'Data layanan berhasil diubah'
      	]);
        
      } catch(\Exception $e){
          return response()->json([
              'status' => '0',
              'message' => $e->getMessage()
          ]);
      }
    }
    
    public function delete($id)
    {
        try{

            $delete = Admin::where("id", $id)->delete();

            if($delete){
              return response([
                "status"  => 1,
                  "message"   => "Data layanan berhasil dihapus."
              ]);
            } else {
              return response([
                "status"  => 0,
                  "message"   => "Data layanan gagal dihapus."
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
