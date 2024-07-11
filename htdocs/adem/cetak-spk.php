<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
$page = "Hasil Electre ".$periode_aktif;

require_once('template/header-cetak.php');
?>	
<style>
  @media print {
    @page {
      size: portrait; /* Use portrait or landscape */ 
    }

    .kop-surat {
      /* Gaya khusus untuk halaman ini */
    }
  }
</style>
<!-- <div class="card shadow mb-4"> -->
	<div class="kop">
			<h6>Laporan Data Hasil Akhir Berdasarkan Electre</h6>
			<h6>Penentuan Penerima Beasiswa Adem</h6>
			<h6>Tahun <?php echo $pengaturan['periode_aktif']; ?></h6>
		</div>
    <!-- /.card-header -->
    <!-- <div class="card-header py-3"> -->
        <!-- <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i>Hasil Akhir Perankingan</h6> -->
    <!-- </div> -->
	 <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
					<tr align="center">
						<th>Nama Alternatif</th>
						<th>Nilai</th>
						<th width="15%">Rank</th>
					</tr>
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