<?php require_once('includes/init.php'); 
$user_role = get_role();
if($user_role == 'admin') {
$errors = array();
$sukses = false;

$id_kriteria = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(isset($_POST['submit'])){
	$nama = $_POST['nama'];
	$bobot = $_POST['bobot'];
	$info = $_POST['info'];
	
	// Validasi Nama Kriteria
	if(!$nama) {
		$errors[] = 'Nama kriteria tidak boleh kosong';
	}
	// Validasi Bobot
	if(!$bobot) {
		$errors[] = 'Bobot kriteria tidak boleh kosong';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)){
		
		$update = mysqli_query($koneksi,"UPDATE kriteria SET nama = '$nama', bobot = '$bobot' , info = '$info' WHERE id_kriteria = '$id_kriteria'");
		
		if($update) {
			redirect_to('list-kriteria.php?status=sukses-edit');
		}else{
			$errors[] = 'Data gagal diupdate';
		}
	}
}

$page = "Kriteria";
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>

	<a href="list-kriteria.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<?php if(!empty($errors)): ?>
	<div class="alert alert-danger">
		<?php foreach($errors as $error): ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>	
<?php endif; ?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Kriteria</h6>
    </div>
	
	<form action="edit-kriteria.php?id=<?php echo $id_kriteria; ?>" method="post">
		<?php
		if(!$id_kriteria) {
		?>
		<div class="card-body">
			<div class="alert alert-danger">Data tidak ada</div>
		</div>
		<?php
		}else{
		$data = mysqli_query($koneksi,"SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'");
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
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Kode Kriteria</label>
					<input autocomplete="off" type="text" disabled value="<?php echo $d['id_kriteria']; ?>" class="form-control"/>
				</div>
				
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Nama Kriteria</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $d['nama']; ?>" class="form-control"/>
				</div>
				
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Bobot Kriteria</label>
					<input autocomplete="off" type="number" name="bobot" required value="<?php echo $d['bobot']; ?>" step="0.001" class="form-control"/>
				</div>
				
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Nama Kriteria</label>
					<input autocomplete="off" type="text" name="info"  value="<?php echo $d['info']; ?>" class="form-control"/>
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
	</form>
</div>

<?php
require_once('template/footer.php');
}else {
	header('Location: login.php');
}
?>