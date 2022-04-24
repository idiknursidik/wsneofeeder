<?php
namespace App\Helpers;

class Hfungsi {
    public static function object_to_array($data){
		if (is_array($data) || is_object($data)){
			$result = array();
			foreach ($data as $key => $value){
				$result[$key] = self::object_to_array($value);
			}
			return $result;
		}
		return $data;
	}
	public static function array_to_object(array $array){
		foreach($array as $key => $value)
		{
			if(is_array($value))
			{
				$array[$key] = self::array_to_object($value);
			}
		}
		return (object)$array;
	}	

	public static function pagging($totaldata,$halaman,$pageawal){
		$mulai = ($pageawal>1) ? ($pageawal * $halaman) - $halaman : 0;
		$pages = ceil($totaldata/$halaman);
		for ($i=1; $i<=$pages ; $i++){
			$ret[$i]['page'] = $i;
		}
		return self::array_to_object($ret);
	}
	public function paging($numRows,$limit,$page,$url){
		$allPages       = ceil($numRows / $limit);	
		$start          = ($page - 1) * $limit;	
		$querystring = $url;	
		foreach ($_GET as $key => $value) {
			if ($key != "listdata") $paginHTML .= $key=$value;
		}	
		$paginHTML = "";	
		$paginHTML .= "Pages: ";
			
		if ($page > 1) {
			$prev = $page-1;
			$paginHTML .= '<a class="halaman" href="'.$querystring.'" page="'.$prev.'">Previous</a>';
		}		
	
		for ($i = 1; $i <= $allPages; $i++) {	
			if ($i > 4 && $i != $allPages && $i != $page) {
				$paginHTML.= ".";
			}else if($i == $page){
				$paginHTML .= " <a class='halaman". ($i == $page ? " text-danger":"")."'";
				$paginHTML .= "href='".$querystring."' page='".$i."'";
				$paginHTML .= ">".$i."</a> ";
			}else{
				$paginHTML .= " <a class='halaman' href='".$querystring."' page='".$i."'>".$i."</a> ";
			}
					
		}	
		if ($page < $allPages) {
			$next = $page+1;
			$paginHTML .= '<a class="halaman" href="'.$querystring.'" page="'.$next.'">Next</a>';
		}
		return $paginHTML;	
	 }
	
}