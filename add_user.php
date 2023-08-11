<?php

extract($_POST);

$conn = new PDO('sqlite:file:secret.db?mode=rwc');

// $SQL = "DELETE FROM whitelist";
// $stmt = $conn->prepare($SQL);
// $stmt->execute();

$SQL = "SELECT * FROM whitelist WHERE email='".$email."' OR link='".$wallet."'";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($result==[]){
    $conn->exec('INSERT INTO whitelist (email, link) VALUES ("'.$email.'","'.$wallet.'")');
    echo "<script>alert('Успешно добавлен')</script>";
}else{
    echo "<script>alert('Такой email или кошелок уже существует!')</script>";
}
    echo "<script>window.open('$redirectto','_self')</script>";


?>