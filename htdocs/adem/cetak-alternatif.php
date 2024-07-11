<?php
require_once('includes/init.php');
$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
$page = "Alternatif ".$periode_aktif;
require_once('template/header-cetak.php');
?>	

<div class="card mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i>Daftar Data Alternatif</h6>
    </div>
	 <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
					<tr align="center">	
						<th width="5%">No</th>
						<th>Nama</th>
						<th width="20%">NISN</th>
						<th width="20%" >Tempat Lahir</th>
						<th width="20%">Tanggal Lahir</th>						
					</tr>
				</thead>
				<tbody>			
				<?php
				$no=0;
				$query = mysqli_query($koneksi,"SELECT * FROM alternatif WHERE periode='$periode_aktif'");			
				while($data = mysqli_fetch_array($query)):
				$no++;
				?>
					<tr align="center">
						<td><?php echo $no; ?></td>
						<td align="left"><?php echo $data['nama']; ?></td>
						<td align="center"><?php echo $data['nisn']; ?></td>
						<td align="left"><?php echo $data['tempat_lahir']; ?></td>
						<td align="center"><?php echo $data['tanggal_lahir']; ?></td>					
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
</div>
 <div class="signature-section">
                <div class="signature">
                <h5><?php echo $pengaturan['kab']; ?>, <?php echo date('d-m-Y'); ?></h5>
                <h5>Kepala Sekolah</h5>
                <br><br><br> <!-- Space for the signature -->
                <h5 class="name"><b><?php echo $pengaturan['pimpinan']; ?></b></h5>
                <h5>NIP. <?php echo $pengaturan['nip']; ?></h5>
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