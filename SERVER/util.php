<?
function autoVer($url,$return = false){
    $path = pathinfo($url);
    $ver = '.'.filemtime($_SERVER['DOCUMENT_ROOT'].$url).'.';
    if($return)
    {
	return $path['dirname'].'/'.str_replace('.', $ver, $path['basename']);
    }
    else
    {
    	echo $path['dirname'].'/'.str_replace('.', $ver, $path['basename']);
    }
}

function NewGuid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}

function getDBInfo($which='dev')
{
	if($which=='dev')
	{
                        $DB = array(
                                "host" => "localhost",
                                "username" => "root",
                                "password" => "apps",
                                "db" => "pp"
			);
	}
	else
	{
			$DB = array(
                                "host" => "",
                                "username" => "",
                                "password" => "",
                                "db" => ";"
                        );
	}
        return $DB;
}

function connectDB()
{
        $DB = getDBInfo();
        //mysql_connect($DB['host'],$DB['username'],$DB['password']) or die(mysql_error());
	//mysql_select_db($DB['db']) or die (mysql_error());

	$conn = new PDO("mysql:host=".$DB['host'].";dbname=".$DB['db'], $DB['username'], $DB['password']);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	return $conn;
}

function closeDB()
{
        @mysql_close();
}
?>
