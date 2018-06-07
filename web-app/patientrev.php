<html>
<title>pastappointments</title>
<head>


<style>
body {
            background-image: url("black.jpg");
            background -repeat:repeat;
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
	  <style type="text/css">
         h1 {
            -moz-animation-duration: 3s;
            -webkit-animation-duration: 3s;
            -moz-animation-name: slidein;
            -webkit-animation-name: slidein;
         }
         @-moz-keyframes slidein {
            from {
               margin-left:100%;
               width:300%
            }
            to {
               margin-left:0%;
               width:100%;
            }
         }
         @-webkit-keyframes slidein {
            from {
               margin-left:100%;
               width:300%
            }
            to {
               margin-left:0%;
               width:100%;
            }
         }
h2 {
            -moz-animation-duration: 3s;
            -webkit-animation-duration: 3s;
            -moz-animation-name: slidein;
            -webkit-animation-name: slidein;
         }
@-moz-keyframes slidein {
            from {
               margin-right:100%;
               width:300%
            }
            to {
               margin-right:0%;
               width:100%;
            }
         }
         @-webkit-keyframes slidein {
            from {
               margin-right:100%;
               width:300%
            }
            to {
               margin-right:0%;
               width:100%;
            }
         }
      </style>

</head>
<body style="text-align:center;font-size:200%;color:CC0066; font-family:courier">
<h1 >SANJEEVANI</h1>
<h2 > HOPE YOU HAD A GREAT EXPERIENCE </h2>

<?php
include("connection.php");
session_start();
$datee=date("Y-m-d");
mysql_select_db('manobhav');

$rev=$_POST["rev"];
$sql="update opdpatient set rev=$rev where d='$datee' and p_code=".$_SESSION["p_code"];
$retval = mysql_query( $sql);
//echo $retval;
$sql="select count(*) as count ,H_CODE,dep from opdpatient where p_code=".$_SESSION["p_code"]." and rev!='NULL'";
$retval1 = mysql_query( $sql);
//echo $retval1;
$row=mysql_fetch_assoc($retval1);
$count=$row["count"];
$sql="update priv_doctor set avgrv=((avgrv*($count-1)+$rev)/$count) where H_CODE=".$row["H_CODE"]." and dep='".$row["dep"]."'";
$retval2 = mysql_query( $sql);
//echo $retval2;
echo "Conratulations, You have succesfully reviewed today's appointment.";
  mysql_close($conn);?>

</body>
</html>
