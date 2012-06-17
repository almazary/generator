<title>STEP 3</title>
<script type="text/javascript" src="jquery-1.4.js"></script>
<script type="text/javascript">
function aksi_field(no){
	if ($("#dengan_sql"+no).val() == "Dengan SQL"){	
		$("#value_default"+no).val("");
		$("#tanpa_db"+no).hide("slow");
		$("#dengan_sql"+no).val("Tanpa SQL");
		$("#tampil_sql"+no).show("slow");
		$("#tampil_field"+no).show("slow");
		$("#dengan_method"+no).hide("normal");
		document.getElementById('tampil_sql'+no).innerHTML = "SQL* : <br><textarea id='sql_field"+ no +"' name='sql_field"+ no +"' cols='40' rows='4'>SELECT * FROM </textarea>";
		$(document).ready(function(){
		  $("#sql_field"+no).change(function(){
			var sql = $("#sql_field"+no).val();
			var db = $("#database_field").val();
			$.ajax({
				type: "POST",
				url: "field_database.php",
				data: "sql=" + sql + "&no=" + no + "&db=" + db,
				success: function(data){
					// jika data sukses diambil dari server, tampilkan di <select id=tabel>
					$("#tampil_field"+no).html(data);
				}
			});
		  });
		});
	}
	else{
		$("#tanpa_db"+no).show("slow");
		$("#tampil_sql"+no).hide("slow");
		document.getElementById('tampil_field'+no).innerHTML = "";
		$("#dengan_sql"+no).val("Dengan SQL");
		$("#dengan_method"+no).show("normal");
		}
}

function aksi_method_field(no){
	if ($("#dengan_method"+no).val() == "Method Lain"){
		$("#value_default"+no).val("");
		$("#dengan_sql"+no).hide("slow");
		$("#tanpa_db"+no).hide("slow");
		$("#tmpil_sql"+no).hide("slow");
		$("#tampil_method"+no).show("slow");
		$("#dengan_method"+no).val("Tanpa Method Lain");
		document.getElementById('tampil_method'+no).innerHTML = "Isi Method* : <br><textarea name='isi_method_field"+no+"' cols='40' rows='4'></textarea><br>Value* : <br><input type=text size='30' name='value_method_field"+no+"'>";
	}
	else{
		$("#dengan_sql"+no).show("slow");
		$("#dengan_method"+no).val("Method Lain");
		$("#tampil_method"+no).hide("slow");
		$("#tanpa_db"+no).show("slow");
		$("#tmpil_sql"+no).hide("slow");
		document.getElementById('value_method_field'+no).innerHTML = "";
		}
}

function aksi_radiodb(no){
	$(document).ready(function(){
		  $("#sql_radiodb"+no).change(function(){
			var sql = $("#sql_radiodb"+no).val();
			var db = $("#database_radio").val();
			$.ajax({
				type: "POST",
				url: "radiodb_database.php",
				data: "sql=" + sql + "&no=" + no + "&db=" + db,
				success: function(data){
					// jika data sukses diambil dari server, tampilkan di <select id=tabel>
					$("#tampil_hasil_radiodb"+no).html(data);
				}
			});
		  });
		});
}
</script>
<script language="Javascript">
<!--
function OnButton1()
{
    document.form1.action = "step4.php"
    document.form1.target = "_blank";    // Open in a new window

    document.form1.submit();             // Submit the page

    return true;
}

function OnButton2()
{
    document.form1.action = "step4b.php"
    document.form1.target = "_blank";    // Open in a new window

    document.form1.submit();             // Submit the page

    return true;
}

function OnButton3()
{
    document.form1.action = "file_thumb.php"
    document.form1.target = "_blank";    // Open in a new window

    document.form1.submit();             // Submit the page

    return true;
}

-->
</script>
<link rel="stylesheet" href="jquery.treeview.css" />


<script src="jquery-1.4.js" type="text/javascript"></script>
<script src="lib/jquery.cookie.js" type="text/javascript"></script>
<script src="lib/jquery.treeview.js" type="text/javascript"></script>

<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
		
</script>
<link rel="stylesheet" type="text/css" href="css/style_step3.css" title="style" />
</head>
<body>
<div id="judul">
<h1>GENERATOR MODUL CMS LOKOMEDIA</h1>
</div>
<div id="step">
<h4>Step 3 &raquo; Rancangan Form</h4><hr noshade size="1" />
</div>
<div class="form_settings">
<?php
$db = $_POST['database'];
include "koneksi.php";
mysql_select_db($db)or die("Database Tidak di temukan");
?>

