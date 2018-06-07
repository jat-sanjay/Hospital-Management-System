<html>
<head>


<style>
body {
            background-image: url("bricks.jpg");
            background-repeat:repeat;
         }
         
      </style>

</head>
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
<body style="text-align:center;font-size:200%;color:FF66CC; font-family:courier">
<p class="example1">
     SANJEEVANI
      </p>
<?php
include("connection.php");

function random_password( $length = 6 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
$pass = random_password(6);

               $pat_name = $_POST['name'];
               $pat_address = $_POST['address'];
            
            
            $pat_pincode = $_POST['pincode'];
mysql_select_db('manobhav');
$sql="insert into patientdet (p_name,p_address,p_pincode,p_pass) values ('$pat_name','$pat_address',$pat_pincode,'$pass')";

            $retval = mysql_query( $sql);
//echo"$retval";

if(! $retval)
{
echo 'could not give data';
}
$sql="select p_code from patientdet where p_pass='$pass'";
$retval2=mysql_query($sql);
$row2=mysql_fetch_assoc($retval2);
$id=$row2['p_code'];
echo"Patient succesfully registered in the system<br> The id is $id and the password is<br> $pass<br>";

 mysql_close($conn);
?>
<a href="hospitalassignment.html" style="color:CCFF33;">Assign Hospital</a><br>
<a href="loginhtml.html" style ="color:CCFF33;">Goto Login Page</a><br>

<img src="heart.gif" alt="Mountain View" style="width:504px;height:310px; float:right;"">
</body></html>


