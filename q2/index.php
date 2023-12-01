<?php include_once "db.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>題組二</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/css.css">
	<style>
		fieldset.scheduler-border {
			border: 1px groove #ddd !important;
			padding: 0 1.4em 1.4em 1.4em !important;
			margin: 0 0 1.5em 0 !important;
			-webkit-box-shadow: 0px 0px 0px 0px #000;
			box-shadow: 0px 0px 0px 0px #000;
		}

		legend.scheduler-border {
			font-size: 1.2em !important;
			font-weight: bold !important;
			text-align: left !important;
		}
	</style>
</head>

<body>
	<header class="p-5">
		<h1 class="text-center">問卷調查</h1>
	</header>
	<main class="container">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">目前位置:首頁 > 問卷調查</legend>
			<table class="table">
				<tr>
					<th>編號</th>
					<th>問卷題目</th>
					<th>投票總數</th>
					<th>結果</th>
					<th>狀態</th>
				</tr>
			<?php
			$ques=$Que->all(['subject_id'=>0]);
			foreach($ques as $ind => $que){

			?>


				<tr>
					<td><?=$ind+1;?></td>
					<td><?=$que['text'];?></td>
					<td><?=$que['count'];?></td>
					<td><a class="btn btn-warning" href="result.php?id=$<?=$que['id'];?>">投票結果</a></td>
					<td><a class="btn btn-info" href="vote.php?=<?$que['id'];?>">我要投票</a></td>

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