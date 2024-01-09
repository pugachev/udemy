<?php

require_once("libray/log.php");

$logFile = __DIR__."/log/import_users.log";
writeLog($logFile,"社員情報登録バッチ 開始");
$dataCount=0;

//データベース接続
$username = "udemy_user";
$password = "udemy_pass";
$hostname = "db";
$db = "udemy_db";
$pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8",$username,$password);

//社員情報CSVオープン
$fp = fopen(__DIR__."/import_users.csv","r");

//トランザクション開始
$pdo->beginTransaction();

//ファイルを1行ずつ読込、終端まで繰り返し
while($data=fgetcsv($fp)){
    $sql = "SELECT * FROM users WHERE id =".$data[0];
    // $param = array(":id" => $data[0]);
    $stmt = $pdo->query($sql);
    $count = $stmt->rowCount();
    var_dump("sql=".$sql);
    //SQLの結果件数は0件？
    if($count>0){
        //社員情報更新SQLの実行
        // $usql = "UPDATE users values(:id,:name,:name_kana,:birthday,:gender,:organization,:post,:start_date,:tel,:mail_address,:updated) WHERE id = :id";
        $usql = "UPDATE users SET id=:id, name=:name, name_kana=:name_kana, birthday=:birthday,gender=:gender,organization=:organization,post=:post,start_date=:start_date,tel= :tel,mail_address=:mail_address,updated=:updated WHERE id =".$data[0];
        $uparam = array(
            ":id" => $data[0],
            ":name" => $data[1],
            ":name_kana" => $data[2],
            ":birthday" => $data[3],
            ":gender" => $data[4],
            ":organization" => $data[5],
            ":post" => $data[6],
            ":start_date" => $data[7],
            ":tel" => $data[8],
            ":mail_address" => $data[9],
            ":updated" => date('Y-m-d H:i:s')
        );
        var_dump('既存修正');
        var_dump($uparam);
        $ustmt = $pdo->prepare($usql);
        $ustmt->execute($uparam);
    }else{
        //社員情報登録SQLの実行
        $isql = "INSERT INTO users(id,name,name_kana,birthday,gender,organization,post,start_date,tel,mail_address,created,updated) values(:id,:name,:name_kana,:birthday,:gender,:organization,:post,:start_date,:tel,:mail_address,:created,:updated)";
        $iparam = array(
            ":id" => $data[0],
            ":name" => $data[1],
            ":name_kana" => $data[2],
            ":birthday" => $data[3],
            ":gender" => $data[4],
            ":organization" => $data[5],
            ":post" => $data[6],
            ":start_date" => $data[7],
            ":tel" => $data[8],
            ":mail_address" => $data[9],
            ":created" => date('Y-m-d H:i:s'),
            ":updated" => date('Y-m-d H:i:s')
        );
        var_dump('新規登録');
        var_dump($iparam);
        $istmt = $pdo->prepare($isql);
        $istmt->execute($iparam);
        $dataCount++;
    }

}
$pdo->commit();
//社員情報CSVクローズ
fclose($fp);

writeLog($logFile,"社員情報登録バッチ 終了[処理件数: {$dataCount}件]");



