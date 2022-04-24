<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Mfungsi extends Model
{
    public function semester($val=false){
		$data=array("1"=>"Ganjil","2"=>"Genap","3"=>"Pendek");
        if($val){
            $ret = $data[$val];
        }else{
            $ret = $data;
        }
		return $ret;
	}
    public function kelamin($val=false){
        $data = array("L"=>"Laki-laki","P"=>"Perempuan");
        if($val){
            $ret = $data[$val];
        }else{
            $ret = $data;
        }
		return $ret;
    }
}