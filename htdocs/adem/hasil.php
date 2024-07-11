<?php
require_once('includes/init.php');
require_once('includes/fungsi_elec.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {

$page = "Hasil";
require_once('template/header.php');
?>

<?php 
// $kriterias = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");			
$data = get_data();
$bobot = array();
foreach($KRT as $key => $val){
    $bobot[$key] = $val['bobot'];
}
$electre = new Electre($data, $bobot);

// Menambahkan kolom untuk nilai hasil jumlah seluruh nilai dan menggabungkan dengan nama alternatif
$combinedData = array();
foreach($data as $key => $val) {
    $val['total'] = array_sum($val);
    $combinedData[] = array(
        'nama' => isset($ALT[$key]) ? $ALT[$key] : '',
        'nilai' => $val
    );
}

// Mengurutkan data dari yang terbesar ke terkecil berdasarkan total nilai
usort($combinedData, function($a, $b) {
    return $b['nilai']['total'] <=> $a['nilai']['total'];
});
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
	
	<a href="cetak.php" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Data Hasil Penilaian</h6>
    </div>	

</tbody>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%" rowspan="2">Rank</th>
						<th>Nama Alternatif</th>
						<?php foreach($electre->kriteria as $key => $val): ?>
						<th><?= isset($KRT[$key]['nama']) ? $KRT[$key]['nama'] : '' ?></th>
						<?php endforeach ?> 
						<th>Total Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach($combinedData as $item): ?>
					<tr align="center">
						<td><?= $no  ?></td>
						<td align="left"  ><?= $item['nama'] ?></td>
						<?php foreach($item['nilai'] as $k => $v): 
							if ($k !== 'total'): ?>
							<td><?= $v ?></td>
							<?php endif; 
						endforeach; ?>
						<td><?= $item['nilai']['total'] ?></td>
					</tr>
					<?php 
					$no++;
					endforeach; ?>	
				</tbody>
			</table>
		</div>
	</div>

	<div class="card shadow mb-4">
	</div>
</div>
</div>
<?php
require_once('template/footer.php');
}
else {
	header('Location: login.php');
}
?>