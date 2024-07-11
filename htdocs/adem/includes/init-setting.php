<?php

// Deklarasi variabel untuk menampung data pengaturan
$pengaturan = [
    'id' => '',
    'instansi' => '',
    'instansi_2' => '',
	'instansi_3' => '',
    'alamat' => '',
    'kab' => '',
    'prov' => '',
    'pimpinan' => '',
    'nip' => '',
    'periode_aktif' => ''
];

// Query untuk mengambil satu data dari tabel pengaturan
$query = "SELECT * FROM pengaturan ORDER BY id ASC LIMIT 1";
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dan data tersedia
if ($result && mysqli_num_rows($result) > 0) {
    $pengaturan = mysqli_fetch_assoc($result);
} else {
    // Data dummy jika tabel pengaturan kosong
    $pengaturan = [
        'id' => 0,
        'instansi' => 'Instansi Dummy',
        'instansi_2' => 'Instansi 2 Dummy',
		'instansi_3' => 'Instansi 3 Dummy',
        'alamat' => 'Alamat Dummy',
        'kab' => 'Kabupaten Dummy',
        'prov' => 'Provinsi Dummy',
        'pimpinan' => 'Pimpinan Dummy',
        'nip' => 'NIP Dummy',
        'periode_aktif' => date('Y')
    ];
    $data_kosong = true;
}

// Menutup koneksi
// mysqli_close($koneksi);


