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
<title><?php echo $_POST['file_utama'].".php"; ?></title>
<?php
$db = $_POST['database'];
include "koneksi.php";
mysql_select_db($db)or die("Database Tidak di temukan");
?>

<h2>GENERATOR MODUL CMS LOKOMEDIA</h2>
<!-- Generate Form Input-->
KODE FILE UTAMA : (<?php echo $_POST['file_utama'].".php"; ?>)<br /> 
<textarea id="file_utama" name='kode_list'>
&lt;script&gt;
function confirmdelete(delUrl) {
   if (confirm(&quot;Anda yakin ingin menghapus?&quot;)) {
      document.location = delUrl;
   }
}
&lt;/script&gt;
&lt;script type=&quot;text/javascript&quot;&gt;
function check_radio(radio){
    for (i = 0; i &lt; radio.length; i++){
      if (radio[i].checked === true){
          return radio[i].value;
      }
    }
    return false;
}
function validasi(form){
   var mincar = 1;
<?php 
   for ($i=1; $i<=$_POST['jml']; $i++){
   		if ($_POST['type'.$i]=='text_field' OR $_POST['type'.$i]=='password'){
			if ($_POST['v_kosong'.$i] != 'ya'){
				?>
   if (form.<?php echo $_POST['label_value'.$i]; ?>.value.length &lt; mincar){
       alert(&quot;<?php echo $_POST['label'.$i]; ?> Masih Kosong!&quot;);
       form.<?php echo $_POST['label_value'.$i]; ?>.focus();
       return (false);
   }
<?php
			}
			if ($_POST['v_type'.$i] == 'email'){
			?>
   pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
   if (!pola_email.test(form.<?php echo $_POST['label_value'.$i]; ?>.value)){
        alert ('Penulisan <?php echo $_POST['label'.$i]; ?> tidak benar');
        form.<?php echo $_POST['label_value'.$i]; ?>.focus();
        return false;
   }
<?php
			}
			if ($_POST['v_type'.$i] == 'angka'){
			?>
   if (form.<?php echo $_POST['label_value'.$i]; ?>.value != &quot;&quot;){
       var x = (form.<?php echo $_POST['label_value'.$i]; ?>.value);
       var status = true;
       var list = new Array(&quot;0&quot;, &quot;1&quot;, &quot;2&quot;, &quot;3&quot;, &quot;4&quot;, &quot;5&quot;, &quot;6&quot;, &quot;7&quot;, &quot;8&quot;, &quot;9&quot;);
       for (i=0; i&lt;=x.length-1; i++)
       {
           if (x[i] in list) cek = true;
           else cek = false;
           status = status &amp;&amp; cek;
       }
       if (status == false)
       {
          alert(&quot;<?php echo $_POST['label'.$i]; ?> harus angka!&quot;);
          form.<?php echo $_POST['label_value'.$i]; ?>.focus();
          return false;
       }
   }         
<?php	
			}
			if ($_POST['v_type'.$i] == 'hurufangka'){
			?>
   pola_<?php echo $_POST['label_value'.$i]; ?>=/^[a-zA-Z0-9\_\-]{1,100}$/;
   if (!pola_<?php echo $_POST['label_value'.$i]; ?>.test(form.<?php echo $_POST['label_value'.$i]; ?>.value)){
       alert ('<?php echo $_POST['label'.$i]; ?> Hanya boleh Huruf dan Angka');
       form.<?php echo $_POST['label_value'.$i]; ?>.focus();
       return false;
   }     
<?php
			}
		}
		if ($_POST['type'.$i]=='textarea'){
			if ($_POST['v_kosong'.$i] != 'ya'){
			?>
   if (form.<?php echo $_POST['label_value'.$i]; ?>.value.length &lt; mincar){
       alert(&quot;<?php echo $_POST['label'.$i]; ?> Masih Kosong!&quot;);
       form.<?php echo $_POST['label_value'.$i]; ?>.focus();
       return (false);
   }         
<?php	
			}
		}
		if ($_POST['type'.$i]=='radio' OR $_POST['type'.$i]=='radiodb'){
			if ($_POST['v_kosong'.$i] != 'ya'){
			?>
   var radio_val<?php echo $i; ?> = check_radio(form.<?php echo $_POST['label_value'.$i]; ?>);
   if (radio_val<?php echo $i; ?> === false){
       alert("Anda belum memilih <?php echo $_POST['label'.$i]; ?>");
       return false;
   }        
<?php
			}
		}
		if ($_POST['type'.$i]=='combobox' OR $_POST['type'.$i]=='comboboxdb'){
			if ($_POST['v_kosong'.$i] != 'ya'){
			?>
   if (form.<?php echo $_POST['label_value'.$i]; ?>.value =="pilih"){
       alert("Anda belum memilih <?php echo $_POST['label'.$i]; ?>");            
       return (false);
   }
<?php	
			}
		}
		if ($_POST['type'.$i]=='file'){
			if ($_POST['v_kosong'.$i] != 'ya'){
			?>
   if (form.<?php echo $_POST['label_value'.$i]; ?>.value == ""){
       alert(&quot;<?php echo $_POST['label'.$i]; ?> Masih Kosong!&quot;);
       form.<?php echo $_POST['label_value'.$i]; ?>.focus();
       return (false);
   }         
<?php
			}
		}
		if ($_POST['type'.$i]=='checkbox' OR $_POST['type'.$i]=='checkboxdb'){
			if ($_POST['v_kosong'.$i] != 'ya'){
			?>
   var chks<?php echo $i; ?> = document.getElementsByName('<?php echo $_POST['label_value'.$i]; ?>[]');
   var hasChecked<?php echo $i; ?> = false;
   for (var i = 0; i < chks<?php echo $i; ?>.length; i++){
	    if (chks<?php echo $i; ?>[i].checked){
            hasChecked<?php echo $i; ?> = true;
            break;
        }
   } 
   if (hasChecked<?php echo $i; ?> == false){
      alert("Anda belum memilih <?php echo $_POST['label'.$i]; ?>");
      return false;
   }       
<?php
			}
		}
   }   
   ?>
   
   return (true);
}
&lt;/script&gt;

