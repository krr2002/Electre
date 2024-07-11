<?php require_once('includes/init.php'); ?>

<?php
$errors = array();
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['username']) ? trim($_POST['password']) : '';

if(isset($_POST['submit'])):
	
	// Validasi
	if(!$username) {
		$errors[] = 'Username tidak boleh kosong';
	}
	if(!$password) {
		$errors[] = 'Password tidak boleh kosong';
	}
	
	if(empty($errors)):
		$query = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'");
		$cek = mysqli_num_rows($query);
		$data = mysqli_fetch_array($query);
		
		if($cek > 0){
			$hashed_password = sha1($password);
			if($data['password'] === $hashed_password) {
				$_SESSION["user_id"] = $data["id_user"];
				$_SESSION["username"] = $data["username"];
				$_SESSION["role"] = $data["role"];				
				$_SESSION["nama"] = $data["nama"];	
				redirect_to("dashboard.php");
			} else {
				$errors[] = 'Username atau password salah!';
			}
		} else {
			$errors[] = 'Username atau password salah!';
		}
		
	endif;

endif;	
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>SPK ADEM Metode ELECTRE</title>

        <!-- Custom fonts for this template-->
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
		<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    </head>

    <body class="bg-gradient-primary">
	    <style>
		.accordion {
		  background-color: #eee;
		  color: #444;
		  cursor: pointer;
		  padding: 14px;
		  width: 100%;
		  border: none;
		  text-align: left;
		  outline: none;
		  font-size: 17px;
		  transition: 0.4s;
		}

		.activee, .accordion:hover {
		  background-color: #ccc;
		}

		.panel {
		  padding: 0 18px;
		  background-color: white;
		  max-height: 0;
		  overflow: hidden;
		  transition: max-height 0.2s ease-out;
		}
		</style>
		<nav class="navbar navbar-expand-lg navbar-dark bg-white shadow-lg pb-3 pt-3 font-weight-bold">
            <div class="container">
                <a class="navbar-brand text-primary" style="font-weight: 900;" href="login.php"> <i class="fa fa-database mr-2 rotate-n-15"></i> SPK ADEM Metode ELECTRE</a>
            </div>
        </nav>

        <div class="container">
            <!-- Outer Row -->
            <div class="row d-plex justify-content-between mt-5">				
				<div class="col-xl-7 col-lg-7 col-md-6 mt-5">
                    <div class="card bg-none o-hidden border-0 my-5 text-white" style="background: none;">
                        <div class="text-justify card-body p-0">
                            <h4 style="font-weight: 800;">Sistem Pendukung Keputusan (SPK) ADEM Metode ELECTRE</h4>
							<h5 data-aos="fade-up" class="pt-4" >Sistem Pengambilan Keputusan Untuk Menentukan Penerima Beasiswa <strong>Afirmasi Pendidikan Menengah</strong> (ADEM) Menggunakan Metode Elimination and Choice Translation eality (Electre).</h5>
                            <p class="pt-4">
                                Metode Electre merupakan salah satu metode pengambilan keputusan multikriteria berdasarkan pada konsep outranking dengan menggunakan perbandingan berpasangan dari alternatif - alternatif berdasarkan setiap kriteria yang sesuai dengan kriteria dieliminasi, dan alternatif yang sesuai dapat dihasilkan.
                            </p>
							<h4 style="font-weight: 800;"><b>Tahapan</b></h4>
                            <p class="pt-4">
                                Terdapat 7 tahap dalam pengambilan keputusan menggunakan metode Electre, antara lain:
							</p>
								<button class="accordion">1. Normalisasi matriks keputusan</button>
								<div class="panel">
								  <p><img src="assets/img/tahap1.jpeg" ></p>
								</div>
								<button class="accordion">2. Pembobotan pada matriks yang telah dinormalisasi</button>
								<div class="panel">
								  <p><img src="assets/img/tahap2.jpeg"   ></p>
								</div>
								<button class="accordion">3. Penentuan himpunan Concordance dan Discordance</button>
								<div class="panel">
								  <p><img src="assets/img/tahap3.jpeg" ></p>
								</div>
								<button class="accordion">4. Hitung matriks Concordance dan Discordance</button>
								<div class="panel">
								  <p><img src="assets/img/tahap4.jpeg" ></p>
								</div>
								<button class="accordion">5. Penentuan matriks dominan Concordance dan Discordance</button>
								<div class="panel">
								  <p><img src="assets/img/tahap5.jpeg" ></p>
								</div>
								<button class="accordion">6. Menentukan aggregate dominance matrix</button>
								<div class="panel">
								  <p><img src="assets/img/tahap6.jpeg" ></p>
								</div>
								<button class="accordion">7. Eliminasi alternatif yang less favourable</button>
								<div class="panel">
								  <p><img src="assets/img/tahap7.jpeg" ></p>
								</div>
                            
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-5 col-lg-5 col-md-5 mt-5">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Login Account</h1>
                                        </div>
										<?php if(!empty($errors)): ?>
											<?php foreach($errors as $error): ?>
												<div class="alert alert-danger text-center"><?php echo $error; ?></div>
											<?php endforeach; ?>
										<?php endif; ?>	

                                        <form class="user" action="login.php" method="post">
                                            <div class="form-group">
                                                <input required autocomplete="off" type="text" value="<?php echo htmlentities($username); ?>" class="form-control form-control-user" id="exampleInputUser" placeholder="Username" name="username" />
                                            </div>
                                            <div class="form-group">
                                                <input required autocomplete="off" type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" />
                                            </div>
                                            <button name="submit" type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-fw fa-sign-in-alt mr-1"></i> Masuk</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>
		<script>
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
		  acc[i].addEventListener("click", function() {
			this.classList.toggle("activee");
			var panel = this.nextElementSibling;
			if (panel.style.maxHeight) {
			  panel.style.maxHeight = null;
			} else {
			  panel.style.maxHeight = panel.scrollHeight + "px";
			} 
		  });
		}
		</script>
    </body>
</html>
