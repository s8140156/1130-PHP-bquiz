<?php

include_once "db.php";

if(isset($_POST['id'])){
	$row=$Title->find($_POST['id']);

	if(!empty($_FILES['img']['tmp_name'])){
		move_uploaded_file($_FILES['img']['tmp_name'],'./img/' .$_FILES['img']['name']);
		// 這邊要注意使用move_uploaded_file當檔案被更改時, 檔名相同會用最新的去覆蓋前面的 **由於這邊的檔案命名是以"檔案名"為主 重複的檔案要小心
		$row['img']=$_FILES['img']['name'];
		$Title->save($row);
	}
}

header("location:index.php");

?>