<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Wsneofeeder;
use App\Helpers\Hfungsi;
use App\Models\Mfungsi;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;

class NeodosenController extends Controller
{
    public function index(){       
        return view('neodosen.index');
    }
    public function listdata(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        
        $filter=($request->filter)?"nama_dosen LIKE '%".$request->filter."%'":false; 
        $order=false;
        $limit=20; 
        $offset=($request->page)?$request->page:0;
        $data = Wsneofeeder::getrecordset($feeder_akun->token,'GetListDosen',$filter,$order,$limit,$offset);
        $datacount = Wsneofeeder::getrecordset($feeder_akun->token,'GetListDosen',$filter);       
        $filterret = $request->filter;
        if($data->error_code == 0){
            return view('neodosen.listdata',compact('data','datacount','offset','filterret','limit'));
        }else{
            return $data->error_desc;
        }    
        
    }
    public function detail(Request $request){
        $id_mahasiswa = $request->id_mahasiswa;
        $aksi = $request->aksi;
        return view('neodosen.detail',compact('id_mahasiswa','aksi'));
    }
 
}