<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SPK ADEM - <?php echo $pengaturan['instansi']; ?> - <?php echo $page ?></title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

<!-- kop surat -->
    <style>
        .kop {
            margin-top: 30px;
        }

        .kop h6 {
            text-align: center;
            color: black;
            font-size: 20px;
            line-height: 1;
            margin: 1px;
        }

        .kop-surat {
            width: 100%;
            padding-bottom: 0.1px;
            margin-bottom: 1px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
            position: relative;
            color: black;
        }

        .kop-surat img {
            max-width: 100px;
            height: auto;
            margin: 0px;
            flex-shrink: 0;
            margin-bottom: 4px;
        }

        .kop-surat .center-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            text-align: center;
            flex-grow: 1;
            margin: 0 10px;
            padding-bottom: 10px;
        }

        .kop-surat h5,
        .kop-surat p {
            margin: 4px 0;
        }

        .kop-surat::before,
        .kop-surat::after {
            content: "";
            display: block;
            position: absolute;
            left: 0;
            right: 0;
        }

        .kop-surat::before {
            top: 100%;
            border-top: 1px solid #000;
        }

        .kop-surat::after {
            top: calc(100% + 2px);
            border-top: 3px solid #000;
        }

        @media (max-width: 1000px) {
            .kop-surat .center-content {
                margin: 0 10px;
                padding-bottom: 1px;
                color: black;
            }

            .kop-surat img {
                max-width: 100px;
                margin: 0px;
            }

            .kop-surat .center-content h5 {
                font-size: 20px;
            }

            .kop-surat .center-content p {
                font-size: 15px;
            }
        }

        @media (max-width: 850px) {
            .kop {
                margin-top: 30px;
            }

            .kop h6 {
                text-align: center;
                color: black;
                font-size: 10px;
                line-height: 1;
                margin: 1px;
            }

            .kop-surat .center-content {
                margin: 0 10px;
                color: black;
            }

            .kop-surat img {
                max-width: 100px;
                margin: 0px;
                margin-bottom: 4px;
            }

            .kop-surat .center-content h5 {
                font-size: 20px;
            }

            .kop-surat .center-content p {
                font-size: 10px;
            }
        }

        .signature-section {
            width: 100%;
            margin-top: 50px;
            padding-right: 40px;
            text-align: right;
            color: black;
        }

        .signature-section p {
            margin: 1px 0;
        }

        .signature {
            display: inline-block;
            text-align: left;
            margin-top: 5px;
            margin-bottom: 50px;
        }

        .signature h5 {
            margin: 0;
            font-size: 16px;
            font-weight: normal;
        }

        .signature p {
            margin: 2px 0;
            font-size: 14px;
        }

        .signature .name {
            text-decoration: underline;
        }

        @media (max-width: 1000px) {
            .signature h5 {
                margin: 0;
                font-size: 12px;
                font-weight: normal;
            }

            .signature p {
                margin: 2px 0;
                font-size: 10px;
            }
        }

    @media print {
      @page {
        size: auto;
        margin: 10mm;
        /* size: portrait; /* Use portrait or landscape */ 
      }
    }
  </style>
  
   <!-- Custom CSS to overwrite sb-admin styles -->
    <style>	
        thead.bg-primary.text-black {
            background-color: #808080 !important; /* abu-abu */
            color: #000000 !important; /* hitam */
        }

        thead.bg-primary.text-black th {
            border: 1px solid #000000 !important; /* hitam */
            color: #000000 !important; /* hitam */
        }

         tbody tr {
            background-color: #FFFFFF !important; /* putih */
			font-size: 12px;
        }

        tbody tr td {
            border: 1px solid #000000 !important; /* hitam */
            color: #000000 !important; /* hitam */
			font-size: 12px;
        }

        /* Ensure table borders are black */
        table.dataTable {
			border: 1px solid #000000 !important; /* hitam */
            color: #000000 !important; /* hitam */
			font-size: 12px;
        }
    </style>

</head>
<body onload="window.print();" id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
   
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">		
        <div class="container-fluid">		
            <div class="card-body">
            <!-- /.card-header -->
            <!-- kop surat -->  
            <div class="kop-surat">
              <div class="left-image">
                <img src="assets/img/p1.png" alt="Left Image">
              </div>
              <div class="center-content">
                <h5><?php echo $pengaturan['instansi_2']; ?></h5>
                <h5><?php echo $pengaturan['instansi_3']; ?></h5>
                <h4><b><?php echo $pengaturan['instansi']; ?></b></h4>
                <p><?php echo $pengaturan['alamat']; ?></p>
              </div>
              <div class="right-image">
                <img src="assets/img/p2.png" alt="Right Image">
              </div>
            </div>
            <div class="kop"></div>
        
     
      
   