&lt;?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo &quot;&lt;link href='style.css' rel='stylesheet' type='text/css'&gt;
    &lt;center&gt;Untuk mengakses modul, Anda harus login &lt;br&gt;&quot;;
    echo &quot;&lt;a href=../../index.php&gt;&lt;b&gt;LOGIN&lt;/b&gt;&lt;/a&gt;&lt;/center&gt;&quot;;
}
else{
<?php 
if ($_POST['ada_checkbox']== 1){
    ?>
function explode_trim($str, $delimiter = ',') {
   if ( is_string($delimiter) ) {
      $str = trim(preg_replace('|\\s*(?:' . preg_quote($delimiter) . ')\\s*|', $delimiter, $str));
      return explode($delimiter, $str);
   }
   return $str;
}
    <?php
    }
?>

$aksi=&quot;modul/<?php echo $_POST['folder']; ?>/<?php echo $_POST['file_aksi']; ?>.php&quot;;
switch($_GET[act]){

default:
echo &quot;&lt;h2&gt;List <?php echo $_POST['modul'];?>&lt;/h2&gt;
&lt;input type=button value='Tambah <?php echo $_POST['modul']; ?>' 
onclick=\&quot;window.location.href='?module=<?php echo $_POST['modul']; ?>&amp;act=tambah<?php echo $_POST['modul']; ?>';\&quot;&gt;
&lt;table&gt;
&lt;tr&gt;&lt;th&gt;No&lt;/th&gt;
<?php
$jml = $_POST['jml'];
for ($i=1; $i<=$jml; $i++){
	  if ($_POST['label'.$i] != ""){
		echo "&lt;th&gt;".$_POST['label'.$i]."&lt;/th&gt;";
				 }
	}
  ?>
&lt;th&gt;Aksi&lt;/th&gt;&lt;/tr&gt;&quot;;

//paging
$batas   = 10;
$halaman = $_GET['halaman'];
if(empty($halaman)){
    $posisi  = 0;
    $halaman = 1;
}
else{
    $posisi = ($halaman-1) * $batas;
    } 
$tampil=mysql_query(&quot;SELECT * FROM <?php echo $_POST['tabel']; ?> LIMIT $posisi,$batas&quot;);
$no=$posisi+1;
while ($r=mysql_fetch_array($tampil)){
  echo &quot;&lt;tr&gt;&lt;td&gt;$no.&lt;/td&gt;
<?php
$tabel = $_POST['tabel'];
$primary = mysql_query("SHOW KEYS FROM $tabel");
$pry = mysql_fetch_array($primary);
$jml = $_POST['jml'];
for ($i=1; $i<=$jml; $i++){
	if ($_POST['label_value'.$i] != ""){
		?>
	&lt;td&gt;$r[<?php echo $_POST['label_value'.$i]; ?>]&lt;/td&gt;
      <?php	
	  }
	}
  ?>
  &lt;td&gt;&lt;a href='?module=<?php echo $_POST['modul'];?>&amp;act=edit<?php echo $_POST['modul'];?>&amp;id=$r[<?php echo $pry['Column_name'];?>]'&gt;Edit&lt;/a&gt; | 
        &lt;a href=javascript:confirmdelete('$aksi?module=<?php echo $_POST['modul'];?>&amp;act=delete&amp;id=$r[<?php echo $pry['Column_name'];?>]')&gt;Hapus&lt;/a&gt;
        &lt;/td&gt;&lt;/tr&gt;&quot;;
  $no++;
}
echo &quot;&lt;/table&gt;&quot;;
$tampil2 = mysql_query(&quot;SELECT * FROM <?php echo $_POST['tabel']; ?>&quot;);
$jmldata = mysql_num_rows($tampil2);
$jmlhal  = ceil($jmldata/$batas);

echo &quot;&lt;div class=paging&gt;&quot;;
// Link ke halaman sebelumnya (previous)
if($halaman &gt; 1){
   $prev=$halaman-1;
   echo &quot;&lt;span class=prevnext&gt;&lt;a href=$_SERVER[PHP_SELF]?module=<?php echo $_POST['modul']; ?>&amp;halaman=$prev&gt;Prev&lt;/a&gt;&lt;/span&gt; &quot;;
}
else{
   echo &quot;&lt;span class=disabled&gt;Prev&lt;/span&gt; &quot;;
}
// Tampilkan link halaman 1,2,3 ...
for($i=1;$i&lt;=$jmlhal;$i++)
if ($i != $halaman){
   echo &quot; &lt;a href=$_SERVER[PHP_SELF]?module=<?php echo $_POST['modul']; ?>&amp;halaman=$i&gt;$i&lt;/a&gt; &quot;;
}
else{
   echo &quot; &lt;span class=current&gt;$i&lt;/span&gt; &quot;;
}
// Link kehalaman berikutnya (Next)
if($halaman &lt; $jmlhal){
  $next=$halaman+1;
  echo &quot;&lt;span class=prevnext&gt;&lt;a href=$_SERVER[PHP_SELF]?module=<?php echo $_POST['modul']; ?>&amp;halaman=$next&gt;Next&lt;/a&gt;&lt;/span&gt;&quot;;
}
else{
  echo &quot;&lt;span class=disabled&gt;Next&lt;/span&gt;&quot;;
}
echo &quot;&lt;/div&gt;&quot;;
break;

// Form Tambah <?php echo $_POST['modul'];?>

case &quot;tambah<?php echo $_POST['modul'];?>&quot;:
echo &quot;&lt;h2&gt;Tambah <?php echo $_POST['modul'];?>&lt;/h2&gt;
&lt;form method=POST action='$aksi?module=<?php echo $_POST['modul'];?>&amp;act=input' <?php if ($_POST['jum_file']>0){?>enctype='multipart/form-data'<?php } ?> onsubmit='return validasi(this)'&gt;
&lt;table&gt;
<?php
for ($i=1; $i<=$_POST['jml']; $i++){
	if ($_POST['type'.$i]=='text_field'){
		if (!empty($_POST['field_value_textfield'.$i]) OR !empty($_POST['isi_method_field'.$i])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$i])){ 
		?>
$sql_field<?php echo $i; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$i]; ?>&quot;);
$r_field<?php echo $i; ?> = mysql_fetch_array($sql_field<?php echo $i; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$i];?>' size='<?php echo $_POST['size'.$i]; ?>' value='$r_field<?php echo $i; ?>[<?php echo $_POST['field_value_textfield'.$i]; ?>]' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$i])){
echo $_POST['isi_method_field'.$i]; 
?>

echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$i];?>' size='<?php echo $_POST['size'.$i]; ?>' value='<?php echo $_POST['value_method_field'.$i]; ?>' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$i]) AND empty($_POST['isi_method_field'.$i])){
				?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$i];?>' size='<?php echo $_POST['size'.$i]; ?>' value='<?php echo $_POST['value'.$i]; ?>' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;                
