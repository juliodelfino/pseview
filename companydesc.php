 <?php 
    
    parse_str($_SERVER['QUERY_STRING']);
    
    $dataFile = 'gs://pseview.appspot.com/data/companydesc/' . $id . '_' . $code . '.txt';
    
    if (!file_exists($dataFile)) {
    
        $response = file_get_contents('http://edge.pse.com.ph/companyInformation/form.do?cmpy_id=' . $id);
        $pattern = "/<\/caption>\s+<tr>\s+<td>(.*?)<\/td>/";
        preg_match($pattern, $response, $matches);
        $text = $matches[1];
        
        if (empty($text)) {
            $text = file_get_contents($dataFile) or die('File not found');
        } else {
            file_put_contents($dataFile, $text) or die('Unable to write to a file');
        }
    } else {
        $text = file_get_contents($dataFile) or die('File not found');
    }
    
    echo $text;
  
?> 