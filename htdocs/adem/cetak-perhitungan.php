<?php
require_once('includes/init.php');
require_once('includes/fungsi_elec.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
$page = "Perhitungan ".$periode_aktif;
require_once('template/header-cetak.php');

// mysqli_query($koneksi,"TRUNCATE TABLE hasil;");

$kriterias = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");			

$data = get_data();
$bobot = array();
foreach($KRT as $key => $val){
    $bobot[$key] = $val['bobot'];
}
$electre = new Electre($data, $bobot);

?>	
 <style>	
       thead.bg-primary.text-black {
            background-color: #FFFFFF !important; /* abu-abu */
            color: #000000 !important; /* hitam */
			font-size: 11px;			
			
        }

        thead.bg-primary.text-black th {
            border: 1px solid #000000 !important; /* hitam */
            color: #000000 !important; /* hitam */
			font-size: 11px;
			/* font-weight: normal; */
        }
      
		
		tbody tr {
            background-color: #FFFFFF !important; /* putih */
			font-size: 11px;
        }

        tbody tr td {
            border: 1px solid #000000 !important; /* hitam */
            color: #000000 !important; /* hitam */
			font-size: 11px;
        }

        /* Ensure table borders are black */
        table.dataTable {
			border: 1px solid #000000 !important; /* hitam */
            color: #000000 !important; /* hitam */
			font-size: 11px;
        }
    </style>
<div class="card mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Bobot Kriteria (W)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">		
				<thead class="bg-primary text-black">
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

<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Matrix Keputusan (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">		
				<thead class="bg-primary text-black">
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

<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Normalisasi Matriks Keputusan</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">		
				<thead class="bg-primary text-black">
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

<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Pembobotan Pada Matriks Yang Telah Dinormalisasi</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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

<style>	
       thead.bg-primary.text-black {
            background-color: #FFFFFF !important; /* abu-abu */
            color: #000000 !important; /* hitam */
			font-size: 11px;			
			
        }

        thead.bg-primary.text-black th {
            border: 1px solid #000000 !important; /* hitam */
            color: #000000 !important; /* hitam */
			font-size: 11px;
			font-weight: normal;
        }
</style>			
<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Himpunan Concordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?= $ALT[$key] ?></td>
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

<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Himpunan Discordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?= $ALT[$key] ?></td>
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


<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Matriks Concordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?= $ALT[$key] ?></td>
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


<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Matriks Discordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?= $ALT[$key] ?></td>
						<?php foreach ($val as $k => $v) : ?>
						<td><?= $key == $k ? '-' : (is_numeric($v) ? round($v, 10) : $v)  ?></td>
						<?php endforeach ?>
					</tr>
					<?php 
					endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Matriks Dominan Concordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?= $ALT[$key] ?></td>
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

<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Matriks Dominan Discordance</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?= $ALT[$key] ?></td>
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

<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Aggregate Dominance Matrix</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?=$ALT[$key]?></td>
						<?php foreach($electre->agregate[$key] as $k => $v):?>
						<td><?=$key==$k ? '-' : $v?></td>
						<?php endforeach?>
						<td><?=$tot = $electre->total[$key]?></td>
					</tr>
					<?php 
				//	mysqli_query($koneksi,"INSERT INTO hasil (id_hasil, nama, nilai) VALUES ('', '$ALT[$key]', '$tot')");
					endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</body>
</html>

<?php
}
else {
	header('Location: login.php');
}
?>