<?
require_once('util.php');

$conn = connectDB();

$id = $_REQUEST['id'];

$sql = "SELECT json FROM pp order by modified_dt desc limit 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$i = 0;
foreach($result as $r) {
	echo str_replace('\n','',str_replace('\"', '"', $r[0]));
	$i++;
}


closeDB();
?>
