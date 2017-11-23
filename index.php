<?php
$host = "localhost"; //호스트 이름
$user = "root";  //사용자 계정
$passwd = "raspberry";   //비밀번호
$dbname = "assignment";  //디비 이름
try{
	 $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $passwd);
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	 print $e->getMessage();
}

try {  
	$flag="NO";
	$result = $pdo->query("SHOW TABLES");
	while ($row = $result->fetch(PDO::FETCH_NUM)) {
		if($row[0]=="contacts")
		{
			$flag="OK";
			break;
		}
	}
}
catch (PDOException $e) {
	echo $e->getMessage();
}    
if($flag != "OK")
{
	$sql ="create table contacts (
		no int primary key not null auto_increment,
		user varchar(12) not null,
		name varchar(12) not null,
		phonenum varchar(15) not null,
  		sex varchar(10),
 		email varchar(30),
 		date varchar(20),
   		notes text)";

	$pdo->exec($sql);
	print "<font size=4><br><center> DB이름은 ".$dbname." 입니다.</font></center>";
	print "<font size=4><br><center>contacts 테이블을 성공적으로 만들었습니다.</font></center><hr>";
}
else
{
	print "<font size=4><br><center> DB이름은 ".$dbname." 입니다.</font></center>";
	 print "<font size=4><br><center>contacts 테이블은 이미 존재합니다.</font></center><hr>";
}
try{
	$tableList = array();
	$tableType = array();
	$result = $pdo->query("desc contacts");
	while($row = $result->fetch(PDO::FETCH_NUM)){
		$tableList[] = $row[0];
		$tableType[] = $row[1];
	}
	echo '<form action="./process.php?mode=insert" method="POST">';
	echo '<br />';
	for($i = 1; $i < count($tableList); $i++){
		if(!strcmp(substr($tableType[$i],0,7),'varchar')){
			echo '<p>'.$tableList[$i].' : '.'<input type="text" name="'.$tableList[$i].'" placeholder="'.$tableList[$i].'"></p>';
		}else if(!strcmp(substr($tableType[$i],0,4),'text')){
			echo '<p>'.$tableList[$i].' : '.'<textarea name="'.$tableList[$i].'" id="" cols="50" rows="10"></textarea></p>';
		}else{}
	}

	echo '<p><input type="submit" /></p>';
}catch(PDOException $e){
	echo $e->getMessage();
}
?>

<html>
	<head>
		<meta charset="utf-8"/>
	</head>   
	<body>
	</body>
</html>
