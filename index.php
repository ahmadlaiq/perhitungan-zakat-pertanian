<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Zakat Pertanian</title>
  </head>
  <body>
  <nav class="navbar navbar-light bg-dark" >
  <div class="container-fluid">
    <span class="navbar-text text-white text-uppercase">
      Apilasi Perhitungan Zakat Pertanian
    </span>
  </div>
</nav>

<div class="container">
  <form action="index.php" method="post">
  <div class="row">
    <div class="col-md-12 mt-3"> 
    <div class="form-group">
        <label for="hasil_tani">Hasil Pertanian :</label>
        <div class="inpt selectContainer">
            <select class="form-control" name="tani" onchange="run();">
                <option value="">Pilih Hasil Pertanian</option>
                <option value="gabah">Gabah</option>
                <option value="beras">Beras</option>
                <option value="beras">Makanan pokok lain</option>
                <option value="lain">Buah</option>
                <option value="lain">Sayur</option>
            </select>
        </div>
      </div>
      <div class="col-md-12 mt-3">
      <div class="form-group">
        <label for="air">Jenis Pengairan :</label>
        <div class="inpt selectContainer">
            <select id="air" class="form-control" name="air">
                <option value="">Pilih Cara Pengairan</option>
                <option value="disiram">Dengan Biaya</option>
                <option value="alam">Dengan Alami (Air Hujan, Sungai, dll)</option>
            </select>
        </div>
      </div>
      </div>
      <div class="col-md-12 mt-3">
      <div class="form-group">
        <label for="jumlah">Jumlah hasil panen :</label>
        <div class="inpt input-group">
          <input type="number" class="form-control" id="jumlah" name="jumlah" aria-describedby="jumlah">
          <span class="input-group-addon" id="jumlah">Kg</span>
        </div>
      </div>
    </div>
    </div>
    <div class="row-md-12 mt-3">
      <div class="form-group">
        <label for="harga_lain">Harga hasil panen anda :</label>
        <div class="inpt input-group">
            <span class="input-group-addon">Rp. </span>
            <input type="number" class="inpt form-control" id="harga_lain" name="harga_lain">
            <span class="input-group-addon">/Kg</span>
        </div>
      </div>
      </div>
      <div class="col-md-12 mt-3">
      <div class="form-group">
        <label for="harga">Harga makanan pokok saat ini :</label>
        <div class="inpt input-group">
         <span class="input-group-addon">Rp. </span>
          <input type="number" class="inpt form-control" id="harga" name="harga">
          <span class="input-group-addon">/Kg</span>
        </div>
      </div>
    </div>
  </div>
    
    <div class="row-md-6 mt-3 mb-4" align="center">
    <div class="hit form-group">
    <input type="submit" class="btn_ btn btn-primary" name="hitung" value="Hitung">
    </div>
    </div>
</form>
</div>

