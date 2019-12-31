<?php require 'koneksi.php' ?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Konfirmasi Pembayaran</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div> -->
    <!--*******************
        Preloader end
    ********************-->
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-9">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                
                            <?php
                                // include 'koneksi.php';
                                $st = $_GET['id'];
                                $tr= $_GET['ID_TRANSAKSI'];
                                $sql2 = mysqli_query($connect ,"SELECT NAMA_PELANGGAN, NAMA_BANK, TANGGAL_TRANSAKSI 
                                FROM transaksi A JOIN pelanggan B ON A.ID_PELANGGAN=B.ID_PELANGGAN JOIN bank C ON A.ID_BANK=C.ID_BANK WHERE B.ID_PELANGGAN='$st' and A.ID_TRANSAKSI='$tr'");
                                
                                while($data = mysqli_fetch_array($sql2)){
                            ?>

                                    <a class="text-center"> <h4>Konfirmasi Pembayaran</h4></a>
                                    <form action="#" method="POST" class="mt-5 mb-5 login-input" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">ID Transaksi</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $tr;?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $data['NAMA_PELANGGAN'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Bank</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $data['NAMA_BANK'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Waktu Transaksi</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="">
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="foto">
                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Upload Bukti Pembayaran</label>                                            
                                    </div>
                                    <!-- <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Lapangan</th>
                                                <th>Nama Lapangan</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        // include 'koneksi.php';
                                        // $no = 1;
                                        // $data = mysqli_query($connect,"select * from lapangan");
                                        // while($d = mysqli_fetch_array($data)){
                                        //     ?>
                                        //     <tr>
                                        //         <td><?php echo $no++; ?></td>
                                        //         <td><?php echo $d['ID_LAPANGAN']; ?></td>
                                        //         <td><?php echo $d['NAMA_LAPANGAN']; ?></td>
                                        //         <td><?php echo $d['HARGA_SEWA']; ?></td>
                                            </tr>
                                            <?php 
                                        //}
                                        ?>
                                        </tbody> -->
                                </form>
                                
                                <button class="btn login-form__btn submit w-100" name="konfirmasi">Konfirmasi</button>

                                <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                    
    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>