<?php
				}
		}
		elseif ($_POST['type'.$i]=='textarea'){
			if (!empty($_POST['field_value_textfield'.$i]) OR !empty($_POST['isi_method_field'.$i])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$i])){ 
		?>
$sql_textarea<?php echo $i; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$i]; ?>&quot;);
$r_textarea<?php echo $i; ?> = mysql_fetch_array($sql_textarea<?php echo $i; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$i];?>' cols='<?php echo $_POST['textarea_cols'.$i];?>' rows='<?php echo $_POST['textarea_rows'.$i]; ?>' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;$r_textarea<?php echo $i; ?>['<?php echo $_POST['field_value_textfield'.$i]; ?>']&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$i])){
echo $_POST['isi_method_field'.$i]; 
?>

echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$i];?>' cols='<?php echo $_POST['textarea_cols'.$i];?>' rows='<?php echo $_POST['textarea_rows'.$i]; ?>' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;<?php echo $_POST['value_method_field'.$i]; ?>&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$i]) AND empty($_POST['isi_method_field'.$i])){
				?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$i];?>' cols='<?php echo $_POST['textarea_cols'.$i];?>' rows='<?php echo $_POST['textarea_rows'.$i]; ?>' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;<?php echo $_POST['value'.$i]; ?>&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;                
