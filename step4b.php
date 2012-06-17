<link rel="stylesheet" href="lib/codemirror2.css">
<script src="lib/codemirror.js"></script>
<script src="mode/xml/xml.js"></script>
<script src="mode/javascript/javascript.js"></script>
<script src="mode/css/css.js"></script>
<script src="mode/clike/clike.js"></script>
<script src="php.js"></script>
<link rel="stylesheet" href="theme/default.css">
<style type="text/css">.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
<link rel="stylesheet" href="css/docs.css">
<title><?php echo $_POST['file_aksi'].".php"; ?></title>

<?php
$db = $_POST['database'];
include "koneksi.php";
mysql_select_db($db)or die("Database Tidak di temukan");
$tabel = $_POST['tabel'];
$primary = mysql_query("SHOW KEYS FROM $tabel");
$pry = mysql_fetch_array($primary);
?>
<h2>GENERATOR MODUL CMS LOKOMEDIA</h2>

KODE FILE AKSI : (<?php echo $_POST['file_aksi'].".php"; ?>)
<textarea id="code_aksi1" name='kode_aksi'>
&lt;?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo &quot;&lt;link href='style.css' rel='stylesheet' type='text/css'&gt;
  &lt;center&gt;Untuk mengakses modul, Anda harus login &lt;br&gt;&quot;;
  echo &quot;&lt;a href=../../index.php&gt;&lt;b&gt;LOGIN&lt;/b&gt;&lt;/a&gt;&lt;/center&gt;&quot;;
}
else{
  include &quot;../../../config/koneksi.php&quot;;
<?php if ($_POST['jum_file'] > 0){?>
  include &quot;../../../config/fungsi_thumb.php&quot;;<?php }?>

  
  $module=$_GET[module];
  $act=$_GET[act];
  
<?php for ($i=1; $i<=$_POST['jml']; $i++){ 
  if ($_POST['label_value'.$i] != ""){ 
  if ($_POST['type'.$i]=='text_field' OR $_POST['type'.$i]=='hidden' OR $_POST['type'.$i]=='textarea'  OR $_POST['type'.$i]=='textareadb' 
	  OR $_POST['type'.$i]=='radio' OR $_POST['type'.$i]=='radiodb' OR $_POST['type'.$i]=='combobox' OR $_POST['type'.$i]=='comboboxdb'){ ?>
  $<?php echo $_POST['label_value'.$i] ?> = htmlentities($_POST['<?php echo $_POST['label_value'.$i] ?>']);
<?php }
  elseif ($_POST['type'.$i]=='password'){?>
  $<?php echo $_POST['label_value'.$i] ?> = md5($_POST['<?php echo $_POST['label_value'.$i] ?>']);
<?php }
  elseif ($_POST['type'.$i]=='checkbox' OR $_POST['type'.$i]=='checkboxdb'){?>
  
  if (!empty($_POST['<?php echo $_POST['label_value'.$i] ?>'])){
       $p_<?php echo $_POST['label_value'.$i] ?> = $_POST['<?php echo $_POST['label_value'.$i] ?>'];
       $<?php echo $_POST['label_value'.$i] ?>=implode(',',$p_<?php echo $_POST['label_value'.$i] ?>);
  }
<?php } 
  elseif ($_POST['type'.$i]=='tgl_lengkap'){?>
  $<?php echo $_POST['label_value'.$i] ?>=$_POST['thn_<?php echo $_POST['label_value'.$i] ?>'].'-'.$_POST['bln_<?php echo $_POST['label_value'.$i] ?>'].'-'.$_POST['tgl_<?php echo $_POST['label_value'.$i] ?>'];
<?php } 
  elseif ($_POST['type'.$i]=='tgl'){?>
  $<?php echo $_POST['label_value'.$i] ?>=htmlentities($_POST['tgl_<?php echo $_POST['label_value'.$i] ?>']);
<?php } 
  elseif ($_POST['type'.$i]=='bln'){?>
  $<?php echo $_POST['label_value'.$i] ?>=htmlentities($_POST['bln_<?php echo $_POST['label_value'.$i] ?>']);
<?php } 
  elseif ($_POST['type'.$i]=='thn'){?>
  $<?php echo $_POST['label_value'.$i] ?>=htmlentities($_POST['thn_<?php echo $_POST['label_value'.$i] ?>']);
<?php } ?>
<?php } }?>

  // Input <?php echo $_POST['modul'];?>

  if ($module=='<?php echo $_POST['modul'];?>' AND $act=='input'){
  	  <?php if ($_POST['jum_file'] == 0){ ?>
      mysql_query(&quot;INSERT INTO <?php echo $_POST['tabel']; ?>(<?php 
																   $array_type = array("text_field","hidden","textarea",
																				  "radio","radiodb","combobox","comboboxdb",
																				  "checkbox","checkboxdb","password","tgl_lengkap",
																				  "tgl","thn","bln");
																   $no=0;
																   for ($j=1; $j<=$_POST['jml']; $j++){																	   
																		for($k=$j+1; $k<=$_POST['jml']; $k++){
																			if (in_array($_POST['type'.$k],$array_type)){
																				$no++;	 
																			}
																		}
																		if (in_array($_POST['type'.$j],$array_type)){
																			echo $_POST['label_value'.$j];
																			if ($no > 0){?>,
					<?php 
																			}
																		}
																		$no = 0;																		
																   }																   
																   ?>)
                                VALUES(<?php 
										 $array_type = array("text_field","hidden","textarea",
														"radio","radiodb","combobox","comboboxdb",
														"checkbox","checkboxdb","password","tgl_lengkap",
														"tgl","thn","bln");
										 $no=0;
										 for ($j=1; $j<=$_POST['jml']; $j++){																	   
											  for($k=$j+1; $k<=$_POST['jml']; $k++){
												  if (in_array($_POST['type'.$k],$array_type)){
													  $no++;	 
												  }
											  }
											  if (in_array($_POST['type'.$j],$array_type)){
												  ?>'$<?php echo $_POST['label_value'.$j]?>'<?php
												  if ($no > 0){?>,
					<?php
												  
												  }
											  }
											  $no = 0;																		
										 }																   
										 ?>)&quot;);
     header('location:../../media.php?module='.$module);
      <?php }
	  		else{
				for ($i=1; $i<=$_POST['jml']; $i++){ 
					if ($_POST['type'.$i]=="file"){?>                    	
      $nomor_file = <?php echo $i; ?>;
      
      $ukuran_maks_file<?php echo $i ?> = <?php echo $_POST['maksimal_ukuran'.$i]; ?>;
      $lokasi_file<?php echo $i ?> = $_FILES['fupload<?php echo $i ?>']['tmp_name'];
      $nama_file<?php echo $i ?>   = $_FILES['fupload<?php echo $i ?>']['name'];
      $tipe_file<?php echo $i ?>   = $_FILES['fupload<?php echo $i ?>']['type'];
      $ukuran_file<?php echo $i ?> = $_FILES['fupload<?php echo $i ?>']['size'];
      $acak<?php echo $i ?>           = rand(1,999999);
      $nama_file_unik<?php echo $i ?> = $acak<?php echo $i ?>.$nama_file<?php echo $i ?>;
      $extensionList<?php echo $i ?> = array(<?php echo $_POST['tipe_file_diijinkan'.$i]; ?>);
      $pecah<?php echo $i ?> = explode(&quot;.&quot;, $nama_file<?php echo $i ?>);
      $ekstensi<?php echo $i ?> = $pecah<?php echo $i ?>[1];      
                    <?php 
					}
				}?>
      <?php if ($_POST['jum_file'] == 1){ ?>
      				
      if (!empty($lokasi_file<?php echo $_POST['nomor_file']; ?>)){
          if ($ukuran_file<?php echo $_POST['nomor_file']; ?> &gt; $ukuran_maks_file<?php echo $_POST['nomor_file']; ?>){            
            echo &quot;&lt;script&gt;self.history.back()
            alert('Ukuran terlalu bersar')&lt;/script&gt;&quot;;
          }
          if (!in_array($ekstensi<?php echo $_POST['nomor_file']; ?>, $extensionList<?php echo $_POST['nomor_file']; ?>)){           
            echo &quot;&lt;script&gt;self.history.back()
            alert('Tipe gambar tidak di ijinkan')&lt;/script&gt;&quot;;
          }
          else{
            <?php $no_file = $_POST['nomor_file']; ?>       	         
            UploadFile<?php echo $_POST['label_value'.$no_file]?><?php echo $_POST['nomor_file']; ?>($nama_file_unik<?php echo $_POST['nomor_file']; ?>,$ekstensi<?php echo $_POST['nomor_file']; ?>,$nomor_file);
            mysql_query(&quot;INSERT INTO <?php echo $_POST['tabel']; ?>(<?php 
																   $array_type = array("text_field","hidden","textarea",
																				  "radio","radiodb","combobox","comboboxdb",
																				  "checkbox","checkboxdb","password","tgl_lengkap",
																				  "tgl","thn","bln","file");
																   $no=0;
																   for ($j=1; $j<=$_POST['jml']; $j++){																	   
																		for($k=$j+1; $k<=$_POST['jml']; $k++){
																			if (in_array($_POST['type'.$k],$array_type)){
																				$no++;	 
																			}
																		}
																		if (in_array($_POST['type'.$j],$array_type)){
																			echo $_POST['label_value'.$j];
																			if ($no > 0){?>,
					<?php 
																			}
																		}
																		$no = 0;																		
																   }																   
																   ?>)
                                VALUES(<?php 
										 $array_type = array("text_field","hidden","textarea",
														"radio","radiodb","combobox","comboboxdb",
														"checkbox","checkboxdb","password","tgl_lengkap",
														"tgl","thn","bln","file");
										 $no=0;
										 for ($j=1; $j<=$_POST['jml']; $j++){																	   
											  for($k=$j+1; $k<=$_POST['jml']; $k++){
												  if (in_array($_POST['type'.$k],$array_type)){
													  $no++;	 
												  }
											  }
											  if (in_array($_POST['type'.$j],$array_type)){
												  if ($_POST['type'.$j]=="file"){
												  ?>'$nama_file_unik<?php echo $j;?>'<?php } else {
												  ?>'$<?php echo $_POST['label_value'.$j]?>'<?php }
												  if ($no > 0){?>,
					<?php
												  
												  }
											  }
											  $no = 0;																		
										 }																   
										 ?>)&quot;);
            header('location:../../media.php?module='.$module);
          }          
      }
      else{
        mysql_query(&quot;INSERT INTO <?php echo $_POST['tabel']; ?>(<?php 
																   $array_type = array("text_field","hidden","textarea",
																				  "radio","radiodb","combobox","comboboxdb",
																				  "checkbox","checkboxdb","password","tgl_lengkap",
																				  "tgl","thn","bln","file");
																   $no=0;
																   for ($j=1; $j<=$_POST['jml']; $j++){																	   
																		for($k=$j+1; $k<=$_POST['jml']; $k++){
																			if (in_array($_POST['type'.$k],$array_type)){
																				$no++;	 
																			}
																		}
																		if (in_array($_POST['type'.$j],$array_type)){
																			echo $_POST['label_value'.$j];
																			if ($no > 0){?>,
					<?php 
																			}
																		}
																		$no = 0;																		
																   }																   
																   ?>)
                                VALUES(<?php 
										 $array_type = array("text_field","hidden","textarea",
														"radio","radiodb","combobox","comboboxdb",
														"checkbox","checkboxdb","password","tgl_lengkap",
														"tgl","thn","bln","file");
										 $no=0;
										 for ($j=1; $j<=$_POST['jml']; $j++){																	   
											  for($k=$j+1; $k<=$_POST['jml']; $k++){
												  if (in_array($_POST['type'.$k],$array_type)){
													  $no++;	 
												  }
											  }
											  if (in_array($_POST['type'.$j],$array_type)){
												  if ($_POST['type'.$j]=="file"){
												  ?>'<?php echo $_POST['nama_gambar'.$j];?>'<?php } else {
												  ?>'$<?php echo $_POST['label_value'.$j]?>'<?php }
												  if ($no > 0){?>,
					<?php
												  
												  }
											  }
											  $no = 0;																		
										 }																   
										 ?>)&quot;);
        header('location:../../media.php?module='.$module);
     }
          <?php } ?>
     <?php } ?>      
  }
  
  // Update <?php echo $_POST['modul'];?>
  
  elseif ($module=='<?php echo $_POST['modul'];?>' AND $act=='update'){ 
     <?php if ($_POST['jum_file'] == 0){ ?>
     
    mysql_query(&quot;UPDATE <?php echo $_POST['tabel']; ?> SET  <?php 
										 $array_type = array("text_field","hidden","textarea",
														"radio","radiodb","combobox","comboboxdb",
														"checkbox","checkboxdb","password","tgl_lengkap",
														"tgl","thn","bln");
										 $no=0;
										 for ($j=1; $j<=$_POST['jml']; $j++){																	   
											  for($k=$j+1; $k<=$_POST['jml']; $k++){
												  if (in_array($_POST['type'.$k],$array_type)){
													  $no++;	 
												  }
											  }
											  if (in_array($_POST['type'.$j],$array_type)){
												  echo $_POST['label_value'.$j]?> = '$<?php echo $_POST['label_value'.$j]?>'<?php
												  if ($no > 0){?>,
					<?php
												  
												  }
											  }
											  $no = 0;																		
										 }																   
										 ?>
                                         
                          WHERE <?php echo $pry['Column_name'];?> = '$_POST[id]'&quot;);
    
    header('location:../../media.php?module='.$module);
  }
    <?php } 
		  else {
			  for ($i=1; $i<=$_POST['jml']; $i++){ 
					if ($_POST['type'.$i]=="file"){?>
      
      $nomor_file = <?php echo $i; ?>;
                    
      $ukuran_maks_file<?php echo $i ?> = <?php echo $_POST['maksimal_ukuran'.$i]; ?>;
      $lokasi_file<?php echo $i ?> = $_FILES['fupload<?php echo $i ?>']['tmp_name'];
      $nama_file<?php echo $i ?>   = $_FILES['fupload<?php echo $i ?>']['name'];
      $tipe_file<?php echo $i ?>   = $_FILES['fupload<?php echo $i ?>']['type'];
      $ukuran_file<?php echo $i ?> = $_FILES['fupload<?php echo $i ?>']['size'];
      $acak<?php echo $i ?>           = rand(1,999999);
      $nama_file_unik<?php echo $i ?> = $acak<?php echo $i ?>.$nama_file<?php echo $i ?>;
      $extensionList<?php echo $i ?> = array(<?php echo $_POST['tipe_file_diijinkan'.$i]; ?>);
      $pecah<?php echo $i ?> = explode(&quot;.&quot;, $nama_file<?php echo $i ?>);
      $ekstensi<?php echo $i ?> = $pecah<?php echo $i ?>[1]; 
                        <?php
					}
			  }
	  if ($_POST['jum_file'] == 1){ ?>
      				
      if (!empty($lokasi_file<?php echo $_POST['nomor_file']; ?>)){
          if ($ukuran_file<?php echo $_POST['nomor_file']; ?> &gt; $ukuran_maks_file<?php echo $_POST['nomor_file']; ?>){            
            echo &quot;&lt;script&gt;self.history.back()
            alert('Ukuran terlalu bersar')&lt;/script&gt;&quot;;
          }
          if (!in_array($ekstensi<?php echo $_POST['nomor_file']; ?>, $extensionList<?php echo $_POST['nomor_file']; ?>)){           
            echo &quot;&lt;script&gt;self.history.back()
            alert('Tipe gambar tidak di ijinkan')&lt;/script&gt;&quot;;
          }
          else{
            <?php if ($_POST['type_file'.$no_file]=="gambar") {?>
            
            $gambar1 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/$_POST[files<?php echo $_POST['nomor_file']; ?>]&quot;;
            $gambar2 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/medium_$_POST[files<?php echo $_POST['nomor_file']; ?>]&quot;;
            $gambar3 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/small_$_POST[files<?php echo $_POST['nomor_file']; ?>]&quot;;
            if (!empty($_POST['files<?php echo $_POST['nomor_file']; ?>']) AND file_exists($gambar1) AND $_POST['files<?php echo $_POST['nomor_file']; ?>'] != '<?php echo $_POST['nama_gambar'.$no_file]; ?>'){
                unlink($gambar1);
                unlink($gambar2);
                unlink($gambar3); 
            <?php }
			else{?>
$files<?php echo $_POST['nomor_file']; ?> = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/$_POST[files<?php echo $_POST['nomor_file']; ?>]&quot;;           
            if (!empty($_POST['files<?php echo $_POST['nomor_file']; ?>']) AND file_exists($files<?php echo $_POST['nomor_file']; ?>)){
                unlink($files);
            <?php	
		    }
			?>
                <?php $no_file = $_POST['nomor_file']; ?>       	         
                UploadFile<?php echo $_POST['label_value'.$no_file]?><?php echo $_POST['nomor_file']; ?>($nama_file_unik<?php echo $_POST['nomor_file']; ?>,$ekstensi<?php echo $_POST['nomor_file']; ?>,$nomor_file);
                mysql_query(&quot;UPDATE <?php echo $_POST['tabel']; ?> SET <?php 
                                             $array_type = array("text_field","hidden","textarea",
                                                            "radio","radiodb","combobox","comboboxdb",
                                                            "checkbox","checkboxdb","password","tgl_lengkap",
                                                            "tgl","thn","bln","file");
                                             $no=0;
                                             for ($j=1; $j<=$_POST['jml']; $j++){																	   
                                                  for($k=$j+1; $k<=$_POST['jml']; $k++){
                                                      if (in_array($_POST['type'.$k],$array_type)){
                                                          $no++;	 
                                                      }
                                                  }
                                                  if (in_array($_POST['type'.$j],$array_type)){
													  if ($_POST['type'.$j]=="file"){
												      echo $_POST['label_value'.$j]?> = '$nama_file_unik<?php echo $j; ?>'<?php }else {
                                                      echo $_POST['label_value'.$j]?> = '$<?php echo $_POST['label_value'.$j]?>'<?php }
                                                      if ($no > 0){?>,
                                               <?php
                                                      
                                                      }
                                                  }
                                                  $no = 0;																		
                                             }																   
                                             ?>
                                             
                             WHERE <?php echo $pry['Column_name'];?> = '$_POST[id]'&quot;);
             }
             else{
                UploadFile<?php echo $_POST['label_value'.$no_file]?><?php echo $_POST['nomor_file']; ?>($nama_file_unik<?php echo $_POST['nomor_file']; ?>,$ekstensi<?php echo $_POST['nomor_file']; ?>,$nomor_file);
                mysql_query(&quot;UPDATE <?php echo $_POST['tabel']; ?> SET <?php 
                                             $array_type = array("text_field","hidden","textarea",
                                                            "radio","radiodb","combobox","comboboxdb",
                                                            "checkbox","checkboxdb","password","tgl_lengkap",
                                                            "tgl","thn","bln","file");
                                             $no=0;
                                             for ($j=1; $j<=$_POST['jml']; $j++){																	   
                                                  for($k=$j+1; $k<=$_POST['jml']; $k++){
                                                      if (in_array($_POST['type'.$k],$array_type)){
                                                          $no++;	 
                                                      }
                                                  }
                                                  if (in_array($_POST['type'.$j],$array_type)){
													  if ($_POST['type'.$j]=="file"){
												      echo $_POST['label_value'.$j]?> = '$nama_file_unik<?php echo $j; ?>'<?php }else {
                                                      echo $_POST['label_value'.$j]?> = '$<?php echo $_POST['label_value'.$j]?>'<?php }
                                                      if ($no > 0){?>,
                                               <?php
                                                      
                                                      }
                                                  }
                                                  $no = 0;																		
                                             }																   
                                             ?>
                                             
                             WHERE <?php echo $pry['Column_name'];?> = '$_POST[id]'&quot;);
             }
             header('location:../../media.php?module='.$module);
          }          
      }
      else{
        mysql_query(&quot;UPDATE <?php echo $_POST['tabel']; ?> SET <?php 
                                             $array_type = array("text_field","hidden","textarea",
                                                            "radio","radiodb","combobox","comboboxdb",
                                                            "checkbox","checkboxdb","password","tgl_lengkap",
                                                            "tgl","thn","bln","file");
                                             $no=0;
                                             for ($j=1; $j<=$_POST['jml']; $j++){																	   
                                                  for($k=$j+1; $k<=$_POST['jml']; $k++){
                                                      if (in_array($_POST['type'.$k],$array_type)){
                                                          $no++;	 
                                                      }
                                                  }
                                                  if (in_array($_POST['type'.$j],$array_type)){
													  if ($_POST['type'.$j]=="file"){
												      echo $_POST['label_value'.$j]?> = '<?php echo $_POST['nama_gambar'.$j]; ?>'<?php }else {
                                                      echo $_POST['label_value'.$j]?> = '$<?php echo $_POST['label_value'.$j]?>'<?php }
                                                      if ($no > 0){?>,
                                   <?php
                                                      
                                                      }
                                                  }
                                                  $no = 0;																		
                                             }																   
                                             ?>
                                             
                             WHERE <?php echo $pry['Column_name'];?> = '$_POST[id]'&quot;);
        header('location:../../media.php?module='.$module);
     }
<?php } ?>
  }
<?php 
		  }
	  ?>

  // Delete <?php echo $_POST['modul'];?>
  
  elseif ($module=='<?php echo $_POST['modul'];?>' AND $act=='delete'){
      <?php if ($_POST['jum_file'] == 0){ ?>
      
      mysql_query(&quot;DELETE FROM <?php echo $_POST['tabel']; ?> WHERE <?php echo $pry['Column_name'];?> = '$_GET[id]'&quot;);
      header('location:../../media.php?module='.$module);
      <?php }
	  else{ ?>
	  
      $data = mysql_query(&quot;SELECT * FROM <?php echo $_POST['tabel']; ?> WHERE <?php echo $pry['Column_name'];?> = '$_GET[id]'&quot;);
      $r=mysql_fetch_array($data);
      <?php if ($_POST['jum_file'] == 1){ 
	           if ($_POST['type_file'.$no_file]=="gambar"){?>
               
      $gambar1 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/$r[<?php echo $_POST['label_value'.$no_file];?>]&quot;;
      $gambar2 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/medium_$r[<?php echo $_POST['label_value'.$no_file];?>]&quot;;
      $gambar3 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/small_$r[<?php echo $_POST['label_value'.$no_file];?>]&quot;;
      if (file_exists($gambar1) AND $r[<?php echo $_POST['label_value'.$no_file];?>] != '<?php echo $_POST['nama_gambar'.$no_file]; ?>'){
          unlink($gambar1);
          unlink($gambar2);
          unlink($gambar3); 
      }
      mysql_query(&quot;DELETE FROM <?php echo $_POST['tabel']; ?> WHERE <?php echo $pry['Column_name'];?> = '$_GET[id]'&quot;);
      header('location:../../media.php?module='.$module);
      <?php	  
			   }
			   else{?>
$file = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/$r[<?php echo $_POST['label_value'.$no_file];?>]&quot;;      
      if (file_exists($gambar1)){
          unlink($file);
      }
      mysql_query(&quot;DELETE FROM <?php echo $_POST['tabel']; ?> WHERE <?php echo $pry['Column_name'];?> = '$_GET[id]'&quot;);
      header('location:../../media.php?module='.$module);		   
                <?php
			   }
	        }
      }
	  ?>      
  }
  
  <?php if ($_POST['jum_file'] != 0){ ?>
// Delete Files   
  elseif ($module=='<?php echo $_POST['modul'];?>' AND $act=='delete_files'){
      if (!empty($_GET['files<?php echo $no_file;?>'])){
      <?php if ($_POST['jum_file'] == 1){ 
	           if ($_POST['type_file'.$no_file]=="gambar"){?>
               
          $gambar1 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/$_GET[files<?php echo $no_file;?>]&quot;;
          $gambar2 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/medium_$_GET[files<?php echo $no_file;?>]&quot;;
          $gambar3 = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/small_$_GET[files<?php echo $no_file;?>]&quot;;
          if (file_exists($gambar1) AND $_GET['files<?php echo $no_file;?>'] != '<?php echo $_POST['nama_gambar'.$no_file]; ?>'){
              unlink($gambar1);
              unlink($gambar2);
              unlink($gambar3); 
          }
          mysql_query(&quot;UPDATE <?php echo $_POST['tabel']; ?> SET <?php echo $_POST['label_value'.$no_file];?> = '<?php echo $_POST['nama_gambar'.$no_file]; ?>' WHERE <?php echo $pry['Column_name'];?> = '$_GET[id]'&quot;);	
<?php	  
			   }
			   else{?>
    $file = &quot;../../../<?php echo $_POST['folder_simpan_file'.$no_file]; ?>/$_GET[files<?php echo $no_file;?>]&quot;;      
          if (file_exists($gambar1)){
              unlink($file);
          }
          mysql_query(&quot;UPDATE <?php echo $_POST['tabel']; ?> SET <?php echo $_POST['label_value'.$no_file];?> = '' WHERE <?php echo $pry['Column_name'];?> = '$_GET[id]'&quot;);	   
<?php
			   }
	        }
	  ?>
      }  
      header('location:../../media.php?module='.$module);	    
  }
  
<?php } ?>
}
?&gt;
</textarea>

<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code_aksi1"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 8,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift"
      });
    </script>
