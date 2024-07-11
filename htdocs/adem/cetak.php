<?php
require_once('includes/init.php');
require_once('includes/fungsi_elec.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
$page = "Hasil Penilaian ".$periode_aktif;

require_once('template/header-cetak.php');
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
<style>
  @media print {
    @page {
     /*  size: portrait;  Use portrait or landscape */ 
    }

    .kop-surat {
      /* Gaya khusus untuk halaman ini */
    }
  }
</style>

	<div class="kop">
			<h6>Laporan Data Hasil Akhir Berdasarkan Penilaian</h6>
			<h6>Penentuan Penerima Beasiswa Adem</h6>
			<h6>Tahun <?php echo $pengaturan['periode_aktif']; ?></h6>
		</div>

    <div class="card-body">
		<div class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead class="bg-primary text-black">
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
						<td><?= $no ?></td>
						<td align="Left"><?= $item['nama'] ?></td>
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