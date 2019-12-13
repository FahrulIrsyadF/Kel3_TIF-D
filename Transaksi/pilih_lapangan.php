<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Rush Badminton</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap File -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- JQuery -->
  <link href="jquery-ui-1.11.4/smoothness/jquery-ui.css" rel="stylesheet" />
  <script src="jquery-ui-1.11.4/external/jquery/jquery.js"></script>
  <script src="jquery-ui-1.11.4/jquery-ui.js"></script>
  <script src="jquery-ui-1.11.4/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="jquery-ui-1.11.4/jquery-ui.theme.css">

  <!-- INDONESIA -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/id.js"></script>

      
  <script>
   $(document).ready(function(){
    var date = new Date();
    $('#tanggal').datepicker('setDate', date);
	   $("#tanggal").datepicker({
      dateFormat: "yy/mm/dd",
      enableOnReadonly: true,
      language: 'id',
      locale: 'id',
	   })
   })
  </script>

      <?php include "koneksi.php"; ?>
</head>

<body>
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
            <li><a href="../Rush Home/index.html"><strong>Halaman Utama</a></li>
          <li><a href="#">Pesananku</a></li>
        </ul>
    </div>
  </header><!-- #header -->

  <div class="modal-body">
        <form  method="post" enctype="multipart/form-data"> 
            <div class="row">
            <div class="form-group col col-md-6 ml-auto">
                <label class="col-form-label">Pilih Tanggal</label>
                  <input type="text" id="tanggal" class="form-control" name='date' id='date' selected='selected'>
            </div>
            <div class="form-group col col-md-6 ml-auto">
                <label class="col-form-label">Pilih Lapangan</label>
                <select name="nim" id="nim" class="form-control input-defaut" onchange="changeValue(this.value)">
              <option value="">-Pilih Lapangan-</option>

              <!-- <?php
                  $result = mysqli_query($connect, "select NAMA_LAPANGAN from lapangan");   
                  while ($row = mysqli_fetch_array($result)) {   
                      echo '<option value="' . $row['NAMA_LAPANGAN'] .'" >' . $row['NAMA_LAPANGAN'].'</option>';
                  }?> -->

                  <?php
                  $result = mysqli_query($connect, "select NAMA_LAPANGAN from lapangan");   
                  while ($options = mysqli_fetch_assoc($result)) {   
                    foreach ($options as $area) {
                      $selected = @$_POST['nim'] == $area ? ' selected="selected"' : '';
                      echo '<option value="' . $area . '"' . $selected . '>' . $area . '</option>';
                  }}?>


                  </select>
            </div>
            </div>
</div>

<div class="modal-footer ">
        <button name="cari" class="btn btn-info">Cari</button>