<?php
				}
			}
		elseif ($_POST['type'.$i]=='password'){
			if (!empty($_POST['field_value_textfield'.$i]) OR !empty($_POST['isi_method_field'.$i])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$i])){ 
		?>
$sql_password<?php echo $i; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$i]; ?>&quot;);
$r_password<?php echo $i; ?> = mysql_fetch_array($sql_password<?php echo $i; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='password' name='<?php echo $_POST['label_value'.$i];?>' size='<?php echo $_POST['size'.$i]; ?>' value='$r_password<?php echo $i; ?>[<?php echo $_POST['field_value_textfield'.$i]; ?>]' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$i])){
echo $_POST['isi_method_field'.$i]; 
?>

echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='password' name='<?php echo $_POST['label_value'.$i];?>' size='<?php echo $_POST['size'.$i]; ?>' value='<?php echo $_POST['value_method_field'.$i]; ?>' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$i]) AND empty($_POST['isi_method_field'.$i])){
				?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='password' name='<?php echo $_POST['label_value'.$i];?>' size='<?php echo $_POST['size'.$i]; ?>' value='<?php echo $_POST['value'.$i]; ?>' <?php if ($_POST['disable'.$i]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;                
<?php
				}
			}
		elseif ($_POST['type'.$i]=='radio'){
			?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: <?php for ($rd=1; $rd<=$_POST['jumlahradio'.$i]; $rd++){ ?> &lt;input type=radio name='<?php echo $_POST['label_value'.$i];?>' value='<?php echo $_POST['value'.$rd.'radio'.$i]; ?>'&gt; <?php echo $_POST['label'.$rd.'radio'.$i]; ?><?php } ?> &lt;/td&gt;&lt;/tr&gt; 
<?php		
			}
		elseif ($_POST['type'.$i]=='checkbox'){
			?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;:	<?php for ($cb=1; $cb<=$_POST['jumlahcheckbox'.$i]; $cb++){ ?> &lt;input type=checkbox value='<?php echo $_POST['value'.$cb.'checkbox'.$i]; ?>' name=<?php echo $_POST['label_value'.$i];?>[]&gt;<?php echo $_POST['label'.$cb.'checkbox'.$i]; ?> <?php } ?> &lt;/td&gt;&lt;/tr&gt;
<?php		
			}
		elseif ($_POST['type'.$i]=='text_fielddb'){
		    ?>
&quot;;
$sql_field<?php echo $i; ?> = mysql_query(&quot;SELECT * FROM <?php echo $_POST['tabel_text_fielddb'.$i]; ?> <?php if (!empty($_POST['whereisi_text_fielddb'.$i])){?>WHERE <?php echo $_POST['where_text_fielddb'.$i]; ?>='<?php echo $_POST['whereisi_text_fielddb'.$i]; ?>'<?php }?>&quot;);
$r_field<?php echo $i; ?> = mysql_fetch_array($sql_field<?php echo $i; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$i];?>' size='<?php echo $_POST['size'.$i]; ?>' value='$r_field<?php echo $i; ?>[<?php echo $_POST['value_text_fielddb'.$i]; ?>]'&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		elseif ($_POST['type'.$i]=='textareadb'){?>
&quot;;
$sql_textarea<?php echo $i; ?> = mysql_query(&quot;SELECT * FROM <?php echo $_POST['tabel_textareadb'.$i]; ?> <?php if (!empty($_POST['whereisi_textareadb'.$i])){?>WHERE <?php echo $_POST['where_textareadb'.$i]; ?>='<?php echo $_POST['whereisi_textareadb'.$i]; ?>'<?php }?>&quot;);
$r_textarea<?php echo $i; ?> = mysql_fetch_array($sql_textarea<?php echo $i; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$i];?>' cols='<?php echo $_POST['textarea_cols'.$i];?>' rows='<?php echo $_POST['textarea_rows'.$i]; ?>'&gt;$r_textarea<?php echo $i;?>[<?php echo $_POST['value_textareadb'.$i];?>]&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;	
<?php
		}
		elseif ($_POST['type'.$i]=='radiodb'){ $ada_relasi=1; if ($_POST['whereisi_radiodb'.$i]!=""){ $ada_where = 1; }?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;:&quot;;
$sql_radio<?php echo $i ?> = mysql_query(&quot;<?php echo $_POST['sql_radiodb'.$i]; ?>&quot;);
while ($r_radio<?php echo $i ?>=mysql_fetch_array($sql_radio<?php echo $i;?>)){
	echo &quot;&lt;input type=radio name='<?php echo $_POST['label_value'.$i];?>' value='$r_radio<?php echo $i;?>[<?php echo $_POST['field_value_'.$i];?>]'&gt;$r_radio<?php echo $i;?>[<?php echo $_POST['field_label_'.$i];?>]&lt;br&gt;&quot;;
}
echo &quot;&lt;/td&gt;&lt;/tr&gt;	
<?php
		}
		elseif ($_POST['type'.$i]=='checkboxdb'){ $ada_relasi=1; if ($_POST['whereisi_checkboxdb'.$i]!=""){ $ada_where = 1; }?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;:&quot;;
$sql_checkbox<?php echo $i ?> = mysql_query(&quot;<?php echo $_POST['sql_radiodb'.$i]; ?>&quot;);
while ($r_checkbox<?php echo $i ?>=mysql_fetch_array($sql_checkbox<?php echo $i;?>)){
	echo &quot;&lt;input type=checkbox name='<?php echo $_POST['label_value'.$i];?>[]' value='$r_checkbox<?php echo $i;?>[<?php echo $_POST['field_value_'.$i];?>]'&gt;$r_checkbox<?php echo $i;?>[<?php echo $_POST['field_label_'.$i];?>]&lt;br&gt;&quot;;
}
echo &quot;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		elseif ($_POST['type'.$i]=='combobox'){ ?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;: &lt;select name='<?php echo $_POST['label_value'.$i];?>'&gt;
                        &lt;option value='pilih' selected&gt;--Pilih--&lt;/option&gt;<?php for ($cb=1; $cb<=$_POST['jumlahcombobox'.$i]; $cb++){ ?> 
                        &lt;option value='<?php echo $_POST['value'.$cb.'combobox'.$i]; ?>'&gt;<?php echo $_POST['label'.$cb.'combobox'.$i]; ?>&lt;/option&gt;<?php } ?> 
                        &lt;/select&gt;
                        &lt;/td&gt;&lt;/tr&gt;
<?php }
	  elseif ($_POST['type'.$i]=='comboboxdb'){$ada_relasi=1; if ($_POST['whereisi_comboboxdb'.$i]!=""){ $ada_where = 1; }?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i]; ?>&lt;/td&gt;&lt;td&gt;:&quot;;
$sql_combobox<?php echo $i ?> = mysql_query(&quot;<?php echo $_POST['sql_radiodb'.$i]; ?>&quot;);
echo &quot;&lt;select name='<?php echo $_POST['label_value'.$i];?>'&gt;
      &lt;option value='pilih' selected&gt;--Pilih--&lt;/option&gt;&quot;;
while ($r_combobox<?php echo $i ?>=mysql_fetch_array($sql_combobox<?php echo $i;?>)){
 echo &quot;&lt;option value='$r_combobox<?php echo $i;?>[<?php echo $_POST['field_value_'.$i];?>]'&gt;$r_combobox<?php echo $i;?>[<?php echo $_POST['field_label_'.$i];?>]&lt;/option&gt;&quot;;
}
echo &quot;&lt;/select&gt;&lt;/td&gt;&lt;/tr&gt;
<?php		  
	   }
	   elseif ($_POST['type'.$i]=='hidden'){
	   if (!empty($_POST['field_value_textfield'.$i]) OR !empty($_POST['isi_method_field'.$i])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$i])){ 
		?>
$sql_hidden<?php echo $i; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$i]; ?>&quot;);
$r_hidden<?php echo $i; ?> = mysql_fetch_array($sql_hidden<?php echo $i; ?>);
echo &quot;
&lt;input type='hidden' name='<?php echo $_POST['label_value'.$i];?>' value='$r_hidden<?php echo $i; ?>[<?php echo $_POST['field_value_textfield'.$i]; ?>]'&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$i])){
echo $_POST['isi_method_field'.$i]; 
?>

echo &quot;
&lt;input type='hidden' name='<?php echo $_POST['label_value'.$i];?>' value='<?php echo $_POST['value_method_field'.$i]; ?>'&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$i]) AND empty($_POST['isi_method_field'.$i])){
				?>
&lt;input type='hidden' name='<?php echo $_POST['label_value'.$i];?>' value='<?php echo $_POST['value'.$i]; ?>'&gt;              
<?php
				}
	   }
		elseif ($_POST['type'.$i]=='file'){
		?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i];?>&lt;/td&gt;&lt;td&gt;: &lt;input type=file name='fupload<?php echo $i; ?>' size='<?php echo $_POST['size'.$i]; ?>'&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		elseif ($_POST['type'.$i]=='tgl_lengkap'){
		?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i];?>&lt;/td&gt;&lt;td&gt;: &quot;;
combotgl(1,31,'tgl_<?php echo $_POST['label_value'.$i];?>',$tgl_skrg);
combonamabln(1,12,'bln_<?php echo $_POST['label_value'.$i];?>',$bln_sekarang);
combothn(<?php echo $_POST['thn_mulai'.$i]; ?>,$thn_sekarang,'thn_<?php echo $_POST['label_value'.$i];?>',$thn_sekarang); 
echo&quot;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		elseif ($_POST['type'.$i]=='tgl'){
		?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i];?>&lt;/td&gt;&lt;td&gt;: &quot;;
combotgl(1,31,'tgl_<?php echo $_POST['label_value'.$i];?>',$tgl_skrg);
echo&quot;&lt;/td&gt;&lt;/tr&gt;        
<?php
		}
		elseif ($_POST['type'.$i]=='bln'){
		?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i];?>&lt;/td&gt;&lt;td&gt;: &quot;;
