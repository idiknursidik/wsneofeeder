<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Wsneofeeder;
use App\Helpers\Hfungsi;
use App\Models\Mfungsi;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;

class NeokelasController extends Controller
{
    public function index(){       
        return view('neokelas.index');
    }
    public function listdata(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        //$token, $table, 
        $filter=($request->filter)?"kode_mata_kuliah LIKE '%".$request->filter."%' OR nama_mata_kuliah LIKE '%".$request->filter."%'":false; 
        $order="id_semester DESC";
        $limit=20; 
        $offset=($request->page)?$request->page:0;
        $data = Wsneofeeder::getrecordset($feeder_akun->token,'GetListKelasKuliah',$filter,$order,$limit,$offset);        
        $datacount = Wsneofeeder::getrecordset($feeder_akun->token,'GetListKelasKuliah',$filter);       
        $filterret = $request->filter;
        if($data->error_code == 0){
            return view('neokelas.listdata',compact('data','datacount','offset','filterret','limit'));
        }else{
            return $data->error_desc;
        }    
        
    }
    public function detail(Request $request){
        $id_kelas_kuliah = $request->id_kelas_kuliah;
        $aksi = $request->aksi;
        return view('neokelas.detail',compact('id_kelas_kuliah','aksi'));
    }
 
    public function detailkelas(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        $id_kelas_kuliah = $request->id_kelas_kuliah;
        $filter = " id_kelas_kuliah = '".$id_kelas_kuliah."' ";
        $data = Wsneofeeder::getrecord($feeder_akun->token,'GetListKelasKuliah',$filter);  
        if($data->error_code == 0){
            $datadetail = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailKelasKuliah',$filter);
        }else{
            $datadetail = false;
        }
        if($data->error_code == 0){
            return view('neokelas.detailkelas',compact('id_kelas_kuliah','data','datadetail'));
        }else{
            return $data->error_desc;
        }
    }
}