<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Wsneofeeder;
use App\Helpers\Hfungsi;
use App\Models\Mfungsi;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;

class NeoakmController extends Controller
{
    public function index(){       
        return view('neoakm.index');
    }
    public function listdata(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");        
        $filter=($request->filter)?"nama_mahasiswa LIKE '%".$request->filter."%' OR nim LIKE '%".$request->filter."%'":false; 
        $order=false;
        $limit=20; 
        $offset=($request->page)?$request->page:0;
        $data = Wsneofeeder::getrecordset($feeder_akun->token,'GetAktivitasKuliahMahasiswa',$filter,$order,$limit,$offset);
        $datacount = Wsneofeeder::getrecordset($feeder_akun->token,'GetAktivitasKuliahMahasiswa',$filter);       
        $filterret = $request->filter;
        if($data->error_code == 0){
            return view('neoakm.listdata',compact('data','datacount','offset','filterret','limit'));
        }else{
            return $data->error_desc;
        } 
    }
    public function detail(Request $request){
        $id_mahasiswa = $request->id_mahasiswa;
        $id_semester = $request->id_semester;
        $aksi = $request->aksi;
        return view('neoakm.detail',compact('id_mahasiswa','id_semester','aksi'));
    }
    public function detailakm(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        $reqfilter = ($request->id_mahasiswa && $request->id_semester)?true:false;
        $filter=($reqfilter)?"id_mahasiswa = '".$request->id_mahasiswa."' AND id_semester='".$request->id_semester."'":false; 
        $order=false;
        $limit=1; 
        $offset=0;
        $data = Wsneofeeder::getrecordset($feeder_akun->token,'GetAktivitasKuliahMahasiswa',$filter,$order,$limit,$offset);
        $datacount = Wsneofeeder::getrecordset($feeder_akun->token,'GetAktivitasKuliahMahasiswa',$filter);
        $GetStatusMahasiswa = Wsneofeeder::getrecord($feeder_akun->token,'GetStatusMahasiswa');       
        $filterret = $request->filter;
        if($data->error_code == 0){
            return view('neoakm.detailakm',compact('data','datacount','offset','filterret','limit','GetStatusMahasiswa'));
        }else{
            return $data->error_desc;
        }   
    }
    public function tambah(){
        return view('neoakm.tambah');
    }
}