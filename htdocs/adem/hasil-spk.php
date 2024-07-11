<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {

$page = "Hasil-SPK";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
	
	<a href="cetak-spk.php" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Data Hasil Electre</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th>Nama Alternatif</th>
						<th width="15%">Nilai</th>
						<th width="15%">Rank</th>
				</thead>
				<tbody>
					<?php 
						$no=0;
						$rows = mysqli_query($koneksi,"SELECT * FROM hasil WHERE periode = '$periode_aktif' ORDER BY nilai DESC, nama");
						foreach($rows as $data){
						$no++;
					?>
					<tr align="center">
						<td align="left"><?= $data['nama'] ?></td>						
						<td><?= $data['nilai'] ?></td>
						<td><?= $no; ?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
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