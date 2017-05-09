 <?php 
    
    $dataFile = 'gs://pseview.appspot.com/data/companylist.json';
    
    function is_updated_file($filename) {
        $diff = time() - filemtime($filename);
        $expiryDuration =  60 * 60 * 24; //1 day
        return $diff < $expiryDuration;
    }

    if (file_exists($dataFile) && is_updated_file($dataFile)) {
        echo file_get_contents($dataFile);
    } else {
    
        $referer_url = 'http://pse.com.ph/stockMarket/companyInfoSecurityProfile.html';
        $get_companies_url = 'http://pse.com.ph/stockMarket/companyInfoSecurityProfile.html?method=getListedRecords&ajax=true';
        $opts = array(
	  'http'=>array(
	    'method'=>"GET",
	    'header'=>"Referer: $referer_url\r\n"
	  )
	);
    
        $context = stream_context_create($opts);
        $text = file_get_contents('http://pse.com.ph/stockMarket/companyInfoSecurityProfile.html?method=getListedRecords', false, $context); 
        if (json_decode($text)) {
        
	    file_put_contents($dataFile, $text) or die('Unable to write to a file');
	    echo $text;
        } else {
        
            die('Could not parse the following data as JSON: ' + $text);
        }
        
    }

?> 