combonamabln(1,12,'bln_<?php echo $_POST['label_value'.$i];?>',$bln_sekarang);
echo&quot;&lt;/td&gt;&lt;/tr&gt;        
<?php
		}
		elseif ($_POST['type'.$i]=='thn'){
		?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$i];?>&lt;/td&gt;&lt;td&gt;: &quot;;
combothn(<?php echo $_POST['thn_mulai'.$i]; ?>,$thn_sekarang,'thn_<?php echo $_POST['label_value'.$i];?>',$thn_sekarang);
echo&quot;&lt;/td&gt;&lt;/tr&gt;        
<?php
		}
	}
?>
&lt;tr&gt;&lt;td colspan=2&gt;&lt;input type=submit name=submit value=Simpan&gt;
&lt;input type=button value=Batal onclick=self.history.back()&gt;&lt;/td&gt;&lt;/tr&gt;
&lt;/table&gt;
&lt;/form&gt;&quot;;
break;

// Form Edit <?php echo $_POST['modul'];?> 
case &quot;edit<?php echo $_POST['modul'];?>&quot;:
$edit = mysql_query(&quot;SELECT * FROM <?php echo $_POST['tabel']; ?> WHERE <?php echo $pry['Column_name'];?>='$_GET[id]'&quot;);
$r    = mysql_fetch_array($edit);

echo &quot;&lt;h2&gt;Edit <?php echo $_POST['modul'];?>&lt;/h2&gt;
&lt;form method=POST action='$aksi?module=<?php echo $_POST['modul']; ?>&amp;act=update' <?php if ($_POST['jum_file']>0){?>enctype='multipart/form-data'<?php } ?> onsubmit='return validasi(this)'&gt;
&lt;input type=hidden name=id value='$r[<?php echo $pry['Column_name'];?>]'&gt;
&lt;table&gt;
<?php
for ($j=1; $j<=$_POST['jml']; $j++){
	if ($_POST['type'.$j]=='text_field'){
		if (!empty($_POST['field_value_textfield'.$j]) OR !empty($_POST['isi_method_field'.$j])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$j])){ 
		?>
$sql_field<?php echo $j; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$j]; ?>&quot;);
$r_field<?php echo $j; ?> = mysql_fetch_array($sql_field<?php echo $j; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$j];?>' size='<?php echo $_POST['size'.$j]; ?>' value='$r_field<?php echo $j; ?>[<?php echo $_POST['field_value_textfield'.$j]; ?>]' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$j])){
echo $_POST['isi_method_field'.$j]; 
?>

echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$j];?>' size='<?php echo $_POST['size'.$j]; ?>' value='<?php echo $_POST['value_method_field'.$j]; ?>' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$j]) AND empty($_POST['isi_method_field'.$j])){
				?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$j];?>' size='<?php echo $_POST['size'.$j]; ?>' value='$r[<?php echo $_POST['label_value'.$j]; ?>]' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;                
<?php
				}
		}
		elseif ($_POST['type'.$j]=='textarea'){
			if (!empty($_POST['field_value_textfield'.$j]) OR !empty($_POST['isi_method_field'.$j])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$j])){ 
		?>
$sql_textarea<?php echo $j; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$j]; ?>&quot;);
$r_textarea<?php echo $j; ?> = mysql_fetch_array($sql_textarea<?php echo $j; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$j];?>' cols='<?php echo $_POST['textarea_cols'.$j];?>' rows='<?php echo $_POST['textarea_rows'.$j]; ?>' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;$r_textarea<?php echo $j; ?>['<?php echo $_POST['field_value_textfield'.$j]; ?>']&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$j])){
echo $_POST['isi_method_field'.$j]; 
?>

echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$j];?>' cols='<?php echo $_POST['textarea_cols'.$j];?>' rows='<?php echo $_POST['textarea_rows'.$j]; ?>' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;<?php echo $_POST['value_method_field'.$j]; ?>&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$j]) AND empty($_POST['isi_method_field'.$j])){
				?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$j];?>' cols='<?php echo $_POST['textarea_cols'.$j];?>' rows='<?php echo $_POST['textarea_rows'.$j]; ?>' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;$r[<?php echo $_POST['label_value'.$j]; ?>]&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;                
<?php
				}
			}
			elseif ($_POST['type'.$j]=='password'){
				if (!empty($_POST['field_value_textfield'.$j]) OR !empty($_POST['isi_method_field'.$j])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$j])){ 
		?>
$sql_password<?php echo $j; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$j]; ?>&quot;);
$r_password<?php echo $j; ?> = mysql_fetch_array($sql_password<?php echo $j; ?>);
echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$j];?>' size='<?php echo $_POST['size'.$j]; ?>' value='$r_password<?php echo $j; ?>[<?php echo $_POST['field_value_textfield'.$j]; ?>]' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$j])){
echo $_POST['isi_method_field'.$j]; 
?>

echo &quot;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$j];?>' size='<?php echo $_POST['size'.$j]; ?>' value='<?php echo $_POST['value_method_field'.$j]; ?>' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$j]) AND empty($_POST['isi_method_field'.$j])){
				?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$j];?>' size='<?php echo $_POST['size'.$j]; ?>' value='$r[<?php echo $_POST['label_value'.$j]; ?>]' <?php if ($_POST['disable'.$j]=='ya'){?> disabled<?php }?>&gt;&lt;/td&gt;&lt;/tr&gt;                
