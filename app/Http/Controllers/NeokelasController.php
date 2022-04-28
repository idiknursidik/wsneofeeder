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
            $datadetail = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailKelasKuliah',$filter);
           
            $filtermatkul = "id_matkul = '".$data->data[0]->id_matkul."'";
            $datamatakuliah = Wsneofeeder::getrecord($feeder_akun->token,'GetDetailMataKuliah',$filtermatkul);
            $filterkelas = "id_kelas_kuliah = '".$data->data[0]->id_kelas_kuliah."'";
        }else{
            $datadetail = false;
        }
        if($data->error_code == 0){
            return view('neokelas.detailkelas',compact('id_kelas_kuliah','data','datadetail','datamatakuliah'));
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
       //dd($datamatakuliah->data[0]);
        $records['sks_mk']=substr($datamatakuliah->data[0]->sks_mata_kuliah,0,1);
        $records['sks_tm']=substr($datamatakuliah->data[0]->sks_tatap_muka,0,1);
        $records['sks_prak']=substr($datamatakuliah->data[0]->sks_praktek,0,1);
        $records['sks_sim']=substr($datamatakuliah->data[0]->sks_simulasi,0,1);
        $records['bahasan']=null;
        $records['a_selenggara_pditt']=1;
        $records['apa_untuk_pditt']=0;
        $records['kapasitas']=substr($datamatakuliah->data[0]->sks_simulasi,0,1);
        $records['id_mou']=null;
        $records['id_kelas_kuliah']=null;
        echo "<pre>";
        print_r($records);
        echo "</pre>";
        $a=array("id_prodi"=>"1180e248-26cc-48ef-8835-e6cd86b3d240",
        "id_semester"=>"20201",
        "nama_kelas_kuliah"=>"xxx",
        "sks_mk"=>"2",
        "sks_tm"=>"2",
        "sks_prak"=>"0",
        "sks_prak_lap"=>"0",
        "sks_sim"=>"0",
        "bahasan"=>"20181@2018@79201@MKP 8049@M",
        "a_selenggara_pditt"=>1,
        "apa_untuk_pditt"=>0,
        "kapasitas"=>30,
        "tanggal_mulai_efektif"=>"2019-09-16",
        "tanggal_akhir_efektif"=>"2019-10-16",
        "id_mou"=>null,
        "id_matkul"=>"1f9104c5-4600-4718-9106-d5f74443a5c9",
        "id_kelas_kuliah"=>null,
        "lingkup"=>1,
        "mode"=>"O");
        echo "<pre>";
        print_r($a);
        echo "</pre>";
        $insert = Wsneofeeder::insertws($feeder_akun->token, 'InsertKelasKuliah', $records);
        $insert=json_decode($insert);

        if($insert->error_code == 0){            
            $ret = array("success"=>true,"id_kelas_kuliah"=>$insert->data->id_kelas_kuliah,"messages"=>$insert->data->id_kelas_kuliah);
        }else{
            $ret = array("success"=>false,"messages"=>$insert->error_desc);
        }
        return response()->json($ret);
        //redirect ke detail kelas
    }    
}