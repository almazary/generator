<title>STEP 2</title>
<?php
$db = $_POST['database'];
$table = $_POST['tabel'];

include "koneksi.php";
mysql_select_db($db)or die("Database Tidak di temukan");
?>
<script language="JavaScript" type="text/JavaScript">
  function aksiform(form,nomor)
  {
	var type_form = form.value;
	if (type_form=='radio'+nomor){
		    document.getElementById('checkbox'+nomor).innerHTML = "";
			document.getElementById('combobox'+nomor).innerHTML = "";
			document.getElementById('file'+nomor).innerHTML = "";
			document.getElementById(type_form).innerHTML = "Jumlah Pilihan Radio : <input type=text name='"+type_form+"' size='3'>";
	}
	else if (type_form=='checkbox'+nomor){	
	        document.getElementById('radio'+nomor).innerHTML = "";
			document.getElementById('combobox'+nomor).innerHTML = "";
			document.getElementById('file'+nomor).innerHTML = "";
			document.getElementById(type_form).innerHTML = "Jumlah Pilihan Checkbox : <input type=text name='"+type_form+"' size='3'>";
	}	
	else if (type_form=='combobox'+nomor){
		    document.getElementById('checkbox'+nomor).innerHTML = "";
			document.getElementById('radio'+nomor).innerHTML = "";
			document.getElementById('file'+nomor).innerHTML = "";
			document.getElementById(type_form).innerHTML = "Jumlah Pilihan Combobox : <input type=text name='"+type_form+"' size='3'>";
	}
	else if (type_form=='file'+nomor){
		    document.getElementById('checkbox'+nomor).innerHTML = "";
			document.getElementById('combobox'+nomor).innerHTML = "";
			document.getElementById('radio'+nomor).innerHTML = "";
			document.getElementById(type_form).innerHTML = "Type : <select name='type_file"+nomor+"'><option value=gambar>Gambar</option><option value=bukan_gambar>File</option></select><input type=hidden name='ada_file' value='1'>"
	}
        else{
            document.getElementById('checkbox'+nomor).innerHTML = "";
	    document.getElementById('combobox'+nomor).innerHTML = "";
	    document.getElementById('file'+nomor).innerHTML = "";
            document.getElementById('radio'+nomor).innerHTML = "";
        }
	
		
  }
  </script>
<link rel="stylesheet" type="text/css" href="css/style_step2.css" title="style" />
</head>
<body>
<div id="judul">
    <h1><font color="white" style="font-family:sans-serif;">GENERATOR MODUL CMS LOKOMEDIA</font></h1>
</div>
<div id="step">
<h4>Step 2 &raquo; Rancang Type Form</h4><hr noshade size="1" />
</div>
<div id="tabel1">
<div class="form_settings">
<?php

echo "<form method='post' action='step3.php'>		
	  <table>
	  <tr>
		<th>Field</th>
		<th>Type</th>
		<th>Null</th>
		<th>Key</th>
		<th>Default</th>
		<th>Extra</th>
		<th>Type Form</th>
	  </tr>";

$field = mysql_query("SHOW FIELDS FROM $table");
$no=1;
while($f=mysql_fetch_array($field)){
	echo "<tr>
			<td>$f[Field]</td>
			<td>$f[Type]</td>
			<td>$f[Null]</td>
			<td>$f[Key]</td>
			<td>$f[Default]</td>
			<td>$f[Extra]</td>
			<td>
			<select name=type_form[".$no."] onChange='javascript:aksiform(this, $no)'>
			<option value='0' selected>Tidak Ada</option>
			<option value='text_field'>Text Field</option>
			<option value='hidden'>Hidden</option>
			<option value='password'>Password</option>
			<option value='textarea'>Textarea</option>
			<option value='radio".$no."'>Radio Button</option>
			<option value='radiodb".$no."'>Radio Button Database</option>
			<option value='checkbox".$no."'>Checkbox</option>
			<option value='checkboxdb".$no."'>Checkbox Database</option>
			<option value='combobox".$no."'>Combobox</option>
			<option value='comboboxdb".$no."'>Combobox Database</option>
			<option value='file".$no."'>File</option>			
			<option value='tgl_lengkap'>Tanggal-Bulan-Tahun</option>			
			<option value='tgl'>Tanggal</option>
			<option value='bln'>Bulan</option>
			<option value='thn'>Tahun</option>
			</select>
			<div id='radio".$no."'>
			</div>			
			<div id='checkbox".$no."'>
			</div>						
			<div id='combobox".$no."'>
			</div>
			<div id='file".$no."'>
			</div>
			</td>
		  </tr>
		  <input type=hidden name='label$no' value=$f[Field]>
		  ";	
	   $no++;
	}
echo "
</table>
<input type=hidden name='database' value='$_POST[database]'>
<input type=hidden name='tabel' value='$_POST[tabel]'>
<input type=hidden name='modul' value='$_POST[modul]'>
<input type=hidden name='folder' value='$_POST[folder]'>
<input type=hidden name='file_utama' value='$_POST[utama]'>
<input type=hidden name='file_aksi' value='$_POST[aksi]'>
<br><button type='submit' class='btn1'>Next Step</button> <input class='btn2' type=button value='Kembali' onclick=\"window.location.href='index.php';\"><br><br>
</form>";
?>
</div>
</div>
</div>