<div id="tabel1">
<?php

echo "<form name='form1' method='POST'>";
echo "<table border='1'>
	  <tr><td colspan=4>RANCANGAN FORM TABEL $_POST[tabel] DATABASE $_POST[database]</td></tr>
	  <tr><th>LABEL</th><th>SIZE</th><th width='350px'>VALUE</th><th>VALIDATION</th></tr>";
$no=1;
$file = 0;
foreach($_POST['type_form'] as $key => $value){
	if ($value=='text_field'){
		echo "<tr><td colspan=4>Type: Text Field</td></tr>";
		echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
				  <td>Size <input type=text name='size$no' value='20' size='5'></td>
				  <td><div id='tanpa_db$no'>Value : <input type=text id='value_default$no' name='value$no' size='30'></div>
				      <input type=button class='btn' value='Dengan SQL' id='dengan_sql$no' onclick='javascript:aksi_field($no)'><input class='btn' type=button value='Method Lain' id='dengan_method$no' onclick='javascript:aksi_method_field($no)'><br>
					  <div id='tampil_sql$no'></div>
					  <div id='tampil_field$no'></div>
					  <div id='tampil_method$no'></div>
				      <input type=hidden id='database_field' value='$_POST[database]'>
					  <input type=checkbox name=disable$no value='ya'>Disabled
				  </td>
				  <td valign=top>
				  <table>
				  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>
				  <tr><td>Email</td><td>: <input type=radio name='v_type$no' id='v_type$no' value='email'>Ya</td></tr>
				  <tr><td>Hanya Angka</td><td>: <input type=radio name='v_type$no' id='v_type$no' value='angka'>Ya</td></tr>
				  <tr><td>Huruf & Angka</td><td>: <input type=radio name='v_type$no' id='v_type$no' value='hurufangka'>Ya</td></tr>				  
				  </table>
				  </td>
				  </tr>";
		echo "<input type=hidden name='type$no' value='text_field'>";
		echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";		
		}
		elseif ($value=='textarea'){
			echo "<tr><td colspan=4>Type: Textarea</td></tr>";
			echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				 
				  <td valign='top'><table border=0><tr><td>Cols </td><td><input type=text name='textarea_cols$no' value='40' size='5'></td></tr>
				  				   <td>Rows </td><td><input type=text name='textarea_rows$no' value='5' size='5'></td></tr></table></td>
				  <td valign='top'><div id='tanpa_db$no'>Value : <input type=text id='value_default$no' name='value$no' size=30></div>
								  <input type=button class='btn' value='Dengan SQL' id='dengan_sql$no' onclick='javascript:aksi_field($no)'><input type=button class='btn' value='Method Lain' id='dengan_method$no' onclick='javascript:aksi_method_field($no)'><br>
								  <div id='tampil_sql$no'></div>
								  <div id='tampil_field$no'></div>
								  <div id='tampil_method$no'></div>
								  <input type=hidden id='database_field' value='$_POST[database]'>
								  <input type=checkbox name=disable$no value='ya'>Disabled</td>
				  <td>
				  <table>
				  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
				  </table>
				  </td>
				  </tr>
				  <input type=hidden name='type$no' value='textarea'>
		          <input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";
				  
			}
			elseif ($value=='password'){
				echo "<tr><td colspan=4>Type: Password</td></tr>";
				echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
				  	  <td>Size <input type=text name='size$no' value='20' size='5'></td>
				      <td><div id='tanpa_db$no'>Value : <input type=text id='value_default$no' name='value$no' size=30></div>
						  <input type=button class='btn' value='Dengan SQL' id='dengan_sql$no' onclick='javascript:aksi_field($no)'><input class='btn' type=button value='Method Lain' id='dengan_method$no' onclick='javascript:aksi_method_field($no)'><br>
						  <div id='tampil_sql$no'></div>
						  <div id='tampil_field$no'></div>
						  <div id='tampil_method$no'></div>
						  <input type=hidden id='database_field' value='$_POST[database]'>
						  <input type=checkbox name=disable$no value='ya'>Disabled
					  </td>
					  <td valign=top>
					  <table>
					  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>
					  <tr><td>Email</td><td>: <input type=radio name='v_type$no' value='email'>Ya</td></tr>
					  <tr><td>Hanya Angka</td><td>: <input type=radio name='v_type$no' value='angka'>Ya</td></tr>
					  <tr><td>Huruf & Angka</td><td>: <input type=radio name='v_type$no' value='hurufangka'>Ya</td></tr>
					  </table>
					  </td>
				      </tr>";
				echo "<input type=hidden name='type$no' value='password'>";
				echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";		
				}
				elseif ($value=='radio'.$no){
					echo "<tr><td colspan=4>Type: Radio Button</td></tr>";
					echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
				  	      <td></td>
				          <td>";
						  for ($r=1; $r<=$_POST['radio'.$no]; $r++){
							  echo "<p>Label ".$r."* : <input type=text name='label".$r."radio".$no."'></p>";
							  echo "<p>Value ".$r."* : <input type=text name='value".$r."radio".$no."'></p>";
							  }
						  echo"</td>
						  <td>
						  <table>
						  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
						  </table>
						  </td>
				          </tr>";
				    echo "<input type=hidden name='jumlahradio".$no."' value='".$_POST['radio'.$no]."'>";
					echo "<input type=hidden name='type$no' value='radio'>";
					echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
					}
					elseif ($value=='checkbox'.$no){
						  echo "<tr><td colspan=4>Type: Checkbox</td></tr>";
						  echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
				  	      <td></td>
				          <td>";
						  for ($r=1; $r<=$_POST['checkbox'.$no]; $r++){
							  echo "<p>Label ".$r."* : <input type=text name='label".$r."checkbox".$no."'></p>";
							  echo "<p>Value ".$r."* : <input type=text name='value".$r."checkbox".$no."'></p>";
							  }
						  echo"</td>
						  <td>
						  <table>
						  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
						  </table>
						  </td>
				          </tr>";
						  echo "<input type=hidden name='jumlahcheckbox".$no."' value='".$_POST['checkbox'.$no]."'>";
						  echo "<input type=hidden name='type$no' value='checkbox'>";
					      echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";
						  echo "<input type=hidden name='ada_checkbox' value='1'>";
						}
						elseif ($value=='radiodb'.$no){							   
							    echo "<tr><td colspan=4>Type: Radio Button Database</td></tr>";
								echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
									  <td></td>
									  <td>SQL* : <br><textarea name='sql_radiodb$no' id='sql_radiodb$no' cols=40 rows=4 onclick='aksi_radiodb($no)'>SELECT * FROM </textarea>
									  <div id='tampil_hasil_radiodb$no'></div>
									  </td>
									  <td>
									  <table>
									  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
									  </table>
									  </td>
									  </tr>";								
								echo "<input type=hidden id='database_radio' value='$_POST[database]'>
								      <input type=hidden name='type$no' value='radiodb'>";
								echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
								}
								elseif ($value=='checkboxdb'.$no){
									echo "<tr><td colspan=4>Type: Checkbox Database</td></tr>";
									echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
										  <td></td>
										  <td>SQL* : <br><textarea name='sql_radiodb$no' id='sql_radiodb$no' cols=40 rows=4 onclick='aksi_radiodb($no)'>SELECT * FROM </textarea>
										  <div id='tampil_hasil_radiodb$no'></div>
										  </td>
										  <td>
										  <table>
										  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
										  </table>
										  </td>
										  </tr>";								
									echo "<input type=hidden id='database_radio' value='$_POST[database]'>
								          <input type=hidden name='type$no' value='checkboxdb'>";
								    echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
									echo "<input type=hidden name='ada_checkbox' value='1'>";
									}
									elseif ($value=='combobox'.$no){
										echo "<tr><td colspan=4>Type: Combobox</td></tr>";
										echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
				  	      						<td></td>
				          						<td>";
						  						for ($r=1; $r<=$_POST['combobox'.$no]; $r++){
							  						echo "<p>Label ".$r."* : <input type=text name='label".$r."combobox".$no."'></p>";
							  						echo "<p>Value ".$r."* : <input type=text name='value".$r."combobox".$no."'></p>";
							  					}
						  						echo"</td>
												<td>
												<table>
												<tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
												</table>
												</td>
				          						</tr>";
				   						echo "<input type=hidden name='jumlahcombobox".$no."' value='".$_POST['combobox'.$no]."'>";
										echo "<input type=hidden name='type$no' value='combobox'>";
										echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
										}
										elseif ($value=='comboboxdb'.$no){
												echo "<tr><td colspan=4>Type: Combobox Database</td></tr>";
												echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
													  <td></td>
													  <td>SQL* : <br><textarea name='sql_radiodb$no' id='sql_radiodb$no' cols=40 rows=4 onclick='aksi_radiodb($no)'>SELECT * FROM </textarea>
													  <div id='tampil_hasil_radiodb$no'></div>
													  </td>
													  <td>
													  <table>
													  <tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
													  </table>
													  </td>
													  </tr>";								
												echo "<input type=hidden id='database_radio' value='$_POST[database]'>
								          				<input type=hidden name='type$no' value='comboboxdb'>";
								    			echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
											}
											elseif ($value=='file'.$no){
												$file++;
												echo "<tr><td colspan=4>Type: File</td></tr>";
												echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
				  										<td>Size <input type=text name='size$no' value='20' size='5'></td>
				  										<td>";
															if ($_POST['type_file'.$no]=='gambar'){
														    echo "<table>
														    <tr><td valign=top>Nama Folder Penyimpanan*</td><td><input type=text name='folder_simpan_file$no'><br><em>Pada root Project</em></td></tr>
														    <tr><td valign=top>Maksimal Ukuran*</td><td><input type=text name='maksimal_ukuran$no' value='3000000'><br><em>Dalam byte</em></td></tr>
														    <tr><td valign=top>Tipe Gambar*</td><td><input type=text name='tipe_file_diijinkan$no' value='&quot;jpg&quot;,&quot;jpeg&quot;,&quot;png&quot;'><br><em>Pisah dengan koma(,)</em></td></tr>
															<tr><td valign=top>Nama Gambar*</td><td><input type=text name='nama_gambar$no' value='default.png'><br><em>Jika Upload Kosong</em></td></tr>
															<tr><td>Resize Width 1*</td><td>Small <input type=text name='resize_width1$no' value='100' size=6> <em>Pixels</em></td></tr>
															<tr><td>Resize Width 2*</td><td>Medium <input type=text name='resize_width2$no' value='360' size=6> <em>Pixels</em></td></tr>
															</table>";
															}else{
																echo "<table>
																<tr><td valign=top>Nama Folder Penyimpanan*</td><td><input type=text name='folder_simpan_file$no'><br><em>Pada root Project</em></td></tr>	
																<tr><td valign=top>Maksimal Ukuran*</td><td><input type=text name='maksimal_ukuran$no' value='3000000'><br><em>Dalam byte</em></td></tr>
																<tr><td valign=top>Tipe File*</td><td><input type=text name='tipe_file_diijinkan$no' value='&quot;pdf&quot;,&quot;text&quot;,&quot;rar&quot;,&quot;doc&quot;,&quot;docx&quot;'><br><em>Pisah dengan koma(,)</em></td></tr>																
																</table>";
																}
														echo "</td>
														<td>
														<table>
														<tr><td>Kosong</td><td>: <input type=checkbox name='v_kosong$no' value='ya'>Ya</td></tr>				  
														</table>
														</td>
				  										</tr>";		
														if ($file == 1){
															echo "<input type=hidden name='nomor_file' value='$no'>";
														}
														elseif ($file == 2){
															echo "<input type=hidden name='nomor_file2' value='$no'>";
														}												
												echo "<input type=hidden name='type_file$no' value=".$_POST['type_file'.$no].">";												
												echo "<input type=hidden name='jum_file' value='$file'>";
												echo "<input type=hidden name='type$no' value='file'>";
												echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
												}
												elseif ($value=='hidden'){
													echo "<tr><td colspan=4>Type: Hidden</td></tr>";
													echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
															  <td>Size <input type=text name='size$no' value='20' size='5' disabled></td>
															  <td><div id='tanpa_db$no'>Value : <input type=text id='value_default$no' name='value$no' size=30></div>
																  <input type=button class='btn' value='Dengan SQL' id='dengan_sql$no' onclick='javascript:aksi_field($no)'><input type=button class='btn' value='Method Lain' id='dengan_method$no' onclick='javascript:aksi_method_field($no)'><br>
																  <div id='tampil_sql$no'></div>
																  <div id='tampil_field$no'></div>
																  <div id='tampil_method$no'></div>
																  <input type=hidden id='database_field' value='$_POST[database]'>																  
																  </td>
															   <td></td>
															  </tr>";
													echo "<input type=hidden name='type$no' value='hidden'>";
													echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
													}
													elseif ($value=='tgl_lengkap'){
														echo "<tr><td colspan=4>Type: Date (Tanggal-Bulan-Tahun)</td></tr>";
														echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
																  <td></td>
																  <td>Tahun Mulai* : <input type=text name='thn_mulai$no' size=5>															  
																	  </td>
																  <td></td>
																  </tr>";
														echo "<input type=hidden name='type$no' value='tgl_lengkap'>";
														echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
														}
														elseif ($value=='tgl'){
															echo "<tr><td colspan=4>Type: Date(Tanggal)</td></tr>";
															echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
																  <td></td>
																  <td>														  
																	  </td>
																  <td></td>
																  </tr>";
															echo "<input type=hidden name='type$no' value='tgl'>";
															echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
															}
															elseif ($value=='bln'){
														    echo "<tr><td colspan=4>Type: Date (Bulan)</td></tr>";
															echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
																  <td></td>
																  <td>														  
																	  </td>
																  <td></td>
																  </tr>";
															echo "<input type=hidden name='type$no' value='bln'>";
															echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
															}
															elseif ($value=='thn'){
															echo "<tr><td colspan=4>Type: Date (Tahun)</td></tr>";
															echo "<tr><td><input type=text name='label$no' value=".$_POST['label'.$no]."></td>				  
																  <td></td>
																  <td>Tahun Mulai* : <input type=text name='thn_mulai$no' size=5>														  
																	  </td>
																  <td></td>
																  </tr>";
															echo "<input type=hidden name='type$no' value='thn'>";
															echo "<input type=hidden name='label_value$no' value=".$_POST['label'.$no].">";	
															}
	$no++;
	}
	$jml = $no -1;
