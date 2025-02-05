<?php
include 'class_biodata.php';

$biodata = new Biodata();
$biodata->setnama($_POST['nama']);
$biodata->setnim($_POST['nim']);
$biodata->setalamat($_POST['alamat']);
$biodata->settgllahir($_POST['tgllahir']);

$data = $biodata->getBiodata();

echo "<h1>Biodata Mahasiswa</h1>";
foreach ($data as $key => $value) {
    echo "<p><strong>$key:</strong> $value</p>";
}
?>
