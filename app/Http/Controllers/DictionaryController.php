<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Wsneofeeder;
use App\Helpers\Hfungsi;
use App\Models\Mfungsi;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;

class DictionaryController extends Controller
{
    public function index(){       
        return view('dictionary.index');
    }
    public function getdictionary(Request $request){
        $feeder_akun = Session::get("neofeeder_akun");        
        $data = Wsneofeeder::getdictionary($feeder_akun->token,'GetDictionary',$request->dictionary);
        if($data->error_code == 0){
            return view('dictionary.show',compact('data'));
        }else{
            return $data->error_desc;
        } 
    }
}