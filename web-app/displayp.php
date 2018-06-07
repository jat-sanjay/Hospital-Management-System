<html>
<head>


<style>
body {
            background-image: url("black.jpg");
            
         }
</style>
<style type="text/css">
         p.example1{
            border:1px solid;
            border-bottom-color:#009900; /* Green */
            border-top-color:#FF0000;    /* Red */
            border-left-color:#330000;   /* Black */
            border-right-color:#0000CC;  /* Blue */
font-family:georgia,garamond,serif;
font-size:200%;
background-color: #993333;
         }
         
      </style>

</head>
<body style="text-align:center;font-size:200%;color:CC0066; font-family:courier">
<p class="example1">
     SANJEEVANI
      </p>
<?php
include("connection.php");
mysql_select_db('manobhav');
session_start();
$H_CODE=$_SESSION["h_code"];
if($_POST["oipd"]=='ipd')
{
$sql="select p.p_code,p.p_name,p_pincode from ipdpatient i,patientdet p where i.p_code=p.p_code and i.h_code=$H_CODE";
$retval=mysql_query($sql);

if(! $retval )
   {
      echo'could not get data';
   }
echo "<table border=5 CELLPADDING =15 >
  <tr>
    <td >Patient Code</td>
    <td >Patient Name</td>
    <td >Pincode</td>
	<td>Case File</td>
  </tr>";
  

while($row = mysql_fetch_assoc($retval))
{
echo "<tr>";
echo "<td>".$row['p_code']."</td>";
echo "<td>".$row['p_name']."</td>";
echo "<td>".$row['p_pincode']."</td>";
?>
<form action="dispatfile.php" method="post">
<input type="hidden" name="p_code" value=<?php echo $row['p_code']; ?>>
<input type="hidden" name="oipd" value=<?php echo $_POST["oipd"]; ?>>
<td>
<input type="submit" name="past" value="Get Case file"></td>
</tr>

</form>
<?php

}
echo "</table>";
}

else if($_POST["oipd"]=='opd')
{
$sql="select distinct p.p_code,p.p_name,p_pincode from opdpatient i,patientdet p where i.p_code=p.p_code and i.h_code=$H_CODE";
$retval=mysql_query($sql);

if(! $retval )
   {
      echo'could not get data';
   }
echo "<table border=5 CELLPADDING =15 >
  <tr>
    <td >Patient Code</td>
    <td >Patient Name</td>
    <td >Pincode</td>
 <td>Case File</td>
  </tr>";

while($row = mysql_fetch_assoc($retval))
{
echo "<tr>";
echo "<td>".$row['p_code']."</td>";
echo "<td>".$row['p_name']."</td>";
echo "<td>".$row['p_pincode']."</td>";
?>
<form action="dispatfile.php" method="post">
<input type="hidden" name="p_code" value=<?php echo $row['p_code']; ?>>
<input type="hidden" name="oipd" value=<?php echo $_POST["oipd"]; ?>>
<td>
<input type="submit" name="past" value="Get Case file"></td>
</tr>
</form>
<?php

}




echo "</table>";
}
else if($_POST["oipd"]=='rev')
{
	$sql="select H_CODE,dep,avgrv from priv_doctor where H_CODE =(select H_CODE from priv_hospital where H_CODE=$H_CODE)";
	$retval=mysql_query($sql);

if(! $retval )
   {
      echo'could not get data';
   }
echo "<table border=5 CELLPADDING =15 >
  <tr>
    <td >Code</td>
    <td >Department</td>
    <td >AveragePoints</td>
  </tr>";

while($row = mysql_fetch_assoc($retval))
{
echo "<tr>";
echo "<td>".$row['H_CODE']."</td>";
echo "<td>".$row['dep']."</td>";
echo "<td>".$row['avgrv']."</td>";
echo "</tr>";
}
echo "</table>";

	
}
mysql_close($conn);
?>
</body>
</html>