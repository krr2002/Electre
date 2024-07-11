<?php
require_once('includes/init.php');

$user_role = get_role();
if ($user_role == 'admin' || $user_role == 'user') {	
$page = "Penilaian ".$periode_aktif;
    require_once('template/header-cetak.php');
?>
    <div class="card mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black"><i class="fa fa-table"></i> Daftar Data Penilaian</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
               <table width="100%" cellspacing="0" cellpadding="5" border="1">
                   <thead class="bg-primary text-black">
					<tr align="center">
						<?php	
						// Mengambil semua kriteria
						$q1 = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");		
						// Mengambil nilai berdasarkan kriteria dan alternatif					
							$q1_data = [];				
							while ($d = mysqli_fetch_array($q1)) {
								$q1_data[] = $d;
								}
							?>
						<th width="5%">No</th>
						<th>Alternatif</th>
						<!-- <th>Penilaian</th> -->
						<?php foreach ($q1_data as $d): ?>
						<th><?= $d['nama'] ?></th>
						<?php endforeach; ?>
						<th>Total Nilai</th>
					</tr>
				</thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE periode=$periode_aktif");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
						<tr>
							<td align="center"><?= $no ?></td>
							<td align="left"><?= $data['nama'] ?></td>								
							<?php
							$id_alternatif = $data['id_alternatif'];

							// Mengambil semua kriteria
							$q2 = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");

							// Mengambil nilai berdasarkan kriteria dan alternatif
							$nilai = [];
							$q2_data = [];
							while ($d = mysqli_fetch_array($q2)) {
								$id_kriteria = $d['id_kriteria'];
								$q2_data[] = $d; // Simpan data kriteria untuk header tabel
								$q4 = mysqli_query($koneksi, "SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria'");			
								$d4 = mysqli_fetch_array($q4);
								$nilai[$id_kriteria] = $d4['nilai'];
							}
							?>
							
							<?php 
							$total_nilai = 0; // Variabel untuk menyimpan total nilai
							foreach ($q2_data as $d): 							
							?>							
							<td >	
								<?php
								$id_kriteria = $d['id_kriteria'];
								$q3 = mysqli_query($koneksi, "SELECT * FROM sub_kriteria WHERE id_kriteria = '$id_kriteria' ORDER BY nilai ASC");
								while ($d3 = mysqli_fetch_array($q3)) {
									if ($d3['id_sub_kriteria'] == $nilai[$id_kriteria]) {									
										$nilai_kriteria = floatval($d3['nilai']); // Mengonversi nilai menjadi float
										echo $nilai_kriteria;	
										$total_nilai += $nilai_kriteria; // Menambahkan nilai ke total nilai
									}
								}
								?>
							</td>										
							<?php endforeach; ?>
							<!-- Baris baru untuk menampilkan total nilai -->							
							<td ><?php
							if ($total_nilai == 0) {
								echo ""; // Menampilkan string kosong jika total nilai adalah 0
							} else {
								echo $total_nilai; // Menampilkan total nilai
							}
							?></td>	
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
} else {
    header('Location: login.php');
}
?>
