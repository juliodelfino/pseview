 <?php 

    getDailySummary();

    function getDailySummary() {

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