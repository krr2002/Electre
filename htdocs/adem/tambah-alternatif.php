<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
$nisn = (isset($_POST['nisn'])) ? trim($_POST['nisn']) : '';
$tempat_lahir = (isset($_POST['tempat_lahir'])) ? trim($_POST['tempat_lahir']) : '';
$tanggal_lahir = (isset($_POST['tanggal_lahir'])) ? trim($_POST['tanggal_lahir']) : '';

if(isset($_POST['submit'])):	
	
	// Validasi
	if(!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		$simpan = mysqli_query($koneksi,"INSERT INTO alternatif (id_alternatif, nama, nisn, tempat_lahir, tanggal_lahir, periode) VALUES ('', '$nama' , '$nisn' , '$tempat_lahir' , '$tanggal_lahir', '$periode_aktif')");
		if($simpan) {
			redirect_to('list-alternatif.php?status=sukses-baru');
		}else{
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

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
			
<form action="tambah-alternatif.php" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-plus"></i> Tambah Data Alternatif</h6>
		</div>
		<div class="card-body">
			<div class="row">				
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $nama; ?>" class="form-control"/>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">NISN</label>
					<input autocomplete="off" type="text" name="nisn" required value="<?php echo $nisn; ?>" maxlength="10" onkeypress="validate(event)" class="form-control"/>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Tempat Lahir</label>
					<input autocomplete="off" type="text" name="tempat_lahir" required value="<?php echo $tempat_lahir; ?>" class="form-control"/>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Tanggal Lahir</label>
					<input autocomplete="off" type="date" name="tanggal_lahir" required value="<?php echo $tanggal_lahir; ?>" class="form-control"/>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
	</div>
</form>

<script>function validate(evt) {
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
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}</script>

<?php
require_once('template/footer.php');
?>