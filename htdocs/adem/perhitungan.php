<?php
require_once('includes/init.php');
require_once('includes/fungsi_elec.php');

$user_role = get_role();
if($user_role == 'admin' || 'user') {

$page = "Perhitungan";
require_once('template/header.php');

mysqli_query($koneksi,"DELETE FROM hasil WHERE periode = '$periode_aktif';");

$kriterias = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");			

$data = get_data();
$bobot = array();
foreach($KRT as $key => $val){
    $bobot[$key] = $val['bobot'];
}
$electre = new Electre($data, $bobot);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>
	<a href="cetak-perhitungan.php" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Bobot Kriteria (W)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<?php foreach ($kriterias as $key): ?>
						<th><?= $key['nama'] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php foreach ($kriterias as $key): ?>
						<td>
						<?php 
						echo $key['bobot'];
						?>
						</td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Matrix Keputusan (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<?php foreach($electre->kriteria as $key => $val):?>
						<th><?=$KRT[$key]['nama']?></th>
						<?php endforeach?> 
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach($data as $key => $val):?>
					<tr>	
						<tr align="center">
						<td><?= $no ?></td>
						<td><?=$ALT[$key]?></td>
						<?php foreach($val as $k => $v):?>
						<td><?=$v?></td>
						<?php endforeach?>
					</tr>
					<?php 
					$no++;
					endforeach;?>	
				</tbody>

			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Normalisasi Matriks Keputusan</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($electre->kriteria as $key => $val) : ?>
						<th width="13%"><?= $KRT[$key]['nama'] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach ($electre->normal as $key => $val) : ?>
					<tr align="center">
						<td><?= $no ?></td>
						<td><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= (is_numeric($v) ? round($v, 10) : $v) ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					$no++;
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Pembobotan Pada Matriks Yang Telah Dinormalisasi</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($electre->kriteria as $key => $val) : ?>
						<th width="13%"><?= $KRT[$key]['nama'] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach ($electre->terbobot as $key => $val) : ?>
					<tr align="center">
						<td><?= $no ?></td>
						<td><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= (is_numeric($v) ? round($v, 10) : $v) ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					$no++;
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Himpunan Concordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th >Nama Alternatif</th>
						<?php foreach ($electre->concordance as $key => $val) : ?>
						<th ><?= $ALT[$key] ?></th>
						<?php endforeach ?>
						
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($electre->concordance as $key => $val) : ?>
					<tr align="center">
						<td class="bg-primary text-white" style="font-weight: bold;"><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= $key == $k ? '-' : implode(', ', $v) ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Himpunan Discordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th>Nama Alternatif</th>
						<?php foreach ($electre->discordance as $key => $val) : ?>
						<th ><?= $ALT[$key] ?></th>
						<?php endforeach ?>
						
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($electre->discordance as $key => $val) : ?>
					<tr align="center">
						<td class="bg-primary text-white" style="font-weight: bold;"><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= $key == $k ? '-' : implode(', ', $v) ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Matriks Concordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th>Nama Alternatif</th>
						<?php foreach ($electre->m_concordance as $key => $val) : ?>
						<th ><?= $ALT[$key] ?></th>
						<?php endforeach ?>
						
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($electre->m_concordance as $key => $val) : ?>
					<tr align="center">
						<td class="bg-primary text-white" style="font-weight: bold;"><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= $key == $k ? '-' : $v ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Matriks Discordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th>Nama Alternatif</th>
						<?php foreach ($electre->m_discordance as $key => $val) : ?>
						<th><?= $ALT[$key] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($electre->m_discordance as $key => $val) : ?>
					<tr align="center">
						<td class="bg-primary text-white" style="font-weight: bold;"><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= $key == $k ? '-' : (is_numeric($v) ? round($v, 10) : $v) ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Matriks Dominan Concordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th>Nama Alternatif</th>
						<?php foreach ($electre->md_concordance as $key => $val) : ?>
						<th><?= $ALT[$key] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($electre->md_concordance as $key => $val) : ?>
					<tr align="center">
						<td class="bg-primary text-white" style="font-weight: bold;"><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= $key == $k ? '-' : $v ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Matriks Dominan Discordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th>Nama Alternatif</th>
						<?php foreach ($electre->md_discordance as $key => $val) : ?>
						<th><?= $ALT[$key] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($electre->md_discordance as $key => $val) : ?>
					<tr align="center">
						<td class="bg-primary text-white" style="font-weight: bold;"><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= $key == $k ? '-' : $v ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Aggregate Dominance Matrix</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th>Nama Alternatif</th>
						<?php foreach($electre->agregate as $key => $val):?>
						<th><?=$ALT[$key]?></th>
						<?php endforeach?> 
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$rank = get_rank($electre->agregate);
					foreach($rank as $key => $val):?>
					<tr align="center">
						<td class="bg-primary text-white" style="font-weight: bold;"><?=$ALT[$key]?></td>
						<?php foreach($electre->agregate[$key] as $k => $v):?>
						<td><?=$key==$k ? '-' : $v?></td>
						<?php endforeach?>
						<td><?=$tot = $electre->total[$key]?></td>
					</tr>
					<?php 
					mysqli_query($koneksi,"INSERT INTO hasil (id_hasil, nama, nilai, periode) VALUES ('', '$ALT[$key]', '$tot', '$periode_aktif');");
					endforeach;?>
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