<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>STEP 1</title>

<script type="text/javascript" src="jquery-1.4.js"></script>
<link rel="stylesheet" href="lib/jquery.ui.all.css">
<script src="lib/jquery.ui.dialog.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#loader").hide();
  $("#database").change(function(){
		$("#loader").fadeIn(500);
		$("#tabel").fadeOut();
    var database = $("#database").val();
    $.ajax({
        url: "show_tables.php",
        data: "database=" + database,
        success: function(data){
            // jika data sukses diambil dari server, tampilkan di <select id=tabel>
            $("#tabel").html(data);
		        $("#loader").fadeOut(500);
		        $("#tabel").fadeIn(1000);
        }
    });
  });
});

</script>
<script type="text/javascript">
function validasi_input(form){
	var mincar = 1;
	if (form.database.value == "pilih"){
		  alert("Belum ada Database yang dipilih!");
		  return (false);
	}
	if (form.tabel.value == "pilih"){
		  alert("Belum ada Tabel yang dipilih!");
		  return (false);
	}
	if (form.modul.value.length < mincar){
		  alert("Nama Modul Masih Kosong!");
		  form.modul.focus();
		  return (false);
	} 
		
	pola=/^[a-zA-Z0-9\_\-]{1,100}$/;
	if (!pola.test(form.modul.value)){
	alert ('Penulisan Nama Modul Salah!');
	form.modul.focus();
	return false;
	}
	if (form.folder.value.length < mincar){
		  alert("Nama Folder Masih Kosong!");
		  form.folder.focus();
		  return (false);
	} 
		
	pola=/^[a-zA-Z0-9\_\-]{1,100}$/;
	if (!pola.test(form.folder.value)){
	alert ('Penulisan Nama Folder Salah!');
	form.folder.focus();
	return false;
	}
	if (form.utama.value.length < mincar){
		  alert("Nama File Utama Masih Kosong!");
		  form.utama.focus();
		  return (false);
	} 
		
	pola=/^[a-zA-Z0-9\_\-]{1,100}$/;
	if (!pola.test(form.utama.value)){
	alert ('Penulisan Nama File Utama Salah!');
	form.utama.focus();
	return false;
	}
	if (form.aksi.value.length < mincar){
		  alert("Nama File Aksi Masih Kosong!");
		  form.aksi.focus();
		  return (false);
	} 
		
	pola=/^[a-zA-Z0-9\_\-]{1,100}$/;
	if (!pola.test(form.aksi.value)){
	alert ('Penulisan Nama File Aksi Salah!');
	form.aksi.focus();
	return false;
	}
	return (true);
}
</script>
<link rel="stylesheet" type="text/css" href="css/style.css" title="style" />
</head>
<body>
<div id="judul">
<h1>GENERATOR MODUL CMS LOKOMEDIA</h1>
</div>
<div id="step">
<h4>Step 1 &raquo; Settingan Awal</h4><hr noshade size="1" />
</div>
<div class="form_settings">
<form method="post" action="step2.php" onsubmit="return validasi_input(this)">
<table width="503" border="0" cellspacing="0" cellpadding="2" align="center"> 
   <tr>
    <th width="133" align="left" scope="row"></th>
    <td width="362">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="2" align="left" scope="row"></th>
    </tr>
  <tr>
    <th width="133" align="left" scope="row">Pilih Database *</th>
    <td width="362">: 
      <select name="database" id="database">
      <option value="pilih" selected="selected">--Pilih Database--</option>
      <?php
      $connect = include "koneksi.php";

      // tampilkan nama-nama propinsi yang ada di database
      $sql = mysql_query("SHOW DATABASES");
      while($p=mysql_fetch_array($sql)){
         echo "<option value=$p[Database]>$p[Database]</option> \n";
      }
     ?>
    </select></td>
  </tr>
  <tr>
    <th align="left" scope="row">Pilih Tabel *</th>
    <td>: 
      <select name="tabel" id="tabel">
      <option value="pilih" selected="selected">--Pilih Tabel--</option>
    </select></td>
  </tr>
  <tr>
    <th align="left" scope="row">Nama Modul *</th>
    <td>: 
      <input type="text" name="modul" />&nbsp;<em>Ex: user</em></td>
  </tr>
  <tr>
    <th align="left" scope="row">Nama Folder *</th>
    <td>: 
      <input type="text" name="folder" />&nbsp;<em>Ex: mod_user</em></td>
  </tr>
  <tr>
    <th align="left" scope="row">Nama File Utama *</th>
    <td>: 
      <input type="text" name="utama" />&nbsp;<em>Ex: user</em></td>
  </tr>
  <tr> 
    <th align="left" scope="row">Nama File Aksi *</th>
    <td>: 
      <input type="text" name="aksi" />&nbsp;<em>Ex: aksi_user</em></td>
  </tr>
  <tr>
    <th align="left" scope="row">&nbsp;</th>
    <td><button type="submit">Next Step</button></td>
  </tr>
  <tr>
    <th align="left" scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" scope="row"><hr noshade size="1" /></td></tr>
    <tr><td><h4>Versi: Uji Coba</td><td align="right"><h4>By: Almazari, <a href="http://www.dokumenary.wordpress.com" target="_blank">dokumenary.wordpress.com</a></h4></td>
    </tr>
</table>
</form>
</div>
</body>
</html>