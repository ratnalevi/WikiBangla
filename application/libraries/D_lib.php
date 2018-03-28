<?php 

class d_lib
{   
	// mysql date insert
    public function insert_date($date) {	
        return date('Y-m-d',strtotime($date));
    }
    
    public function show_date($date) {
    	if($date=='1970-01-01'){
			return '';
		}elseif($date=='0000-00-00'){
			return '';
		}elseif($date==''){
			return '';
		}else{
			return date('d-m-Y',strtotime($date));
		}
    }
    
    public function example_info($offset,$limit,$total_rows){
		$off = $offset+1;
		$limit = $offset+$limit;
		if($limit>$total_rows){
			$lim = $total_rows;
		}else{
			$lim = $limit;
		}
		if($total_rows){
			return "<div class='example_info' id='example_info'>Showing $off to $lim of $total_rows entries</div>";  
		}else{
			return "";  
		}		
	}
	
	public function breadcrumb($link,$link_title='',$title){
		$row = '<div class="page-bar">
			<ul class="page-breadcrumb">
			    <li>
			        <a href="'.base_url().'zadmin">Home</a>
			        <i class="fa fa-circle"></i>
			    </li>';
		if($link_title!=''){
		$row .= '<li>
			        <a href="'.base_url().''.$link.'">'.$link_title.'</a>
			        <i class="fa fa-circle"></i>
			    </li>';
		}
		$row .= '<li>
			        <span>'.$title.'</span>
			    </li>
			</ul>
		</div>';
		return $row;
	}
	
	public function mobile($mobile_number){
		return '+880'.$mobile_number;
	}
	
	public function currency($amount){
		return 'TK. '.$amount;
	}
	
	public function hour($hour){
		if($hour=='1'){
			return $hour.' Hour';
		}else{
			return $hour.' Hours';
		}
	}
	
	public function period($day){
		if($day=='1'){
			return $day.' Day';
		}else{
			return $day.' Days';
		}
	}
	
	public function range($start,$end){
		return range($start,$end);
	}
	
	function get_def_word($text,$wnumber)
	{
		$words = $wnumber;
		$wordCount = count(explode(' ',$text));
		if ($wordCount < $words){
			$adjustedText = $text;
		}else{
			$adjustedText = implode(' ', array_slice(explode(' ',$text), 0, $words));
		}
		
		return strip_tags($adjustedText);
	}
	
	function number_format($amount)
	{
		return number_format($amount);
	}
	
	function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}


