<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Wsneofeeder;
use App\Helpers\Hfungsi;
use Illuminate\Support\Facades\Validator;
use Session;

class LoginController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->all(),[
            'url' => 'required',
            'username' => 'required',
            'password' => 'required'
        ], [
            'url.required' => 'Url is required',
            'username.required' => 'Username is required',
            'password.required' => 'Password is required'
        ]);

        

        $dataws = array('act'=>'GetToken','username'=>$request->username,'password'=>$request->password);
        $returnws = Wsneofeeder::runWS($dataws,false,$request->url);
        $returnws = json_decode($returnws);

        $validator->after(function ($validator) use ($returnws) {
            if (!$returnws || $returnws == null) {
                $validator->errors()->add('url', 'Neo Feeder tidak running!');
            }else{
                if($returnws->error_code != 0){
                    $validator->errors()->add('url', $returnws->error_desc);
                }
            }
        });
        //dd($returnws);
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }
        $datauserfeeder = array('act'=>'GetToken','username'=>$request->username,'password'=>$request->password,'url'=>$request->url,"token"=>$returnws->data->token);
        Session::put('neofeeder_akun', Hfungsi::array_to_object($datauserfeeder));
        return redirect('/dashboard');

    }
    public function logout(){
        Session::flush();
        return redirect('/');
    }

}