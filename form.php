<!DOCTYPE html>
<html>
<head>
	<title>subir archivo</title>
</head>
<body>
<!--     <form method="post" action="procesar.php" enctype="multipart/form-data" >
        <input type="file" name="foto" />
        <input type="submit" value="Upload" />
    </form> -->

    <form action="procesar.php" method="post" multipart="" enctype="multipart/form-data">
        <input type="file" name="img[]" multiple>
        <input type="submit" value="Upload" >
    </form>

</body>
</html>