<?php
				  }
				}
				elseif ($_POST['type'.$j]=='radio'){ $sebelum=$j-1; $sesudah=$j+1; if ($_POST['type'.$sebelum]!='radio'){?>&quot;;<?php }
					for ($rd=1; $rd<=$_POST['jumlahradio'.$j]; $rd++){
						?> 
<?php if ($rd==1){?>if <?php }else{?>elseif <?php }?>($r[<?php echo $_POST['label_value'.$j];?>]=='<?php echo $_POST['value'.$rd.'radio'.$j]; ?>'){
  echo &quot;&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;     &lt;td&gt; : <?php for ($rd2=1; $rd2<=$_POST['jumlahradio'.$j]; $rd2++){ ?>&lt;input type=radio name='<?php echo $_POST['label_value'.$j];?>' value='<?php echo $_POST['value'.$rd2.'radio'.$j]; ?>' <?php if ($_POST['value'.$rd.'radio'.$j] == $_POST['value'.$rd2.'radio'.$j]){?>checked<?php } ?>&gt; <?php echo $_POST['label'.$rd2.'radio'.$j]; ?> <?php } ?>
  &lt;/td&gt;&lt;/tr&gt;&quot;;  
}                      
<?php						
						}
						if ($_POST['type'.$sesudah]!='radio'){
							?>
echo &quot;<?php
							}
					}
					elseif ($_POST['type'.$j]=='checkbox'){ 
						?>            
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;:	
&quot;;
$str<?php echo $j; ?> = $r['<?php echo $_POST['label_value'.$j];?>'];
$data<?php echo $j; ?> = explode_trim($str<?php echo $j; ?>); 
echo &quot;<?php for ($cb=1; $cb<=$_POST['jumlahcheckbox'.$j]; $cb++){ ?> &lt;input type=checkbox value='<?php echo $_POST['value'.$cb.'checkbox'.$j]; ?>' name='<?php echo $_POST['label_value'.$j];?>[]'&quot;; if (in_array('<?php echo $_POST['value'.$cb.'checkbox'.$j]; ?>',$data<?php echo $j; ?>)){echo &quot;checked&quot;;} echo &quot;&gt;<?php echo $_POST['label'.$cb.'checkbox'.$j]; ?> 
<?php } ?> &lt;/td&gt;&lt;/tr&gt;
                        <?php						
						}
						elseif ($_POST['type'.$j]=='text_fielddb'){
							?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;input type='text' name='<?php echo $_POST['label_value'.$j];?>' size='<?php echo $_POST['size'.$j]; ?>' value='$r[<?php echo $_POST['label_value'.$j]; ?>]'&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
							}
							elseif ($_POST['type'.$j]=='textareadb'){
								?>               
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;: &lt;textarea name='<?php echo $_POST['label_value'.$j];?>' cols='<?php echo $_POST['textarea_cols'.$j];?>' rows='<?php echo $_POST['textarea_rows'.$j]; ?>'&gt;$r[<?php echo $_POST['label_value'.$j]; ?>]&lt;/textarea&gt;&lt;/td&gt;&lt;/tr&gt;	
<?php
								}
								elseif ($_POST['type'.$j]=='radiodb'){
									?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;:&quot;;
$sql_radio<?php echo $j ?> = mysql_query(&quot;<?php echo $_POST['sql_radiodb'.$j];?>&quot;);
while ($r_radio<?php echo $j ?>=mysql_fetch_array($sql_radio<?php echo $j;?>)){
    if ($r['<?php echo $_POST['label_value'.$j];?>']==$r_radio<?php echo $j; ?>['<?php echo $_POST['field_value_'.$j];?>']){
	   echo &quot;&lt;input type=radio name='<?php echo $_POST['label_value'.$j];?>' value='$r_radio<?php echo $j;?>[<?php echo $_POST['field_value_'.$j];?>]' selected&gt;$r_radio<?php echo $j;?>[<?php echo $_POST['field_label_'.$j];?>]&lt;br&gt;&quot;;
    }else{
	   echo &quot;&lt;input type=radio name='<?php echo $_POST['label_value'.$j];?>' value='$r_radio<?php echo $j;?>[<?php echo $_POST['field_value_'.$j];?>]'&gt;$r_radio<?php echo $j;?>[<?php echo $_POST['field_label_'.$j];?>]&lt;br&gt;&quot;;
	}
}
echo &quot;&lt;/td&gt;&lt;/tr&gt;
<?php									
									}
									elseif ($_POST['type'.$j]=='checkboxdb'){
									?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;:&quot;;
$str<?php echo $j; ?> = $r['<?php echo $_POST['label_value'.$j];?>'];
$data<?php echo $j; ?> = explode_trim($str<?php echo $j; ?>);
$sql_checkbox<?php echo $j ?> = mysql_query(&quot;<?php echo $_POST['sql_radiodb'.$j]; ?>&quot;);
while ($r_checkbox<?php echo $j ?>=mysql_fetch_array($sql_checkbox<?php echo $j;?>)){
    if (in_array($r_checkbox<?php echo $j; ?>['<?php echo $_POST['field_value_'.$j];?>'],$data<?php echo $j; ?>)){
	   echo &quot;&lt;input type=checkbox name='<?php echo $_POST['label_value'.$j];?>[]' value='$r_checkbox<?php echo $j;?>[<?php echo $_POST['field_value_'.$j];?>]' checked&gt;$r_checkbox<?php echo $j;?>[<?php echo $_POST['field_label_'.$j];?>]&lt;br&gt;&quot;;
    }else{
	   echo &quot;&lt;input type=checkbox name='<?php echo $_POST['label_value'.$j];?>[]' value='$r_checkbox<?php echo $j;?>[<?php echo $_POST['field_value_'.$j];?>]'&gt;$r_checkbox<?php echo $j;?>[<?php echo $_POST['field_label_'.$j];?>]&lt;br&gt;&quot;;
	}
}
echo &quot;&lt;/td&gt;&lt;/tr&gt;
<?php
										}
										elseif ($_POST['type'.$j]=='combobox'){ $sebelum=$j-1; $sesudah=$j+1; if ($_POST['type'.$sebelum]!='combobox'){?>&quot;;<?php }
					for ($rd=1; $rd<=$_POST['jumlahcombobox'.$j]; $rd++){
						?> 
<?php if ($rd==1){?>if <?php }else{?>elseif <?php }?>($r[<?php echo $_POST['label_value'.$j];?>]=='<?php echo $_POST['value'.$rd.'combobox'.$j]; ?>'){
  echo &quot;&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt; : &lt;select name='<?php echo $_POST['label_value'.$j];?>'&gt;
  <?php for ($rd2=1; $rd2<=$_POST['jumlahcombobox'.$j]; $rd2++){ ?>
                               &lt;option value='<?php echo $_POST['value'.$rd2.'combobox'.$j]; ?>' <?php if ($_POST['value'.$rd.'combobox'.$j] == $_POST['value'.$rd2.'combobox'.$j]){?>selected<?php } ?>&gt; <?php echo $_POST['label'.$rd2.'combobox'.$j]; ?>&lt;/option&gt; 
  <?php } ?>
                               &lt;/select&gt; &lt;/td&gt;&lt;/tr&gt;&quot;;  
}
<?php										
}
                            if ($_POST['type'.$sesudah]!='checkbox'){
							?>
echo &quot;<?php
							}
										}
										elseif ($_POST['type'.$j]=='comboboxdb'){?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j]; ?>&lt;/td&gt;&lt;td&gt;:&quot;;