echo "
	  <input type=hidden name='jml' value='$jml'>
	  <tr><td colspan=4>"; ?><button type='submit' onClick="OnButton1();"><img src="images/file_php.png" width="50" height="50" /><br />File Utama</button> | 
	               <button type='submit' onClick="OnButton2();"><img src="images/file_php2.png" width="50" height="50" /><br />File Aksi</button><?php 
				   if ($_POST['ada_file']==1){
				   ?>
                   | <button type='submit' onClick="OnButton3();"><img src="images/file_php2.png" width="50" height="50" /><br />Library Upload</button>
                   <?php
				   }
      echo"</td></tr>
	  </table>
	  <input type=hidden name='database' value='$_POST[database]'>
	  <input type=hidden name='tabel' value='$_POST[tabel]'>
	  <input type=hidden name='modul' value='$_POST[modul]'>
	  <input type=hidden name='folder' value='$_POST[folder]'>
	  <input type=hidden name='file_utama' value='$_POST[file_utama]'>
      <input type=hidden name='file_aksi' value='$_POST[file_aksi]'>	  
	  </div>";
	  
echo "<div id='tabel2'>
	 <table align='center'>
	  <tr><th>TABEL $db</th></tr>
	  <tr><td valign=top>";
	  echo "<div id='sidetree'>
	        <div class='treeheader'></div>
			<div id='sidetreecontrol'><a href='#'><strong>Collapse All</strong></a> | <a href='#'><strong>Expand All</strong></a></div>
	        <ul id='tree'>";
	  $show_tables = mysql_query("SHOW TABLES FROM $db");
	  while ($r_tables = mysql_fetch_array($show_tables)){
		  $tabel = $r_tables['Tables_in_'.$db];
		  echo "<li><a href='#'>$tabel</a>
	            <ul>";
				$show_field = mysql_query("SHOW FIELDS FROM $tabel");
				while($r_field = mysql_fetch_array($show_field)){
					echo "<li><a href='#'>$r_field[Field]</a></li>";
			    }
				echo "</ul>
				</li>";
	  }
	  echo "</ul>
	        </div>			
			</div>";
	  echo "</td></tr>
	  </table>
	  </div>";
echo"</form>";

?>
