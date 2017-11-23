<?php
$dbh = new PDO('mysql:host=localhost;dbname=assignment', 'root', 'raspberry');
$stmt = $dbh->prepare('SELECT * FROM contacts');
$stmt->execute();
$list = $stmt->fetchAll();
if(!empty($_GET['no'])) {
		$stmt = $dbh->prepare('SELECT * FROM contacts WHERE no = :no');
		$stmt->bindParam(':no', $no, PDO::PARAM_INT);
		$no = $_GET['no'];
		$stmt->execute();
		$contacts = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<style type="text/css">
			body {
				font-size: 0.8em;
				font-family: dotum;
				line-height: 1.6em;
			}
			header {
				border-bottom: 1px solid #ccc;
				padding: 20px 0;
			}
			nav {
				float: left;
				margin-right: 20px;
				min-height: 1000px;
				min-width:150px;
				border-right: 1px solid #ccc;
			}
			nav ul {
				list-style: none;
				padding-left: 0;
				padding-right: 20px;
			}
			article {
				float: left;
			}
			.notes{
				width:500px;
			}
			.add{
				width:300px;
				padding :30px;
			}

		</style>
	</head>

	<body id="body">
		<div>
			<nav>
				<ul>
<?php
foreach($list as $row) {
		echo "<li><a href=\"?no={$row['no']}\">".htmlspecialchars($row['user'])."</a></li>";                        
}
?>
				</ul>
		<div class="add">
			<ul>
			<li><a href="index.php">추가</a></li>
			<li><form method="POST" action="process.php?mode=search">
				<input type="text" name="user" placeholder="ID검색"/>
				<input type="submit" value="검색"/>
			</form></li>
			</ul>
		</div>
			</nav>
			<article>
<?php
		if(!empty($contacts)){
?>
			<h2><?=htmlspecialchars($contacts['user'])?></h2>
			<div class="notes">
				<p>name : <?=htmlspecialchars($contacts['name'])?></p>
				<p>phonenum : <?=htmlspecialchars($contacts['phonenum'])?></p>
				<p>sex : <?=htmlspecialchars($contacts['sex'])?></p>
				<p>email : <?=htmlspecialchars($contacts['email'])?></p>
				<p>date : <?=htmlspecialchars($contacts['date'])?></p>
				<p>notes : <?=htmlspecialchars($contacts['notes'])?></p>
			</div>
			<div>
				<a href="modify.php?no=<?=$contacts['no']?>">수정</a>
				<form method="POST" action="process.php?mode=delete">
					<input type="hidden" name="no" value="<?=$contacts['no']?>" />
					<input type="submit" value="삭제" />
				</form>
			</div>
<?php
}
?>
			</article>
		</div>
	</body>
</html>
