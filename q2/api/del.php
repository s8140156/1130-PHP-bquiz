<?php

include_once "../db.php";

if(isset($_GET['id'])){
	$Que->del($_GET['id']);
	// 指定id的資料
	$Que->del(['subject_id'=>$_GET['id']]);
	//指定條件的資料

}

header("location:../admin.php");

?>