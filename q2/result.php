<?php include_once "db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>投票結果</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/css.css">
</head>

<body>

	<header class="p-5">
		<h1 class="text-center">投票結果</h1>
	</header>
	<main class="container">


		<?php
		$subject = $Que->find($_GET['id']);
		?>
		<h2 class="text-center"><?= $subject['text']; ?></h2>
		
			<ul class="list-group col-6 mx-auto">
				<?php
				$opts = $Que->all(['subject_id' => $_GET['id']]);
				foreach ($opts as $ind => $opt) {
					$div=($subject['count']>0)?$subject['count']:1;
					// 分母不能為0, 如果尚未投票 而進入畫面 抓到count沒有值 先將分母變成1
					$rate=round($opt['count']/$div,3);

				?>
					<li class="list-group-item list-group-item-action">
						<?=$ind+1;?>.
						<?= $opt['text']; ?>
					</li>
					<div class="col-6 d-flex">
						<div class="col-8 bg-secondary" style="width:<?=$rate*0.667*100;?>%"></div>
						<dic class="col-4">&nbsp;&nbsp;<?=$opt['count'];?>票(<?=$rate*100?>%)</div>
					</div>
				<?php
				}
				?>
			</ul>
			<button class="btn btn-primary d-inline-block mx-auto my-5" onclick="location.href='index.php'">返回</button>
		</form>

	</main>




	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/js.js"></script>
	<script src="../js/bootstrap.js"></script>
</body>

</html>