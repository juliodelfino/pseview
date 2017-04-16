 <?php 
 	parse_str($_SERVER['QUERY_STRING']);
 	$price_info = file_get_contents('http://www.bloomberg.com/markets/api/bulk-time-series/price/' . $code . '%3APM?timeFrame=' . $type); 
 	$volume_info = file_get_contents('http://www.bloomberg.com/markets/api/security/time-series/volume/' . $code . '%3APM?timeFrame=' . $type); 
	print_r('{"price_info":' . $price_info . ', "volume_info":' . $volume_info . '}');
 ?> 