</div>

        
        <?php
        if (isset($_POST['cari'])){
          $lap = $_POST['nim']; 
          $tgl = $_POST['date']; 
          ?>
  <div class="modal-body">
  <div class="row">
  <div class="col">
              <?php
              $query = "Select * from lapangan where NAMA_LAPANGAN='".$lap."'";
              $sql = mysqli_query($connect, $query);
              while($data = mysqli_fetch_array($sql)){
              ?>
              <img alt="" class="" width="600" src="img/lapangan/<?php echo $data['FOTO_LAPANGAN']; ?>">
              <?php } ?>
  </div>
  <div class="col"> 
            <label class="col-form-label">Pilih Jam :</label><br>

            <form method='post' name="letter" >
            <div class="container2">
            <ul class="ks-cboxtags">
<!-- -----Checkbox----- -->
            <!-- Checkbox1 -->
            <?php
              $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN , B.STATUS 
            FROM detail_jadwal A LEFT JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = 
            B.ID_DETAIL_JADWAL JOIN lapangan C on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE 
            C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0001' && B.TANGGAL_PESANAN='$tgl'");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0001'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                            <li class='opacity5'><input type="checkbox" id="jam1"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                            <label for="jam1"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                            <li ><input type="checkbox" id="jam1" value="<?php echo $data['JAM']; ?>">
                            <label for="jam1"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox2 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS  
            FROM detail_jadwal A LEFT JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = 
            B.ID_DETAIL_JADWAL JOIN lapangan C on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE 
            C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0002' && B.TANGGAL_PESANAN='$tgl'");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0002'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                            <li class='opacity5'><input type="checkbox" id="jam2"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                            <label for="jam2"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                            <li ><input type="checkbox" id="jam2" value="<?php echo $data['JAM']; ?>">
                            <label for="jam2"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox3 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS  
            FROM detail_jadwal A LEFT JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = 
            B.ID_DETAIL_JADWAL JOIN lapangan C on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE 
            C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0003' && B.TANGGAL_PESANAN='$tgl'");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0003'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                <li class='opacity5'><input type="checkbox" id="jam3"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                              <label for="jam3"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam3" value="<?php echo $data['JAM']; ?>">
                                <label for="jam3"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
                      <!-- Checkbox4 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0004' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0004'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam4"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam4"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam4" value="<?php echo $data['JAM']; ?>">
                                <label for="jam4"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox5 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0005' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0005'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam5"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam5"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam5" value="<?php echo $data['JAM']; ?>">
                                <label for="jam5"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
                      <!-- Checkbox6 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0006' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0006'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam6"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam6"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam6" value="<?php echo $data['JAM']; ?>">
                                <label for="jam6"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox7 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0007' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0007'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam7"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam7"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam7" value="<?php echo $data['JAM']; ?>">
                                <label for="jam7"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox8 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0008' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0008'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam8"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam8"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam8" value="<?php echo $data['JAM']; ?>">
                                <label for="jam8"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox9 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0009' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0009'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam9"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam9"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam9" value="<?php echo $data['JAM']; ?>">
                                <label for="jam9"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox10 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0010' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0010'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam10"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam10"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam10" value="<?php echo $data['JAM']; ?>">
                                <label for="jam10"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox11 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0011' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0011'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam11"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam11"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam11" value="<?php echo $data['JAM']; ?>">
                                <label for="jam11"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox12 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0012' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0012'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam12"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam12"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam12" value="<?php echo $data['JAM']; ?>">
                                <label for="jam12"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox13 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0013' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0013'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam13"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam13"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam13" value="<?php echo $data['JAM']; ?>">
                                <label for="jam13"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox14 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0014' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0014'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam14"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam14"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam14" value="<?php echo $data['JAM']; ?>">
                                <label for="jam14"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
            <!-- Checkbox15 -->
            <?php
            $st= 0;
            $sql1= mysqli_query($connect, "SELECT A.ID_DETAIL_JADWAL, A.ID_JAM, B.TANGGAL_PESANAN, C.NAMA_LAPANGAN, B.STATUS 
            FROM detail_jadwal A JOIN tanggal_pesanan B on A.ID_DETAIL_JADWAL = B.ID_DETAIL_JADWAL JOIN lapangan C 
            on A.ID_LAPANGAN=C.ID_LAPANGAN WHERE C.NAMA_LAPANGAN='$lap'&& A.ID_JAM='JM0015' && B.TANGGAL_PESANAN='$tgl' ");

            while($data = mysqli_fetch_assoc($sql1)){
              $st= $data['STATUS'];
            } ?>
                      <?php 
                      $sql = mysqli_query($connect, "SELECT JAM FROM jam WHERE ID_JAM='JM0015'");
                        if($st==1){
                          while($data = mysqli_fetch_assoc($sql)){ ?>
                                
                                <li class='opacity5'><input type="checkbox" id="jam15"  value="<?php echo $data['JAM']; ?>"  disabled = true >
                                <label for="jam15"><?php echo $data['JAM']; ?></label></li>
                        <?php }} else {
                          while($data = mysqli_fetch_assoc($sql)){?>
                                <li ><input type="checkbox" id="jam15" value="<?php echo $data['JAM']; ?>">
                                <label for="jam15"><?php echo $data['JAM']; ?></label></li>
                        <?php }}
                      ?>
<!-- -----Checkbox----- -->

            </ul>
                    <div class="modal-footer ">
                    <a href="pilih_lapangan.php"> <button name="cari" class="btn btn-info" >Pesan</button></a>
                      
                    </div>
            </div>
            </form>

   </div>
  </div>
</div>
<?php } ?>

<?php
  if(isset($_POST['simpan'])){
    $jam2 = $_POST['jam2'] ?>

 <?php } ?>

</body>
</html>