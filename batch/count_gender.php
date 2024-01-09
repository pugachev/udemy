<?php
//社員情報CSVファイルのオープン
$fp = fopen(__DIR__."/input.csv","r");
$cnt = 1;
$men=0;
$women=0;
while($data=fgetcsv($fp)){
    // var_dump($data);
    if($cnt===1) {
        $cnt++;
        continue;
    }
    if($data[4]==="男性"){
        $men++;
        $cnt++;
        // echo $men.' '.$cnt.PHP_EOL;
    }else if($data[4]==="女性"){
        $women++;
        $cnt++;
        // echo $men.' '.$cnt.PHP_EOL;
    }
}

fclose($fp);

//出力CSVファイルのオープン
$fp = fopen(__DIR__."/output.csv","w");
fputcsv($fp,array("男性","女性"));
fputcsv($fp,array($men,$women));
// fwrite($fp, "男性","女性");
// fwrite($fp,$men,$women);
fclose($fp);

?>