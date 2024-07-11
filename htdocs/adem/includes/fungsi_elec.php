<?php
error_reporting(~E_NOTICE);
error_reporting(0);
include'includes/rumus_electre.php';


$rows = mysqli_query($koneksi,"SELECT * FROM alternatif WHERE periode='$periode_aktif' ORDER BY id_alternatif ASC");
foreach($rows as $row){
    $ALT[$row['id_alternatif']] = $row['nama'];
} 

$rows = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");
foreach($rows as $row){
	$KRT[$row['id_kriteria']] = array(
        'nama'=>$row['nama'],
        'bobot'=>$row['bobot']
    );
}

function get_data(){
    global $koneksi;
	global $periode_aktif;
	// $sql = "SELECT a.id_alternatif, p.id_kriteria, sk.nilai FROM alternatif a INNER JOIN penilaian p ON p.id_alternatif=a.id_alternatif INNER JOIN sub_kriteria sk ON sk.id_sub_kriteria=p.nilai  ORDER BY a.id_alternatif, p.id_kriteria";
	$sql = "SELECT a.id_alternatif, p.id_kriteria, sk.nilai, a.periode FROM alternatif a INNER JOIN penilaian p ON p.id_alternatif=a.id_alternatif AND a.periode = '$periode_aktif' INNER JOIN sub_kriteria sk ON sk.id_sub_kriteria=p.nilai  ORDER BY a.id_alternatif, p.id_kriteria";
	$rows =  mysqli_query($koneksi,$sql);
	foreach($rows as $row){
		$data[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
	}
	
    return $data;
}

function get_rank($array){
    $data = $array;
    $no=1;
    $new = array();
    foreach($data as $key => $value){
        $new[$key] = $no++;
    }
    return $new;
}
?>