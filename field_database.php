<?php
include "koneksi.php";
mysql_select_db($_POST['db']);

$result = mysql_query($_POST['sql']); 
$no = $_POST['no'];
$i = 0; 
if ($result){
	$cek = mysql_num_rows($result);
	if ($cek != 0){
		  echo "Field Value* : <select name='field_value_textfield$no'>";
		  while($i < mysql_num_fields($result)) 
		  { 
			$meta=mysql_fetch_field($result,$i); 
			echo "<option value='$meta->name'>$meta->name</option>";
			$i++; 
		  } 
		  echo "</select>";
		}
		else{
			echo "Field Value* : <select name='field_value_textfield$no'>";
			while($i < mysql_num_fields($result)) 
			{ 
			  $meta=mysql_fetch_field($result,$i); 
			  echo "<option value='$meta->name'>$meta->name</option>";
			  $i++; 
			} 
			echo "</select><br>";
			echo "Informasi : Data Kosong";
			}
}
else{
	echo "Perintah Tidak Benar";
	}
?>