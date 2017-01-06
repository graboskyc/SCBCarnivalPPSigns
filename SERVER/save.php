<?php
require_once('util.php');

$conn = connectDB();

$json = mysql_escape_string($_POST['json']);

$sql = "INSERT into pp (json, modified_dt) VALUES (?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $json);
echo $sql;
$stmt->execute();

closeDB();
?>
