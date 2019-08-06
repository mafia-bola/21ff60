<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>TIKET</title>
  </head>
  <body>
    <header class="clearfix">
    <h3 style="text-align:center;margin-top:0px;margin-bottom:0px">TIKET KECAK</h3>
    <p style="text-align:center;margin-top:0px;margin-bottom:10px">{{$nama_kecak}} ({{$jadwal_kecak}})</p>
    </header>
    <table style="margin-left:0px;padding-left:0px">
      <tr>
          <td style="text-align:left">Kode Tiket</td>
          <td>:</td>
          <td style="text-align:left">{{$kode_tiket}}</td>
      </tr>
      <tr>
          <td style="text-align:left">Pengunjung</td>
          <td>:</td>
          <td style="text-align:left">{{$pengunjung}}</td>
      </tr>
      <tr>
          <td style="text-align:left">Alamat</td>
          <td>:</td>
          <td style="text-align:left">{{$alamat_pengunjung}}</td>
      </tr>
      <tr>
          <td style="text-align:left">Tanggal Pesan</td>
          <td>:</td>
          <td style="text-align:left">{{$tanggal_pesan}}</td>
      </tr>
      <tr>
          <td style="text-align:left">Jumlah </td>
          <td>:</td>
          <td style="text-align:left">{{$jumlah_tiket}} Pax.</td>
      </tr>
      <tr>
          <td style="text-align:left">Total Harga</td>
          <td>:</td>
          <td style="text-align:left">{{$total_harga}}</td>
      </tr>
    </table>    
  </body>
</html>
