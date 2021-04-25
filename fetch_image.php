<?php

header("content-type:image/jpeg");

$host = 'localhost';
$user = 'root';
$pass = ' ';

mysql_connect($host, $user, $pass);

mysql_select_db('demo');

$name=$_GET['name'];

$select_image="select * from image_table where imagename='$name'";

$var=mysql_query($select_image);

if($row=mysql_fetch_array($var))
{
 $image_name=$row["imagename"];
 $image_content=$row["imagecontent"];
}
echo $image;

?>
Now we want to display the image we make another file display_image.php.

<html>
<body>
		
<form method="GET" action=" " >
 <input type="file" name="your_imagename">
 <input type="submit" name="display_image" value="Display">
</form>

</body>
</html>


<?php

$getname = $_GET[' your_imagename '];

echo "< img src = fetch_image.php?name=".$getname." width=200 height=200 >";

?>