$sql_combobox<?php echo $j ?> = mysql_query(&quot;<?php echo $_POST['sql_radiodb'.$j]; ?>&quot;);
echo &quot;&lt;select name='<?php echo $_POST['label_value'.$j];?>'&gt;
      &lt;option value='pilih'&gt;--Pilih--&lt;/option&gt;&quot;;
while ($r_combobox<?php echo $j ?>=mysql_fetch_array($sql_combobox<?php echo $j;?>)){
 if ($r['<?php echo $_POST['label_value'.$j];?>'] == $r_combobox<?php echo $j ?>['<?php echo $_POST['field_value_'.$j];?>']){
     echo &quot;&lt;option value='$r_combobox<?php echo $j;?>[<?php echo $_POST['field_value_'.$j];?>]' selected&gt;$r_combobox<?php echo $j;?>[<?php echo $_POST['field_label_'.$j];?>]&lt;/option&gt;&quot;;
 }
 else {
     echo &quot;&lt;option value='$r_combobox<?php echo $j;?>[<?php echo $_POST['field_value_'.$j];?>]'&gt;$r_combobox<?php echo $j;?>[<?php echo $_POST['field_label_'.$j];?>]&lt;/option&gt;&quot;;
 }
}
echo &quot;&lt;/select&gt;&lt;/td&gt;&lt;/tr&gt;
<?php
											}
											elseif ($_POST['type'.$j]=='hidden'){
												 if (!empty($_POST['field_value_textfield'.$j]) OR !empty($_POST['isi_method_field'.$j])){
		?>
&quot;;
<?php } 
		if (!empty($_POST['field_value_textfield'.$j])){ 
		?>
$sql_hidden<?php echo $j; ?> = mysql_query(&quot;<?php echo $_POST['sql_field'.$j]; ?>&quot;);
$r_hidden<?php echo $j; ?> = mysql_fetch_array($sql_hidden<?php echo $j; ?>);
echo &quot;
&lt;input type='hidden' name='<?php echo $_POST['label_value'.$j];?>' value='$r_hidden<?php echo $j; ?>[<?php echo $_POST['field_value_textfield'.$j]; ?>]'&gt;
<?php
		}
		if (!empty($_POST['isi_method_field'.$j])){
echo $_POST['isi_method_field'.$j]; 
?>

echo &quot;
&lt;input type='hidden' name='<?php echo $_POST['label_value'.$j];?>' value='<?php echo $_POST['value_method_field'.$j]; ?>'&gt;
<?php
			}
			if (empty($_POST['field_value_textfield'.$j]) AND empty($_POST['isi_method_field'.$j])){
				?>
&lt;input type='hidden' name='<?php echo $_POST['label_value'.$j];?>' value='$r[<?php echo $_POST['label_value'.$j]; ?>]'&gt;             
<?php
				}
												}
												elseif ($_POST['type'.$j]=='file'){
													?>
&lt;input type=hidden name='files<?php echo $j; ?>' value='$r[<?php echo $_POST['label_value'.$j];?>]'&gt;
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j];?>&lt;/td&gt;&lt;td&gt;: &quot;;
<?php if ($_POST['type_file'.$j]=="gambar"){?>
  if (empty($r['<?php echo $_POST['label_value'.$j];?>'])){
  echo &quot;Belum Ada Foto&quot;;
  }else{
      if ($r['<?php echo $_POST['label_value'.$j];?>'] != '<?php echo $_POST['nama_gambar'.$j]; ?>'){
        echo &quot;&lt;img src='../<?php echo $_POST['folder_simpan_file'.$j]; ?>/medium_$r[<?php echo $_POST['label_value'.$j];?>]'&gt;&lt;br&gt;
        &lt;a href=javascript:confirmdelete('$aksi?module=<?php echo $_POST['modul'];?>&amp;act=delete_files&amp;id=&quot;.$r[<?php echo $pry['Column_name'];?>].&quot;&amp;files<?php echo $j ?>=&quot;.$r[<?php echo $_POST['label_value'.$j];?>].&quot;')&gt;Hapus Gambar&lt;/a&gt;&quot;;
      }
      else{
        echo &quot;&lt;img src='../<?php echo $_POST['folder_simpan_file'.$j]; ?>/$r[<?php echo $_POST['label_value'.$j];?>]'&gt;&quot;;
      }
  }
<?php }
	else{
?>
  if (empty($r['<?php echo $_POST['label_value'.$j];?>'])){
  echo &quot;Belum Ada File&quot;;
  }else{      
        echo &quot;&lt;a href=javascript:confirmdelete('$aksi?module=<?php echo $_POST['modul'];?>&amp;act=delete_files&amp;id=&quot;.$r[<?php echo $pry['Column_name'];?>].&quot;&amp;files<?php echo $j ?>=&quot;.$r[<?php echo $_POST['label_value'.$j];?>].&quot;')&gt;Hapus File&lt;/a&gt;&quot;;
  }
<?php
	}
?>
echo&quot;&lt;/td&gt;&lt;/tr&gt;
&lt;tr&gt;&lt;td&gt;Ganti <?php echo $_POST['label'.$j];?>&lt;/td&gt;&lt;td&gt;: &lt;input type=file name='fupload<?php echo $j; ?>' size='<?php echo $_POST['size'.$j]; ?>'&gt;&lt;/td&gt;&lt;/tr&gt;                          
<?php
													}
													elseif ($_POST['type'.$j]=='tgl_lengkap'){
														?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j];?>&lt;/td&gt;&lt;td&gt;: &quot;;
