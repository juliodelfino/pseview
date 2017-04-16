 <?php 

    getStockInfoFromPse();

    function getStockInfoFromPse() {

 	parse_str($_SERVER['QUERY_STRING']);
 	$companyResponse = json_decode(findSecurityOrCompany($code));
        $companyInfo = $companyResponse->records[0];
        $companyId = $companyInfo->listedCompany_companyId;
        $securityId = $companyInfo->securityId;

        echo getCompanyDetails($companyId, $securityId);
    }

    function getStockInfoFromBpiTrade() {

 	parse_str($_SERVER['QUERY_STRING']);
 	$xml_string = file_get_contents('https://bpitrade.cdn.technistock.net/quotes/si-bna-10Lvl.asp?list=20&list2=10&code=' . $code); 
 	$xml = simplexml_load_string($xml_string);
	$json = json_encode($xml);
	print_r($json);
    }

    /* private functions */
    function findSecurityOrCompany($code) {

        $referer_url = 'http://pse.com.ph/stockMarket/home.html';
        $get_stocks_url = 'http://pse.com.ph/stockMarket/home.html?method=findSecurityOrCompany&ajax=true';
        $opts = array(
	  'http'=>array(
	    'method'=>"POST",
            'header'=>"Referer: $referer_url\r\n",
            'content' => "start=0&limit=1&query=" . $code
	  )
	);

        $context = stream_context_create($opts);

        $text = file_get_contents($get_stocks_url, false, $context);
   
        return $text;
    }

    function getCompanyDetails($companyId, $securityId) {

        $referer_url = 'http://pse.com.ph/stockMarket/companyInfo.html';
        $get_stocks_url = 'http://pse.com.ph/stockMarket/companyInfo.html?method=fetchHeaderData&ajax=true';
        $opts = array(
	  'http'=>array(
	    'method'=>"POST",
            'header'=>"Referer: $referer_url\r\n",
            'content' => "company=" . $companyId . "&security=" . $securityId
	  )
	);

        $context = stream_context_create($opts);

        return file_get_contents($get_stocks_url, false, $context);
    }
 ?> 