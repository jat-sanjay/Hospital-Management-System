<html>
<title>hospitalassignment</title>

<head>


<style>
body {
            background-image: url("bricks.jpg");
            background-repeat:repeat;
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

$dep=$_POST["mydropdown"];
$pcode=$_POST["p_code"];
$oipd=$_POST["oipd"];

$text=$_POST['text'];
$count=0;


$sql="select p_pincode from patientdet where p_code=$pcode";
$retval2=mysql_query($sql);
$row=mysql_fetch_assoc($retval2);
$ppincode=$row["p_pincode"];
include("dateupdatetest.php");

if($oipd=='ipd')
{

$sql="select p.H_CODE,p.pincode from priv_hospital p,ipd i where p.H_CODE=i.H_CODE AND Sg_code= ".$_SESSION["h_code"]." AND $dep >=1";

 $retval = mysql_query( $sql);


if(! $retval)
{
echo 'could not give data';
}

            
            
while($row = mysql_fetch_assoc($retval))
{
$hcode[$count]=$row['H_CODE'];
$hpincode[$count]=$row['pincode'] ;
$count++;
} 

$min=abs($ppincode-$hpincode[0]);
$minhcode=$hcode[0];

for($i=0;$i<$count;$i++)
{ 
if(abs($ppincode-$hpincode[$i])<=$min)

{$min=abs($ppincode-$hpincode[$i]);

$minhcode=$hcode[$i];}
}


$sql="insert into ipdpatient (p_code,dep,h_code,case_file) values($pcode,'$dep',$minhcode,'$text')";
$retval3=mysql_query($sql);
//echo $retval3;

$sql="update ipd set $dep=$dep-1 where H_CODE=$minhcode";
$retval4=mysql_query($sql);
$sql="select h_name from priv_hospital where H_CODE=$minhcode";
$val=mysql_query($sql);
$row2=mysql_fetch_assoc($val);

echo "The patient has been successfully assigned ".$row2['h_name']." $dep ward. Please proceed to the hospital as soon as possible.";
}

else
{
include("updateopd.php");


$sql="select p.H_CODE,p.pincode,o.d from priv_hospital p,opd o where p.H_CODE=o.H_CODE AND Sg_code= ".$_SESSION["h_code"]." AND $dep >=1 order by H_CODE,d";

 $retval = mysql_query( $sql);


if(! $retval)
{
echo 'could not give data';
}

            
            
while($row = mysql_fetch_assoc($retval))
{
$hcode[$count]=$row['H_CODE'];
$hpincode[$count]=$row['pincode'];
$dat[$count]=$row['d'] ;
//echo "fetching dates".$dat[$count]."<br>";
$count++;
} 



$min=abs($ppincode-$hpincode[0]);
$minhcode=$hcode[0];
$appdate=$dat[0];

for($i=0;$i<$count;$i++)
{ 
if(abs($ppincode-$hpincode[$i])<=$min && $min!=0)

{$min=abs($ppincode-$hpincode[$i]);

$minhcode=$hcode[$i];
$appdate=$dat[$i];
//echo "assigning date".$appdate."<br>";
}
}
$sql="insert into opdpatient (p_code,dep,d,h_code,case_file) values($pcode,'$dep','$appdate',$minhcode,'$text')";
$retval3=mysql_query($sql);
//echo $retval3;

$sql="update opd set $dep=$dep-1 where H_CODE=$minhcode AND d='$appdate'";

$retval4=mysql_query($sql);
$sql="select h_name from priv_hospital where H_CODE=$minhcode";
$val=mysql_query($sql);
$row2=mysql_fetch_assoc($val);

echo "The patient has been successfully assigned an appointment in ".$row2['h_name']." $dep ward on $appdate 5 pm. Please visit the hospital at the appointed date and time.";
}


  mysql_close($conn);
  ?>
  
  <br>
<a href="register_patient.html"  style="color:FFCC33;">Register Patient</a>
<br><br>
<a href="hospitalassignment.html"  style="color:FFCC33;">Assign Hospital</a>
<br><br>
<a href="loginhtml.html" style="color:FFCC33; align-centre">Logout</a>
<img src="cartoon_hospital_eart_a_hb.gif" alt="Mountain View" style="width:504px;height:310px; float:right;"">
</body>
</html>


