<?php
include("connection.php");
mysql_select_db('manobhav');
function random_password( $length = 6 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

$h_code=array(1000,1100,1200,1300,1400,2000,2100,2200,2300,2400,3000,3100,3200,3300,3400,4000,4100,4200,4300,4400,5000,5100,5200,5300,5400);
$depa=array('GEN','PED','EMER','cardio','ortho');
for($i=0;$i<5;$i++)
{
	for($j=0;$j<25;$j++)
	{
		$pass = random_password(6);
		$sql="insert into priv_doctor(H_CODE,dep,pass) values (".$h_code[$j].",'".$depa[$i]."','$pass')";
		$retval=mysql_query($sql);
		echo $retval;
	}
}
?>
