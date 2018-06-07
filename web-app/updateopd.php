<?php

$c=0;

$sql="select d from opd where H_CODE=1200";
$r=mysql_query($sql);
while($row=mysql_fetch_assoc($r))
{
$da[$c]=$row['d'];
$c++;
}
$datee=date("Y-m-d");
for($i=0;$i<$c;$i++)
{
if($datee==$da[$i])
{

$sql="update opd set d=DATE_ADD(d,INTERVAL 7 DAY),GEN=DEFAULT,cardio=DEFAULT,PED=DEFAULT,ortho=DEFAULT where d='$da[$i]'";
$t=mysql_query($sql);
echo $t;
}
}
?>