<?php
$dbh = new PDO('mysql:host=localhost;dbname=assignment', 'root', 'raspberry');
$stmt = $dbh->prepare('SELECT * FROM contacts WHERE no = :no');
$stmt->bindParam(':no', $no, PDO::PARAM_INT);
$no = $_GET['no'];
$stmt->execute();
$contacts = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>   
    <body>
        <form action="./process.php?mode=modify" method="POST">
            <input type="hidden" name="no" value="<?=$contacts['no']?>" />
            <p>userID : <input type="text" name="user" value="<?=htmlspecialchars($contacts['user'])?>"></p>
            <p>name : <input type="text" name="name" value="<?=htmlspecialchars($contacts['name'])?>"></p>
            <p>phonenum : <input type="text" name="phonenum" value="<?=htmlspecialchars($contacts['phonenum'])?>"></p>
            <p>sex : <input type="text" name="sex" value="<?=htmlspecialchars($contacts['sex'])?>"></p>
            <p>email : <input type="text" name="email" value="<?=htmlspecialchars($contacts['email'])?>"></p>
            <p>date : <input type="text" name="date" value="<?=htmlspecialchars($contacts['date'])?>"></p>
            <p>notes : <textarea name="notes" id="" cols="50" rows="10"><?=htmlspecialchars($contacts['notes'])?></textarea></p>
            <p><input type="submit" /></p>
        </form>
    </body>
</html>
			

