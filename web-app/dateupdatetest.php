<?php
$datee=date("Y-m-d");
$sql="select p_code,dep,h_code from opdpatient where d<'$datee' and rev=0";
$t=mysql_query($sql);
echo $t;
while($row=mysql_fetch_assoc($t))
{
$sql="delete from opdpatient where p_code=".$row["p_code"]." and d>'$datee'";
$k=mysql_query($sql);
echo $k;
$sql="upadate opd set $dep=$dep+1 where H_CODE=".$_SESSION["h_code"];

}
?>