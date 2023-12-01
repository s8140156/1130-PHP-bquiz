<?php include_once "db.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>問卷後台管理</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/css.css">
</head>

<body>
	<header class="container p-5">
		<h1 class="text-center">問卷調查</h1>
	</header>
	<main class="container p-3">
		<fieldset>
			<legend>新增問卷</legend>
			<form action="./api/add_que.php" method="post">
				<!-- 主題 -->
				<div class="d-flex">
					<div class="col-3 bg-light p-2">問卷名稱</div>
					<div class="col-6 p-2"><input type="text" name="subject" id="">
					</div>
				</div>
				<!-- 選項 -->
				<div class="bg-light">
					<div class="p-2" id="option">
						<label for="">選項</label>
						<input type="text" name="opt[]" id="">
						<!-- 因為會有多筆選項上傳在name使用陣列包喔 -->
						<input type="button" value="更多" onclick="more()">
					</div>
				</div>
				<div>
					<input type="submit" value="新增">
					<input type="reset" value="清空">
				</div>
			</form>
		</fieldset>

	<fieldset>
		<legend>問卷列表</legend>
		<div class="col-9 mx-auto">
			<table class="table">
				<tr>
					<th>編號</th>
					<th>主題內容</th>
					<th>操作</th>
				</tr>
				<?php
				$ques=$Que->all(['subject_id'=>0]);
				foreach($ques as $ind => $que){
				?>
				<tr>
					<td><?=$ind+1;?></td>
					<td><?=$que['text'];?></td>
					<td>
						<button class="btn btn-success">顯示</button>
						<button class="btn btn-info">編輯</button>
						<a href="./api/del.php?id=<?=$que['id'];?>">
							<button class="btn btn-danger">刪除</button>
						</a>
					</td>
				</tr>
				<?php
				}
				?>
			</table>

		</div>
	</fieldset>
	</main>


	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/js.js"></script>
	<script src="../js/bootstrap.js"></script>
</body>

</html>

<script>
	function more(){
		let opt=`<div class="p-2">
					<label for="">選項</label>
					<input type="text" name="opt[]" id="">
				</div>`
		$("#option").before(opt)
	}
</script>