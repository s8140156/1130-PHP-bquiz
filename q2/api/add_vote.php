<?php include_once "../db.php";


$opt=$Que->find($_POST['opt']);
$opt['count']=$opt['count']+1;
// 每個選項票數小計

$subject=$Que->find($opt['subject_id']);
$subject['count']=$subject['count']+1;
// 總票數(各選項票數加總)

$Que->save($opt);
$Que->save($subject);

header("location:../result.php?id={$subject['id']}")
// 這邊聽老師講一下為何要傳id至result?

 ?>