<?php
  error_reporting(0);

  $tani = $_POST[tani];
  $air = $_POST[air];
  $jumlah = $_POST[jumlah];
  $harga = $_POST[harga];
  $harga_lain = $_POST[harga_lain];

  if (empty($tani) && empty($air)) {
      $ket = "<div class='alert alert-danger'>Mohon pilih <b>jenis hasil tani dan cara pengairan</b> !! </div>";
    } 
      elseif (empty($air)) {
          $ket = "<div class='alert alert-danger'>Mohon pilih <b>jenis cara pengairan</b> !! </div>";
      }
      elseif (empty($tani)) {
          $ket = "<div class='alert alert-danger'>Mohon pilih <b>jenis hasil tani</b> !! </div>";
      }
      elseif (empty($jumlah) || empty($harga) ) {
          $ket = "<div class='alert alert-danger'>Jumlah hasil panen dan harga makanan pokok <b>Tidak boleh kosong</b> !!</div>";
      }
      elseif ($tani == "lain" && empty($harga_lain) ) {
          $ket = "<div class='alert alert-danger'>Harga hasil panen <b>Tidak boleh kosong</b> !!</div>";
      }
    else{
          if ($tani == 'gabah' && $air == 'disiram') {
              if($jumlah >= 653){
                $zakat = ($jumlah * $harga) * 5/100;
                $ket  = "<div class='alert alert-info'>Zakat yang harus anda bayar senilai <b>Rp. " . $zakat . ",- </b>
                <br><br>Atau setara dengan <b>" . $jumlah * 5/100 . " Kg gabah</b>.
                <br> *Zakat dibayarkan setiap masa panen </div>";
              }else{
                $ket = "<div class='alert alert-info'><b> Anda Belum Wajib Bayar Zakat </b></div>
                <br> *Anda bayar zakat jika sudah mencapai nisab 653 Kg gabah";
              }
          }
            elseif ($tani == 'gabah' && $air == 'alam') {
                if($jumlah >= 653){
                  $zakat = ($jumlah * $harga) * 10/100;
                  $ket  = "<div class='alert alert-info'>Zakat yang harus anda bayar senilai <b>Rp. " . $zakat . ",- </b>
                  <br><br>Atau setara dengan <b>" . $jumlah * 10/100 . " Kg gabah</b>.
                  <br> *Zakat dibayarkan setiap masa panen </div>";
                }else{
                  $ket = "<div class='alert alert-info'><b> Anda Belum Wajib Bayar Zakat </b></div>
                  <br> *Anda bayar zakat jika sudah mencapai nisab 653 Kg gabah";
                }
            }
            elseif ($tani == 'beras' && $air == 'disiram') {
                if($jumlah >= 520){
                  $zakat = ($jumlah * $harga) * 5/100;
                  $ket  = "<div class='alert alert-info'>Zakat yang harus anda bayar senilai <b>Rp. " . $zakat . ",- </b>
                  <br><br>Atau setara dengan <b>" . $jumlah * 5/100 . " Kg beras</b>.
                  <br> *Zakat dibayarkan setiap masa panen </div>";
                }else{
                  $ket = "<div class='alert alert-info'><b> Anda Belum Wajib Bayar Zakat </b></div>
                  <br> *Anda bayar zakat jika sudah mencapai nisab 520 Kg beras";
                }   
            }
            elseif ($tani == 'beras' && $air == 'alam'){
                if($jumlah >= 520){
                  $zakat = ($jumlah * $harga) * 10/100;
                  $ket  = "<div class='alert alert-info'>Zakat yang harus anda bayar senilai <b>Rp. " . $zakat . ",- </b>
                  <br><br>Atau setara dengan <b>" . $jumlah * 10/100 . " Kg beras</b>.
                  <br> *Zakat dibayarkan setiap masa panen </div>";
                }else{
                  $ket = "<div class='alert alert-info'><b> Anda Belum Wajib Bayar Zakat </b></div>
                  <br> *Anda bayar zakat jika sudah mencapai nisab 520 Kg beras";
                }  
            }
            elseif ($tani == 'lain' && $air == 'disiram') {
                if( $harga_lain * $jumlah >= $harga * 520 ){
                  $zakat = ($jumlah * $harga_lain) * 5/100;
                  $ket  = "<div class='alert alert-info'>Zakat yang harus anda bayar senilai <b>Rp. " . $zakat . ",- </b>
                  <br><br>Atau setara dengan <b>" . ($harga_lain / $harga * $jumlah) * 5/100 . " Kg beras / makanan pokok lain</b>.
                  <br> *Zakat dibayarkan setiap masa panen </div>";
                }else{
                  $ket = "<div class='alert alert-info'><b> Anda Belum Wajib Bayar Zakat </b></div>
                  <br> *Anda bayar zakat jika sudah mencapai nisab harga panen setara dengan 520 Kg beras/ makanan pokok lain";
                }
            }
            elseif ($tani == 'lain' && $air == 'alam') {
                if( $harga_lain * $jumlah >= $harga * 520 ){
                  $zakat = ($jumlah * $harga_lain) * 10/100;
                  $ket  = "<div class='alert alert-info'>Zakat yang harus anda bayar senilai <b>Rp. " . $zakat . ",- </b>
                  <br><br>Atau setara dengan <b>" . ($harga_lain / $harga * $jumlah) * 10/100 . " Kg beras / makanan pokok lain</b>.
                  <br> *Zakat dibayarkan setiap masa panen </div>";
                }else{
                  $ket = "<div class='alert alert-info'><b> Anda Belum Wajib Bayar Zakat </b></div>
                  <br> *Anda bayar zakat jika sudah mencapai nisab harga panen setara dengan 520 Kg beras/ makanan pokok lain";
                }
            }

    }
  
?>

<div class="container">
<div> <?php echo $ket; ?> </div>
</div>
</div>
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 bg-dark text-white">© 2021 Copyright: Ahmad Nurul Laiq
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>