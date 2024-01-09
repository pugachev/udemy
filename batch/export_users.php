<?php
$username = "udemy_user";
$password = "udemy_pass";
$hostname = "db";
$db = "udemy_db";
$pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8",$username,$password);

$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$outputdata = array();
//SQLを実行
$result = $stmt->execute();
// $results = $stmt->fetch(PDO::FETCH_ASSOC);
$results = $stmt->fetchAll();

$csvdata = "社員番号,社員名,社員名カナ,生年月日,性別,所属部署,役職,入社年月日,電話番号,メールアドレス,作成日時,更新日時\r\n";
foreach($results as $val){
    $csvdata .= $val['id'].",";
    $csvdata .= $val['name'].",";
    $csvdata .= $val['name_kana'].",";
    $csvdata .= $val['birthday'].",";
    $csvdata .= $val['gender'].",";
    $csvdata .= $val['organization'].",";
    $csvdata .= $val['post'].",";
    $csvdata .= $val['start_date'].",";
    $csvdata .= $val['tel'].",";
    $csvdata .= $val['created'].",";
    $csvdata .= $val['updated']."\r\n";
}

//出力CSVファイルのオープン
$fp = fopen(__DIR__."/export_users.csv","w");
$csvstr = mb_convert_encoding($csvdata, "UTF-8", "UTF-8");
fwrite($fp,$csvstr);
fclose($fp);


// foreach($results as $key=>$val){
//     echo $val['id'].PHP_EOL;
//     $tmp = array(
//         $val['id'],
//         $val['name'],
//     );
    // $tmp.push($val['id']);
    // $tmp.push($val['name']);
    // $tmp.push($val['name_kana']);
    // $tmp.push($val['birthday']);
    // $tmp.push($val['gender']);
    // $tmp.push($val['organization']);
    // $tmp.push($val['post']);
    // $tmp.push($val['start_date']);
    // $tmp.push($val['tel']);
    // $tmp.push($val['created']);
    // $tmp.push($val['updated']);
    // $outputdata.push($tmp);
// }
// var_dump($outputdata);//戻り値は連想配列っぽい
// $results = new array();
// while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//     var_dump($row);
// }

//社員情報CSVファイルのオープン
// $fp = fopen(__DIR__."/input.csv","r");
// $cnt = 1;
// $men=0;
// $women=0;
// while($data=fgetcsv($fp)){
//     // var_dump($data);
//     if($cnt===1) {
//         $cnt++;
//         continue;
//     }
//     if($data[4]==="男性"){
//         $men++;
//         $cnt++;
//         // echo $men.' '.$cnt.PHP_EOL;
//     }else if($data[4]==="女性"){
//         $women++;
//         $cnt++;
//         // echo $men.' '.$cnt.PHP_EOL;
//     }
// }

// fclose($fp);

// //出力CSVファイルのオープン
// $fp = fopen(__DIR__."/output.csv","w");
// fputcsv($fp,array("男性","女性"));
// fputcsv($fp,array($men,$women));
// // fwrite($fp, "男性","女性");
// // fwrite($fp,$men,$women);
// fclose($fp);

?>