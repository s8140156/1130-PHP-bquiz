<?php include_once "db.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>題組二</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/css.css">
</head>

<body>
	<header class="p-5">
		<h1 class="text-center">問卷調查</h1>
	</header>
	<main class="container">
		<fieldset>
			<legend>目前位置:首頁 > 問卷調查</legend>
			<table class="table">
				<tr>
					<th>編號</th>
					<th>問卷題目</th>
					<th>投票總數</th>
					<th>結果</th>
					<th>狀態</th>
				</tr>
			<?php
			$ques=$Que->all(['subject_id'=>0,'sh'=>1]);
			foreach($ques as $idx => $que){
				// 這邊應該是接收後台管理已選定的要顯示/隱藏的主題訊息
				// 從資料庫撈出指定id=0的主題 及'sh'是1 所以才要顯示出來

			?>


				<tr>
					<td><?=$idx+1;?></td>
					<td><?=$que['text'];?></td>
					<td><?=$que['count'];?></td>
					<td><a class="btn btn-warning" href="result.php?id=<?=$que['id'];?>">投票結果</a></td>
					<td><a class="btn btn-info" href="vote.php?id=<?=$que['id'];?>">我要投票</a></td>

				</tr>
				<?php
				}
				?>

			</table>

		</fieldset>

	</main>

	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/js.js"></script>
	<script src="../js/bootstrap.js"></script>
</body>

</html>