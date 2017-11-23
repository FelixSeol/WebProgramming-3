<?php
$dbh = new PDO('mysql:host=localhost;dbname=assignment', 'root', 'raspberry', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
switch($_GET['mode']){
    case 'insert':
        $stmt = $dbh->prepare("INSERT INTO contacts (user, name, phonenum, sex, email, date, notes) VALUES (:user, :name, :phonenum, :sex, :email, :date, :notes)");
        $stmt->bindParam(':user',$user);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':phonenum',$phonenum);
        $stmt->bindParam(':sex',$sex);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':notes',$notes);
        $user = $_POST['user'];
        $name = $_POST['name'];
        $phonenum= $_POST['phonenum'];
        $sex= $_POST['sex'];
        $email= $_POST['email'];
        $date= $_POST['date'];
        $notes= $_POST['notes'];
        $stmt->execute();
        header("Location: list.php"); 
        break;
    case 'delete':
        $stmt = $dbh->prepare('DELETE FROM contacts WHERE no = :no');
        $stmt->bindParam(':no', $no);
 
        $no = $_POST['no'];
        $stmt->execute();
        header("Location: list.php"); 
        break;
    case 'search':
	$stmt = $dbh->prepare('SELECT * FROM contacts WHERE user = :user');
	$stmt->bindParam(':user',$user);
	$user = $_POST['user'];
	$stmt->execute();
	$who = $stmt->fetch();
        header("Location: modify.php?no={$who['no']}");
	break;
    case 'modify':
        $stmt = $dbh->prepare('UPDATE contacts SET user = :user, name = :name, phonenum = :phonenum, sex = :sex, email = :email, date = :date, notes = :notes WHERE no = :no');
        $stmt->bindParam(':user',$user);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':phonenum',$phonenum);
        $stmt->bindParam(':sex',$sex);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':notes',$notes);
        $stmt->bindParam(':no',$no);
 
        $user = $_POST['user'];
        $name = $_POST['name'];
        $phonenum= $_POST['phonenum'];
        $sex= $_POST['sex'];
        $email= $_POST['email'];
        $date= $_POST['date'];
        $notes= $_POST['notes'];
        $no = $_POST['no'];
        $stmt->execute();
        header("Location: list.php?no={$_POST['no']}");
        break;
}
?> 

