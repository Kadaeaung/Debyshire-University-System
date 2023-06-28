<!DOCTYPE html>

<html>
<head>

	<title>Download all as a zip file</title>
</head>
<body>


<form>
	select File: <input type="file">
	<input type="sumbit" value="Download">
</form>
	
		<?php 
ob_start();
$zip = new ZipArchive; 
$zip->open('Documention of Universtiry.zip',  ZipArchive::CREATE);
$srcDir = "C:\\xampp\\htdocs\\EWSDProject\uploads"; 
$files= scandir($srcDir);
print_r($files); 

unset($files[0],$files[1]);
foreach ($files as $file) {
    $zip->addFile($srcDir.'\\'.$file, $file);
    echo "bhandari";
}
$zip->close();

$file='Documention of Universtiry.zip';
if (headers_sent()) {
    echo 'HTTP header already sent';
} else {
    if (!is_file($file)) {
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        echo 'File not found';
    } else if (!is_readable($file)) {
        header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
        echo 'File not readable';
    } else {
        header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length: ".filesize($file));
        header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
        while (ob_get_level()) {
            ob_end_clean();
          }
        readfile($file);
        exit;
    }
    header('content-type:application/octet-stream');
				header("content-disposition: attchment; filename-$zip_name");
				readfile($zip_name);
}



?>
			
				



</body>
</html>