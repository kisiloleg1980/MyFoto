<?php


class view_date 

{
	
static function format_date($date_load){
	foreach ($date_load as &$value) {
		$new_date=date_parse($value['date_time']);
		switch (  $new_date['month']) {
			case 1: $str='Января'; break;
			case 2: $str='Февраля'; break;
			case 3: $str='Марта'; break;
			case 4: $str='Апреля'; break;
			case 5: $str='Май';	break;
			case 6: $str='Июнь'; break;
			case 7: $str='Июль'; break;
			case 8: $str='Август'; break;
		}
		$value['date_time']=$new_date['day'].' '.$str.' '.$new_date['year'].'г';
	}
	return $date_load;
}
}

?>