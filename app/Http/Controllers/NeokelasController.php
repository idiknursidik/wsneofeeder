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
        $filter=($request->filter)?"kode_mata_kuliah LIKE '%".$request->filter."%' OR nama_mata_kuliah LIKE '%".$request->filter."%' OR nama_kelas_kuliah LIKE '%".$request->filter."%' ":false; 
        $order="id_semester DESC";
        $limit=20; 
        $offset=($request->page)?$request->page:0;
        $data = Wsneofeeder::getrecordset($feeder_akun->token,'GetListKelasKuliah',$filter,$order,$limit,$offset);        
        $datacount = Wsneofeeder::getrecordset($feeder_akun->token,'GetListKelasKuliah',$filter);       
        $filterret = $request->filter;
        if($data->error_code == 0){
            return view('neokelas.listdata',compact('data','datacount','offset','filterret','limit'));
        }else{
            $data = $data->error_desc.' | redirectting......';
            return response()->view('expired', compact('data'), 200) 
            ->header("Refresh", "3; url=/wsneofeeder"); 
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
            $filtermatkul = "id_matkul = '".$data->data[0]->id_matkul."'";
            $datadetail = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailKelasKuliah',$filter);
            $GetMataKuliah = Wsneofeeder::getrecordset($feeder_akun->token,'GetMatkulKurikulum',false,"kode_mata_kuliah ASC"); 
            $GetMataKuliahDetail = Wsneofeeder::getrecordset($feeder_akun->token,'GetMatkulKurikulum',$filtermatkul); 
            
            
            $datamatakuliah = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailMataKuliah',$filtermatkul);
            $filterkelas = "id_kelas_kuliah = '".$data->data[0]->id_kelas_kuliah."'";
            $lingkupkelas = Mfungsi::lingkupkelas();
            $modekuliah = Mfungsi::modekuliah();
        }else{
            $datadetail = false;
        }
        if($data->error_code == 0){
            return view('neokelas.detailkelas',compact('id_kelas_kuliah','data','datadetail','datamatakuliah','GetMataKuliah','GetMataKuliahDetail','lingkupkelas','modekuliah'));
        }else{
            $data = $data->error_desc.' | redirectting......';
            return response()->view('expired', compact('data'), 200) 
            ->header("Refresh", "3; url=/wsneofeeder"); 
        }
    }
    public function tambah(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        $dataprodi = Wsneofeeder::getrecordset($feeder_akun->token,'GetProdi');
        $GetTahunAjaran = Wsneofeeder::getrecordset($feeder_akun->token,'GetTahunAjaran',false,"id_tahun_ajaran ASC");
        $GetMataKuliah = Wsneofeeder::getrecordset($feeder_akun->token,'GetMatkulKurikulum',false,"kode_mata_kuliah ASC"); 
        $semester = Mfungsi::semester();
        $lingkupkelas = Mfungsi::lingkupkelas();
        $modekuliah = Mfungsi::modekuliah();
        if($dataprodi->error_code == 0){
            return view('neokelas.tambah',compact('dataprodi','GetTahunAjaran','semester','GetMataKuliah','lingkupkelas','modekuliah'));
        }else{
            $data = $dataprodi->error_desc.' | redirectting......';
            return response()->view('expired', compact('data'), 200) 
            ->header("Refresh", "3; url=/wsneofeeder"); 
        }        
    }
    public function insert(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        //matakuliah
        $filtermatkul = "id_matkul = '".$request->id_matkul."'";
        $datamatakuliah = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailMataKuliah',$filtermatkul);
        $records = $request->all();
        unset($records['_token']);
       
        $records['sks_mk']="".substr($datamatakuliah->data[0]->sks_mata_kuliah,0,1)."";
        $records['sks_tm']="".substr($datamatakuliah->data[0]->sks_tatap_muka,0,1)."";
        $records['sks_prak']="".substr($datamatakuliah->data[0]->sks_praktek,0,1)."";
        $records['sks_prak_lap']="".substr($datamatakuliah->data[0]->sks_praktek_lapangan,0,1)."";        
        $records['sks_sim']="".substr($datamatakuliah->data[0]->sks_simulasi,0,1)."";
        $records['bahasan']="";
        $records['a_selenggara_pditt']=1;
        $records['apa_untuk_pditt']=0;
        $records['kapasitas']=substr($datamatakuliah->data[0]->sks_simulasi,0,1);
        $records['id_mou']=null;
        $records['id_kelas_kuliah']=null;
       
        $insert = Wsneofeeder::insertws($feeder_akun->token, 'InsertKelasKuliah', $records);
        $insert=json_decode($insert);

        if($insert->error_code == 0){            
            $ret = array("success"=>true,"id_kelas_kuliah"=>$insert->data->id_kelas_kuliah,"messages"=>$insert->data->id_kelas_kuliah);
        }else{
            $ret = array("success"=>false,"messages"=>$insert->error_desc);
        }
        return response()->json($ret);
    }   
    public function update(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");
        //matakuliah
        $filtermatkul = "id_matkul = '".$request->id_matkul."'";
        $datamatakuliah = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailMataKuliah',$filtermatkul);
        $records = $request->all();
        unset($records['_token']);
        unset($records['id_kelas_kuliah']);
        $records['kapasitas']=0;
        $records['sks_mata_kuliah']= "".($request->sks_tatap_muka+$request->sks_praktek+$request->sks_praktek_lapangan+$request->sks_simulasi)."";
        //dd($records);
        $key="id_kelas_kuliah = '".$request->id_kelas_kuliah."'";
        $update = Wsneofeeder::updatews($feeder_akun->token,'UpdateKelasKuliah',$records,$key);
        $update=json_decode($update);

        if($update->error_code == 0){            
            $ret = array("success"=>true,"id_kelas_kuliah"=>$update->data->id_kelas_kuliah,"messages"=>$insert->data->id_kelas_kuliah);
        }else{
            $ret = array("success"=>false,"messages"=>$update->error_desc);
        }
        return response()->json($ret);
    }    
}