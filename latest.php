<?php
$dataFile = 'gs://pseview.appspot.com/data/latest.json';

//if (is_market_open() || is_file_time_during_market_open($dataFile) || is_file_outdated($dataFile)) {

    $referer_url = 'http://pse.com.ph/stockMarket/home.html';
    $get_stocks_url = 'http://pse.com.ph/stockMarket/home.html?method=getSecuritiesAndIndicesForPublic&ajax=true';
    $opts = array('http' => array('method' => "GET", 'header' => "Referer: $referer_url\r\n"));

    $context = stream_context_create($opts);

    $text = file_get_contents($get_stocks_url, false, $context);

    //sometimes it's empty text or empty array []
    if (empty($text) || strlen($text) < 3) {
        $text = file_get_contents($dataFile) or die('File not found');
    } else {
        file_put_contents($dataFile, $text) or die('Unable to write to a file');
    }
//} else {
//    $text = file_get_contents($dataFile) or die('File not found');
//}

echo $text;

function get_DateTime($timestamp) {
    $tz = new DateTimeZone('Asia/Singapore');
    $date = new DateTime();
    if (!empty($timestamp)) {
        $date -> setTimestamp($timestamp);
    }
    $date -> setTimezone($tz); 
    return $date;
}

function is_market_open_on_timestamp($timestamp) {

    $date = get_DateTime($timestamp);
    $day_of_week = $date -> format('w');
    //0 for Sunday -> 6 for Saturday
    $is_open = false;
    if ($day_of_week > 0 && $day_of_week < 6) {
        $hr_min = $date -> format('Gi');

        $is_open = ($hr_min >= 930 && $hr_min <= 1530);
    }
    return $is_open;
}

function is_market_open() {

    $ret = is_market_open_on_timestamp(time());
    return $ret;
}

function is_file_time_during_market_open($filename) {

    $ret = is_market_open_on_timestamp(filemtime($filename));
    return $ret;
}

/* Checks if the file is outdated by date YYYY-mm-dd */
function is_file_outdated($filename) {
    
    $fileYmd = get_DateTime($timestamp) -> format('Ymd');
    $nowYmd = get_DateTime(time()) -> format('Ymd');
    return $nowYmd > $fileYmd;
}

?>