$get_tgl2=substr(&quot;$r[<?php echo $_POST['label_value'.$j];?>]&quot;,8,2);
combotgl(1,31,'tgl_<?php echo $_POST['label_value'.$j];?>',$get_tgl2);
$get_bln2=substr(&quot;$r[<?php echo $_POST['label_value'.$j];?>]&quot;,5,2);
combonamabln(1,12,'bln_<?php echo $_POST['label_value'.$j];?>',$get_bln2);
$get_thn2=substr(&quot;$r[<?php echo $_POST['label_value'.$j];?>]&quot;,0,4);
combothn(<?php echo $_POST['thn_mulai'.$j];?>,$thn_sekarang,'thn_<?php echo $_POST['label_value'.$j];?>',$get_thn2);
echo &quot;&lt;/td&gt;&lt;/tr&gt;                                                       
<?php
														}
														elseif ($_POST['type'.$j]=='tgl'){
														?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j];?>&lt;/td&gt;&lt;td&gt;: &quot;;
$get_tgl2=substr(&quot;$r[<?php echo $_POST['label_value'.$j];?>]&quot;,8,2);
combotgl(1,31,'tgl_<?php echo $_POST['label_value'.$j];?>',$get_tgl2);
echo &quot;&lt;/td&gt;&lt;/tr&gt;                                                         
<?php
														}
														elseif ($_POST['type'.$j]=='bln'){
														?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j];?>&lt;/td&gt;&lt;td&gt;: &quot;;
$get_bln2=substr(&quot;$r[<?php echo $_POST['label_value'.$j];?>]&quot;,5,2);
combonamabln(1,12,'bln_<?php echo $_POST['label_value'.$j];?>',$get_bln2);
echo &quot;&lt;/td&gt;&lt;/tr&gt;                                                         
<?php
														}
														elseif ($_POST['type'.$j]=='thn'){
														?>
&lt;tr&gt;&lt;td&gt;<?php echo $_POST['label'.$j];?>&lt;/td&gt;&lt;td&gt;: &quot;;
$get_thn2=substr(&quot;$r[<?php echo $_POST['label_value'.$j];?>]&quot;,0,4);
combothn(<?php echo $_POST['thn_mulai'.$j];?>,$thn_sekarang,'thn_<?php echo $_POST['label_value'.$j];?>',$get_thn2);
echo &quot;&lt;/td&gt;&lt;/tr&gt;                                                         
<?php
														}
								
	}
?>&lt;tr&gt;&lt;td colspan=2&gt;&lt;input type=submit value=Update&gt;
&lt;input type=button value=Batal onclick=self.history.back()&gt;&lt;/td&gt;&lt;/tr&gt;
&lt;/table&gt;
&lt;/form&gt;&quot;;
break;

}
}
?&gt;
</textarea>

<?php
for ($j=1; $j<=$_POST['jml']; $j++){
	echo "<input type=hidden name='th$j' value='".$_POST['label'.$j]."'>";
	}
for ($k=1; $k<=$_POST['jml']; $k++){
	echo "<input type=hidden name='value$k' value='".$_POST['label_value'.$k]."'>";
	}
for ($l=0; $l<=$_POST['jml']; $l++){
	if ($_POST['type'.$l]=='radiodb'){
		echo "<input type=hidden name='tabel_ralasi$l' value='".$_POST['tabel_radiodb'.$l]."'>";
		echo "<input type=hidden name='field_ralasi$l' value='".$_POST['relasi_radiodb'.$l]."'>";
		echo "<input type=hidden name='where_ralasi$l' value='".$_POST['where_radiodb'.$l]."'>";
		echo "<input type=hidden name='whereisi_ralasi$l' value='".$_POST['whereisi_radiodb'.$l]."'>";
		echo "<input type=hidden name='field_value_ralasi$l' value='".$_POST['value_radiodb'.$l]."'>";
		echo "<input type=hidden name='type$l' value='radiodb'>";
		}
	elseif ($_POST['type'.$l]=='checkboxdb'){
		echo "<input type=hidden name='tabel_ralasi$l' value='".$_POST['tabel_checkboxdb'.$l]."'>";
		echo "<input type=hidden name='field_ralasi$l' value='".$_POST['relasi_checkboxdb'.$l]."'>";
		echo "<input type=hidden name='where_ralasi$l' value='".$_POST['where_checkboxdb'.$l]."'>";
		echo "<input type=hidden name='whereisi_ralasi$l' value='".$_POST['whereisi_checkboxdb'.$l]."'>";
		echo "<input type=hidden name='field_value_ralasi$l' value='".$_POST['value_checkboxdb'.$l]."'>";
		echo "<input type=hidden name='type$l' value='checkboxdb'>";
		}
	elseif ($_POST['type'.$l]=='comboboxdb'){
		echo "<input type=hidden name='tabel_ralasi$l' value='".$_POST['tabel_comboboxdb'.$l]."'>";
		echo "<input type=hidden name='field_ralasi$l' value='".$_POST['relasi_comboboxdb'.$l]."'>";
		echo "<input type=hidden name='where_ralasi$l' value='".$_POST['where_comboboxdb'.$l]."'>";
		echo "<input type=hidden name='whereisi_ralasi$l' value='".$_POST['whereisi_comboboxdb'.$l]."'>";
		echo "<input type=hidden name='field_value_ralasi$l' value='".$_POST['value_comboboxdb'.$l]."'>";
		echo "<input type=hidden name='type$l' value='comboboxdb'>";
		}
	}
	  echo "<br>
	  <input type=hidden name='database' value='$_POST[database]'>
	  <input type=hidden name='tabel' value='$_POST[tabel]'>
	  <input type=hidden name='jml' value='$i'>
	  <input type=hidden name='modul' value='$_POST[modul]'>
	  <input type=hidden name='folder' value='$_POST[folder]'>
	  <input type=hidden name='file_utama' value='$_POST[file_utama]'>
      <input type=hidden name='file_aksi' value='$_POST[file_aksi]'>
	  <input type=hidden name='ada_ralasi' value='$ada_relasi'>
	  <input type=hidden name='ada_checkbox' value='$ada_checkbox'>
	  <input type=hidden name='ada_where' value='$ada_where'>";
?>


<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("file_utama"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 8,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift"
      });
    </script>
