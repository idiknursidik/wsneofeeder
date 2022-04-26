<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Wsneofeeder;
use Illuminate\Support\Facades\Validator;
use Session;

class DashboardController extends Controller
{
    public function index(){
        $feeder_akun = Session::get("neofeeder_akun");
        $dataptws = Wsneofeeder::getrecordset($feeder_akun->token,'GetProfilPT',false,false,'1','0');
        $dataprodiws = Wsneofeeder::getrecordset($feeder_akun->token,'GetProdi');
        $GetPeriodeLampau = Wsneofeeder::getrecordset($feeder_akun->token,'GetPeriodeLampau');
        if($dataptws->error_code == 0){
            return view('dashboard',compact('dataptws','dataprodiws','GetPeriodeLampau'));
        }else{
            $data = $dataptws->error_desc.' | redirectting......';
            return response()->view('expired', compact('data'), 200) 
            ->header("Refresh", "3; url=/wsneofeeder"); 
        }
    }
}