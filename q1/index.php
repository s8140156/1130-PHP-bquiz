<?php include_once "db.php"; ?>
<!-- 記得要宣告 -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>題組一</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/css.css">
</head>

<body>
<div id="cover" style="display:none; ">
	<div id="coverr">
    	<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl('#cover')">X</a>
        <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
    </div>
</div>
	<header class="container">
		<?php
		$img=$Title->find(['sh'=> 1]);
		// dd($img);
		?>
		<img src="./img/<?=$img['img'];?>" alt="">
	</header>
	<main class="container">
		<h3 class="text-center">網站標題管理</h3>
		<hr>
		<form action="edit_title.php" method="post">
			<!-- 找到原來沒有給這張表單要執行的地方 天啊 -->
			<table class="table table-bodered text-center">
				<tr>
					<td>網站標題</td>
					<td>替代文字</td>
					<td>顯示</td>
					<td>刪除</td>
					<td></td>
				</tr>
				<?php
				$rows=$Title->all();
				foreach($rows as $row){
				?>
				<tr>
					<td><img src="./img/<?=$row['img'];?>" style="width:300px;height:30px" alt=""></td>
					<td><input type="text" name="text[]" id="" value="<?=$row['text'];?>"style="width:90%"></td>
					<!-- 將name=使用"text[]"可以讓新增的每筆text內容全部放到 陣列並排序(就可依序而不會只會被最新的筆數蓋掉) -->
					<td><input type="radio" name="sh" id="" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>></td>
					<!-- 三元運算式：如果對應資料庫sh顯示為1時, 增加'checked屬性 若不是1不需增加(顯示空值即可)' -->
					<td><input type="checkbox" name="del[]" id="" value="<?=$row['id'];?>"></td>
					<!-- also del因為可能有多筆刪除 在name加上del[],並給予value 從資料庫取得對應哪個id的資料-->
					<td><input class='btn btn-warning' type="button" value="更新圖片" onclick="op('#cover','#cvr','upload_title.php?id=<?=$row['id'];?>')"></td>
					<input type="hidden" name="id[]" value="<?=$row['id'];?>">
				</tr>
				<?php
				}
				?>
			</table>
			<div class="d-flex justify-content-between">
				<div><input type="button" onclick="op('#cover','#cvr','title.php')" value="新增網站標題圖片"></div>
				<!-- 這邊為什麼沒有?do=titile要找來聽一下 -->
				<div>
					<input type="submit" value="修改確定">
					<input type="reset" value="重置">

				</div>
				<div></div>
			</div>
		</form>
	</main>

	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/js.js"></script>
	<script src="../js/bootstrap.js"></script>
</body>

</html>