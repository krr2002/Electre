<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id_alternatif = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(isset($_POST['submit'])):	
	
	$nama = $_POST['nama'];
	$nisn = $_POST['nisn'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	
	// Validasi
	if(!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	if(!$nisn) {
		$errors[] = 'NISN tidak boleh kosong';
	}
	if(!$tempat_lahir) {
		$errors[] = 'Tempat lahir tidak boleh kosong';
	}
	if(!$tanggal_lahir) {
		$errors[] = 'Tanggal Lahir tidak boleh kosong';
	}
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$update = mysqli_query($koneksi,"UPDATE alternatif SET nama = '$nama' , nisn = '$nisn' , tempat_lahir = '$tempat_lahir' , tempat_lahir = '$tempat_lahir' , tanggal_lahir = '$tanggal_lahir' WHERE id_alternatif = '$id_alternatif'");
		if($update) {
			redirect_to('list-alternatif.php?status=sukses-edit');
		}else{
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
$page = "Alternatif";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Alternatif</h1>

	<a href="list-alternatif.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>
			
<?php if(!empty($errors)): ?>
	<div class="alert alert-info">
		<?php foreach($errors as $error): ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if($sukses): ?>
	<div class="alert alert-success">
		Data berhasil disimpan
	</div>	
<?php elseif($ada_error): ?>
	<div class="alert alert-info">
		<?php echo $ada_error; ?>
	</div>
<?php else: ?>		
			
<form action="edit-alternatif.php?id=<?php echo $id_alternatif; ?>" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Alternatif</h6>
		</div>
		<?php
		if(!$id_alternatif) {
		?>
		<div class="card-body">
			<div class="alert alert-danger">Data tidak ada</div>
		</div>
		<?php
		}else{
		$data = mysqli_query($koneksi,"SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif'");
		$cek = mysqli_num_rows($data);
		if($cek <= 0) {
		?>
		<div class="card-body">
			<div class="alert alert-danger">Data tidak ada</div>
		</div>
		<?php
		}else{
			while($d = mysqli_fetch_array($data)){
		?>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $d['nama']; ?>" class="form-control"/>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">NISN</label>
					<input autocomplete="off" type="text" name="nisn" required value="<?php echo $d['nisn']; ?>"  maxlength="10" pattern=".{10,}"  id="nisn" onkeypress="validate(event)" onpaste="validate(event)"  class="form-control"/>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Tempat Lahir</label>
					<input autocomplete="off" type="text" name="tempat_lahir" required value="<?php echo $d['tempat_lahir']; ?>" class="form-control"/>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Tanggal Lahir</label>
					<input autocomplete="off" type="date" name="tanggal_lahir" required value="<?php echo $d['tanggal_lahir']; ?>" class="form-control"/>
				</div>
			</div>
		</div>
	
		<div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
		<?php
		}
		}
		}
		?>
	</div>
</form>

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
document.getElementById('nisn').addEventListener('invalid', function() {
    this.setCustomValidity('Panjang minimal 10 angka');
});

document.getElementById('nisn').addEventListener('input', function() {
    this.setCustomValidity('');
});
</script>

<?php
endif;
require_once('template/footer.php');
?>