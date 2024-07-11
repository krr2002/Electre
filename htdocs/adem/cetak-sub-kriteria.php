<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
$page = "Sub Kriteria ".$periode_aktif;
require_once('template/header-cetak.php');

$query = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");
while($data = mysqli_fetch_array($query)){
?>
<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> <?= $data['nama']." (".$data['id_kriteria'].")  [".$data['info']."]" ?></h6>		
			
		</div>
    </div>	
	

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">		
				<thead class="bg-primary text-black">
					<tr align="center">						
						<th width="5%">No</th>
						<th>Nama Sub Kriteria</th>
						<th width="20%">Nilai</th>						
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						$id_kriteria = $data['id_kriteria'];
						$q = mysqli_query($koneksi,"SELECT * FROM sub_kriteria WHERE id_kriteria = '$id_kriteria' ORDER BY nilai DESC");			
						while($d = mysqli_fetch_array($q)){
					?>
					<tr align="center">
						<td><?=$no ?></td>
						<td align="left"><?= $d['nama'] ?></td>
						<td><?= $d['nilai'] ?></td>						
					</tr>
			
                <?php
					$no++;
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</body>
</html>

<?php
} }
else {
	header('Location: login.php');
}
?>