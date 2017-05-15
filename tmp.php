 <?php 
            
    testCompanyInfoHistoricalData();


    function testFindSecurityOrCompany() {

        $referer_url = 'http://pse.com.ph/stockMarket/home.html';
        $get_stocks_url = 'http://pse.com.ph/stockMarket/home.html?method=findSecurityOrCompany&ajax=true';
        $opts = array(
	  'http'=>array(
	    'method'=>"POST",
            'header'=>"Referer: $referer_url\r\n",
            'content' => "start=0&limit=1&query=AC"
	  )
	);

        $context = stream_context_create($opts);

        $text = file_get_contents($get_stocks_url, false, $context);
   
        echo $text;
    }

    function testCompanyInfo() {

        $referer_url = 'http://pse.com.ph/stockMarket/companyInfo.html';
        $get_stocks_url = 'http://pse.com.ph/stockMarket/companyInfo.html?method=fetchHeaderData&ajax=true';
        $opts = array(
	  'http'=>array(
	    'method'=>"POST",
            'header'=>"Referer: $referer_url\r\n",
            'content' => "company=57&security=180"
	  )
	);

        $context = stream_context_create($opts);

        $text = file_get_contents($get_stocks_url, false, $context);
   
        echo $text;
    }

    function testCompanyInfoHistoricalData() {

        $referer_url = 'http://pse.com.ph/stockMarket/companyInfoHistoricalData.html';
        $get_stocks_url = 'http://pse.com.ph/stockMarket/companyInfoHistoricalData.html?method=getRecentSecurityQuoteData&ajax=true';
        $opts = array(
	  'http'=>array(
	    'method'=>"POST",
            'header'=>"Referer: $referer_url\r\n",
            'content' => "security=520"
	  )
	);

        $context = stream_context_create($opts);

        $text = file_get_contents($get_stocks_url, false, $context);
   
        echo $text;
    }

    function testDailySummary() {

        $referer_url = 'http://pse.com.ph/stockMarket/home.html';
        $get_stocks_url = 'http://pse.com.ph/stockMarket/home.html?method=fetchIndicesDetails&ajax=true';
        $opts = array(
	  'http'=>array(
            'header'=>"Referer: $referer_url\r\n"
	  )
	);

        $context = stream_context_create($opts);

        $text = file_get_contents($get_stocks_url, false, $context);
   
        echo $text;
    }

 ?> 