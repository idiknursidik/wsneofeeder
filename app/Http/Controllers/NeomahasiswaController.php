<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Wsneofeeder;
use App\Helpers\Hfungsi;
use App\Models\Mfungsi;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;

class NeomahasiswaController extends Controller
{
    public function index(){       
        return view('neomahasiswa.index');
    }
    public function listdata(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        //$token, $table, 
        $filter=($request->filter)?"nama_mahasiswa LIKE '%".$request->filter."%' OR nim LIKE '%".$request->filter."%'":false; 
        $order=false;
        $limit=20; 
        $offset=($request->page)?$request->page:0;
        $data = Wsneofeeder::getrecordset($feeder_akun->token,'GetListMahasiswa',$filter,$order,$limit,$offset);        
        $datacount = Wsneofeeder::getrecordset($feeder_akun->token,'GetListMahasiswa',$filter);       
        $filterret = $request->filter;
        if($data->error_code == 0){
            return view('neomahasiswa.listdata',compact('data','datacount','offset','filterret','limit'));
        }else{
            return $data->error_desc;
        }    
        
    }
    public function detail(Request $request){
        $id_mahasiswa = $request->id_mahasiswa;
        $aksi = $request->aksi;
        return view('neomahasiswa.detail',compact('id_mahasiswa','aksi'));
    }
 
    public function biodata(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        $id_mahasiswa = $request->id_mahasiswa;
        $filter = " id_mahasiswa = '".$id_mahasiswa."' ";
        $data = Wsneofeeder::getrecord($feeder_akun->token,'GetDataLengkapMahasiswaProdi',$filter);  
        $GetAgama = Wsneofeeder::getrecord($feeder_akun->token,'GetAgama');
        $kelamin = Mfungsi::kelamin();  
        if($data->error_code == 0){
            $databiodata = Wsneofeeder::getrecord($feeder_akun->token,'GetDataLengkapMahasiswaProdi',$filter);
        }else{
            $databiodata = false;
        }
        if($data->error_code == 0){
            return view('neomahasiswa.biodata',compact('id_mahasiswa','data','databiodata','GetAgama','kelamin'));
        }else{
            return $data->error_desc;
        }
    }
    public function historiypendidikan(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        $id_mahasiswa = $request->id_mahasiswa;
        $filter =" id_mahasiswa = '".$id_mahasiswa."'";
        $databiodata = Wsneofeeder::getrecord($feeder_akun->token,'GetDataLengkapMahasiswaProdi',$filter);
        $riwayatpendidikan = Wsneofeeder::getrecord($feeder_akun->token,'GetListRiwayatPendidikanMahasiswa',$filter);
        if($databiodata->error_code == 0){
            return view('neomahasiswa.historiypendidikan',compact('id_mahasiswa','databiodata','riwayatpendidikan'));
        }else{
            return $databiodata->error_desc;
        }
    }
    public function krs(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        $id_mahasiswa = $request->id_mahasiswa;
        $filter =" id_mahasiswa = '".$id_mahasiswa."'";
        $databiodata = Wsneofeeder::getrecord($feeder_akun->token,'GetDataLengkapMahasiswaProdi',$filter);
        $filternext =" id_mahasiswa = '".$id_mahasiswa."' AND id_semester = '20211'";
        $krs = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailNilaiPerkuliahanKelas',$filternext);
        $GetTahunAjaran = Wsneofeeder::getrecordset($feeder_akun->token,'GetTahunAjaran',false,"id_tahun_ajaran");
        if($databiodata->error_code == 0){
            return view('neomahasiswa.krs',compact('id_mahasiswa','databiodata','krs','GetTahunAjaran'));
        }else{
            return $databiodata->error_desc;
        }
    }
    public function nilai(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        $id_mahasiswa = $request->id_mahasiswa;
        $filter =" id_mahasiswa = '".$id_mahasiswa."'";
        $databiodata = Wsneofeeder::getrecord($feeder_akun->token,'GetDataLengkapMahasiswaProdi',$filter);
        $filternext =" id_mahasiswa = '".$id_mahasiswa."' AND id_semester = '20211'";
        $nilai = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailNilaiPerkuliahanKelas',$filternext);
        $GetTahunAjaran = Wsneofeeder::getrecordset($feeder_akun->token,'GetTahunAjaran',false,"id_tahun_ajaran"); 
        if($databiodata->error_code == 0){
            return view('neomahasiswa.nilai',compact('id_mahasiswa','databiodata','nilai','GetTahunAjaran'));
        }else{
            return $databiodata->error_desc;
        }
    }
}