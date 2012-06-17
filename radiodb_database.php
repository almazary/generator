<?php
include "koneksi.php";
mysql_select_db($_POST['db']);

$result = mysql_query($_POST['sql']); 
$no = $_POST['no'];
if ($result){
	$cek = mysql_num_rows($result);
	if ($cek != 0){
		  echo "Field Value* : <select name='field_value_$no'>";
		  $i = 0; 
		  while($i < mysql_num_fields($result)) 
		  { 
			$meta=mysql_fetch_field($result,$i); 
			echo "<option value='$meta->name'>$meta->name</option>";
			$i++; 
		  } 
		  echo "</select><br>";
		  echo "Field Label* : <select name='field_label_$no'>";
		  $j = 0; 
		  while($j < mysql_num_fields($result)) 
		  { 
			$meta=mysql_fetch_field($result,$j); 
			echo "<option value='$meta->name'>$meta->name</option>";
			$j++; 
		  } 
		  echo "</select>";
		}
		else{
			echo "Field Value* : <select name='field_value_$no'>";
			$i = 0; 
			while($i < mysql_num_fields($result)) 
			{ 
			  $meta=mysql_fetch_field($result,$i); 
			  echo "<option value='$meta->name'>$meta->name</option>";
			  $i++; 
			} 
			echo "</select><br>";
			echo "Field Label* : <select name='field_label_$no'>";
			$j = 0; 
			while($j < mysql_num_fields($result)) 
			{ 
			  $meta=mysql_fetch_field($result,$j); 
			  echo "<option value='$meta->name'>$meta->name</option>";
			  $j++; 
			} 
			echo "</select><br>";
			echo "Informasi : Data Kosong";
			}
}
else{
	echo "Perintah Tidak Benar";
	}
?>