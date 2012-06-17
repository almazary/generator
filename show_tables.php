<?php
include "koneksi.php";

$database = $_GET['database'];
$tabel = mysql_query("SHOW TABLES FROM $database");
echo "<option value='pilih' selected='selected'>--Pilih Tabel--</option>";
while($t = mysql_fetch_array($tabel)){
    echo "<option value='".$t['Tables_in_'.$database]."'>".$t['Tables_in_'.$database]."</option> \n";
}
?>
