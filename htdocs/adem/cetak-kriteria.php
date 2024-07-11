<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
$page = "Kriteria ".$periode_aktif;

require_once('template/header-cetak.php');
?>	

<div class="card  mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Daftar Data Kriteria</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
					<tr align="center">
						<th>No</th>
						<th>Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Bobot</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$query = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");			
				while($data = mysqli_fetch_array($query)):
				?>
					<tr align="center">
						<td><?php echo $no; ?></td>
						<td><?php echo $data['id_kriteria']; ?></td>
						<td align="left"><?php echo $data['nama']; ?></td>
						<td><?php echo $data['bobot']; ?></td>						
					</tr>
					<?php 
					$no++;
					endwhile; ?>
				</tbody>
			</table>
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