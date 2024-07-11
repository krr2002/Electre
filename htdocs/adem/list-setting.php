<?php
require_once('includes/init.php'); 
$user_role = get_role();
if($user_role == 'admin' ) {
?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

// Definisikan path untuk menyimpan gambar yang diunggah
$target_dir = "assets/img/";

$id_instansi = $pengaturan['id'];

if($id_instansi == 0) { 
$errors[] = 'Data Instansi tidak ada'; }			

if (isset($_POST['submit'])):
    $id = $_POST['id'];
    $instansi = $_POST['instansi'];
    $instansi_2 = $_POST['instansi_2'];
    $instansi_3 = $_POST['instansi_3'];
    $alamat = $_POST['alamat'];
    $kab = $_POST['kab'];
    $prov = $_POST['prov'];
    $pimpinan = $_POST['pimpinan'];
    $nip = $_POST['nip'];
    $periode_aktif = $_POST['periode_aktif'];

    $errors = [];

    if (!$instansi) {
        $errors[] = 'Instansi tidak boleh kosong';
    }

    if (!$alamat) {
        $errors[] = 'Alamat tidak boleh kosong';
    }

    if (!$pimpinan) {
        $errors[] = 'Pimpinan tidak boleh kosong';
    }
 
    
    if (empty($errors)):	
        if ($id_instansi == 0) {
            $insert = mysqli_query($koneksi, "INSERT INTO pengaturan (instansi, instansi_2, instansi_3, alamat, kab, prov, pimpinan, nip, periode_aktif) VALUES ('$instansi', '$instansi_2', '$instansi_3', '$alamat', '$kab', '$prov', '$pimpinan', '$nip', '$periode_aktif')");
            if ($insert) {
                $sukses = 'Data berhasil disimpan';
            } else {
                $errors[] = 'Data gagal disimpan';
            }
        } else {
            $update = mysqli_query($koneksi, "UPDATE pengaturan SET 
                instansi = '$instansi', 
                instansi_2 = '$instansi_2', 
                instansi_3 = '$instansi_3',
                alamat = '$alamat', 
                kab = '$kab', 
                prov = '$prov', 
                pimpinan = '$pimpinan', 
                nip = '$nip', 
                periode_aktif = '$periode_aktif'
                WHERE id = '$id'");
            if ($update) {
                $sukses = 'Data berhasil diupdate';
            } else {
                $errors[] = 'Data gagal diupdate';
            }
        }
    endif;

endif;

function resizeImage($file, $max_resolution) {
    if (file_exists($file)) {
        $original_image = imagecreatefrompng($file);

        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        if ($original_width > $original_height) {
            $ratio = $max_resolution / $original_width;
            $new_width = $max_resolution;
            $new_height = $original_height * $ratio;
        } else {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
        }

        if ($original_image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            imagepng($new_image, $file);

            imagedestroy($original_image);
            imagedestroy($new_image);
        }
    }
}

if (isset($_FILES['logo1'])) {
    if ($_FILES['logo1']['type'] == 'image/png') {
        $target_file = $target_dir . 'p1.png';
        if (move_uploaded_file($_FILES['logo1']['tmp_name'], $target_file)) {
            resizeImage($target_file, 1024);
            $sukses = 'Logo 1 berhasil diunggah';
        } else {
            $errors[] = 'Logo 1 gagal diunggah';
        }
    } else {
        $errors[] = 'Hanya file PNG yang diperbolehkan untuk Logo 1';
    }
}

if (isset($_FILES['logo2'])) {
    if ($_FILES['logo2']['type'] == 'image/png') {
        $target_file = $target_dir . 'p2.png';
        if (move_uploaded_file($_FILES['logo2']['tmp_name'], $target_file)) {
            resizeImage($target_file, 1024);
            $sukses = 'Logo 2 berhasil diunggah';
        } else {
            $errors[] = 'Logo 2 gagal diunggah';
        }
    } else {
        $errors[] = 'Hanya file PNG yang diperbolehkan untuk Logo 2';
    }
}
?>

<?php
$page = "Setting";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user"></i> Pengaturan Aplikasi</h1>
</div>

<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach($errors as $error): ?>
            <?php echo $error; ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if($sukses): ?>
    <div class="alert alert-success">
        <?php echo $sukses; ?>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Pengaturan</h6>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <div class="row">        
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Instansi</label>
                    <input autocomplete="off" type="text" name="instansi" required value="<?php echo $pengaturan['instansi']; ?>" class="form-control"/>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Instansi 2</label>
                    <input autocomplete="off" type="text" name="instansi_2" required value="<?php echo $pengaturan['instansi_2']; ?>" class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Instansi 3</label>
                    <input autocomplete="off" type="text" name="instansi_3" required value="<?php echo $pengaturan['instansi_3']; ?>" class="form-control"/>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Alamat</label>
                    <input autocomplete="off" type="text" name="alamat" required value="<?php echo $pengaturan['alamat']; ?>" class="form-control"/>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Kabupaten</label>
                    <input autocomplete="off" type="text" name="kab" required value="<?php echo $pengaturan['kab']; ?>" class="form-control"/>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Provinsi</label>
                    <input autocomplete="off" type="text" name="prov" required value="<?php echo $pengaturan['prov']; ?>" class="form-control"/>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Pimpinan</label>
                    <input autocomplete="off" type="text" name="pimpinan" required value="<?php echo $pengaturan['pimpinan']; ?>" class="form-control"/>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">NIP</label>
                    <input autocomplete="off" type="text" name="nip" required value="<?php echo $pengaturan['nip']; ?>" class="form-control"/>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Periode Aktif</label>
                    <input autocomplete="off" type="number" name="periode_aktif" required value="<?php echo $pengaturan['periode_aktif']; ?>" class="form-control"/>
                </div>
                <div class="form-group col-md-6">                    
                    <input autocomplete="off" type="hidden" name="id" required readonly value="<?php echo $pengaturan['id']; ?>" class="form-control"/>
                </div>
            </div>
            
            <div class="card-footer text-right">
                <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
            </div>            
        </div>    
    </form>
    <div class="card-body">
        <div class="row">    
            <!-- Form untuk mengunggah logo1 -->
            <form id="form-logo1" action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Ganti Logo 1</label><br>
                    <img src="assets/img/p1.png" alt="Logo 1" style="max-width: 200px;"><br><br>
                    <input type="file" name="logo1" accept="image/png" onchange="document.getElementById('form-logo1').submit()">
                </div>
            </form>

            <!-- Form untuk mengunggah logo2 -->
            <form id="form-logo2" action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Ganti Logo 2</label><br>
                    <img src="assets/img/p2.png" alt="Logo 2" style="max-width: 200px;"><br><br>
                    <input type="file" name="logo2" accept="image/png" onchange="document.getElementById('form-logo2').submit()">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

// Set custom validation message for minlength
document.getElementById('periode').addEventListener('invalid', function() {
    this.setCustomValidity('Panjang minimal 4 angka');
});

document.getElementById('periode').addEventListener('input', function() {
    this.setCustomValidity('');
});

</script>

<?php
require_once('template/footer.php');
}else {
    header('Location: login.php');
}
?>
