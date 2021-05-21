<?php
session_start(); 
include('atsumori_functions.php'); 

?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>体重推移記録表</title>
</head>

<body>
<form action="weight_create_file.php" method="POST" enctype ="multipart/form-data">
    <div class="title">1日のコンディションチェック</div>   
    <div class="formcheck">
    <div>
        ・朝の体重 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type ="text" name="kg" size="7"> kg
    </div>
    <br>
    <div>
        ・目覚め時間 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type ="time" name="mezame">
    </div>
    <br>
    <div>
        ・昨日の就寝時間 &thinsp; <input type ="time"name="time">
    </div>
    <br>
    <div>
        ・昨日の睡眠熟睡レベル: 
        <input type ="radio"name="level" value="熟睡できた">熟睡できた
        <input type ="radio"name="level" value="よく眠れた">よく眠れた
        <input type ="radio"name="level" value="まぁまぁ眠れた">まぁまぁ眠れた
        <input type ="radio"name="level" value="あまり眠れなかった">あまり眠れなかった
    </div>
    <br>
    <div>
        ・1日のムーブ目標 <input type="text"name="conditontext" placeholder="ウォーキング30分など" size="73"value="">
    </div>
    <br>
    <div>
    ・トレーニング様子の写真をアップしてね &emsp;&emsp;<input type="file" name="upfile" accept="image/*"capture="camera">
    </div>
    </div>
    <div>
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp; <button class="data-btn">データ送信</button>
        <P class="comment">きちんと入力することで日々のコンディション維持に繋がりますよ</P>
        <a href="weight_read.php">集計データはこちら</a>
    </div>
    <div style="padding-top:10px;width:400px;margin:auto">
    <p class="copy" style="margin-top:20px">©️ FORH BODY PERFORMANCE ALL RIGHTS RESERVED.<img src="atsumori.jpeg" alt="atsu"width="100" height="45"></p>
    </div>  
    <div class="memo"> 
    <p>------------------コンディションメモ------------------</p>
    <p>・朝起きたら朝日を浴びよう!!<br>
    ・これから30分散歩できる？<br>
    ・野菜、キノコ、海藻を多く食べようね!!<br>
    ・寝る前のストレッチは熟睡を促しますよ!!</p>
    </div>  
</form>
<script>
document.btn.addEventListener('click', function() {
document.submit();
});
//クルクル回る導入する
//$("#send").on("click",function(){
//$conditioning=""function(){<!-- 送信ボタンを押したらメモが表示される　送信中みたいな感じ がやりたい-->

</script>
</body>

</html>