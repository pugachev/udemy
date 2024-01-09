<?php
// 3で割り切れる→Fizz
// 5で割り切れる→Buzz
// 両方で割り切れる→FizzBuzz
// 上記のどれでもわりきれいな→入力値を表示

$target=$argv[1];

if($target%3===0 && $target%5===0){//3でも5でも割り切れる→最も制約が強い
    echo "FizzBuzz".PHP_EOL;
}else if($target%3===0){
    echo "Fizz".PHP_EOL;
}else if($target%5===0){
    echo "Buzz".PHP_EOL;
}else{
    echo $target.PHP_EOL;
}