<link rel="stylesheet" href="lib/codemirror3.css">
<script src="lib/codemirror.js"></script>
<script src="mode/xml/xml.js"></script>
<script src="mode/javascript/javascript.js"></script>
<script src="mode/css/css.js"></script>
<script src="mode/clike/clike.js"></script>
<script src="php.js"></script>
<link rel="stylesheet" href="theme/default.css">
<style type="text/css">.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
<link rel="stylesheet" href="css/docs.css">
<title>LIBRARY UPLOAD</title>

<h2>GENERATOR MODUL CMS LOKOMEDIA</h2>

KODE FILE LIBRARY : (fungsi_thumb.php) 
<?php if ($_POST['jum_file'] > 0){ 
echo "<textarea id='code_thumb' name='kode_thumb'>
&lt;?php

";
		for ($i=1; $i<=$_POST['jml']; $i++){
			if ($_POST['type'.$i]=="file"){
				if ($_POST['type_file'.$i]=="gambar"){
			    ?>
function UploadFile<?php echo $_POST['label_value'.$i]; ?><?php echo $i; ?>($fupload_name,$ekstensi,$nomor_file){
  
  //direktori gambar
  $vdir_upload = &quot;../../../<?php echo $_POST['folder_simpan_file'.$i]; ?>/&quot;;
  $vfile_upload = $vdir_upload . $fupload_name;
  
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES[&quot;fupload&quot;.$nomor_file][&quot;tmp_name&quot;], $vfile_upload);
  
  //identitas file asli
  if ($ekstensi=='jpg' OR $ekstensi=='jpeg'){
      $dataim_src = imagecreatefromjpeg($vfile_upload);
  }
  elseif ($ekstensi=='png'){
      $dataim_src = imagecreatefrompng($vfile_upload);
  }
  elseif ($ekstensi=='gif'){
      $dataim_src = imagecreatefromgif($vfile_upload);
  }
  $im_src = $dataim_src;
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);
  
  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = <?php echo $_POST['resize_width1'.$i]; ?>;
  $dst_height = ($dst_width/$src_width)*$src_height;
  
  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
  
  //Simpan gambar
  if ($ekstensi=='jpg' OR $ekstensi=='jpeg'){
      imagejpeg($im,$vdir_upload . &quot;small_&quot; . $fupload_name);
  }
  elseif ($ekstensi=='png'){
      imagepng($im,$vdir_upload . &quot;small_&quot; . $fupload_name);
  }
  elseif ($ekstensi=='gif'){
      imagegif($im,$vdir_upload . &quot;small_&quot; . $fupload_name);
  }
  
  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = <?php echo $_POST['resize_width2'.$i]; ?>;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;
  
  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);
  
  //Simpan gambar
  if ($ekstensi=='jpg' OR $ekstensi=='jpeg'){
      imagejpeg($im2,$vdir_upload . &quot;medium_&quot; . $fupload_name);
  }
  elseif ($ekstensi=='png'){
      imagepng($im2,$vdir_upload . &quot;medium_&quot; . $fupload_name);
  }
  elseif ($ekstensi=='gif'){
      imagegif($im2,$vdir_upload . &quot;medium_&quot; . $fupload_name);
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
}

<?php				
				}
				elseif ($_POST['type_file'.$i]=="bukan_gambar"){
				?>
function UploadFile<?php echo $_POST['label_value'.$i]; ?><?php echo $i; ?>($fupload_name,$ekstensi,$nomor_file){

  //direktori banner
  $vdir_upload = &quot;../../../<?php echo $_POST['folder_simpan_file'.$i]; ?>/&quot;;
  $vfile_upload = $vdir_upload . $fupload_name;
  
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES[&quot;fupload&quot;.$nomor_file][&quot;tmp_name&quot;], $vfile_upload);
}

<?php
				}
			}
		}
echo "?&gt;</textarea><br><br>";
       } ?>

<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code_thumb"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 8,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift"
      });
    </script>