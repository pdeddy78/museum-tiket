<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cetak Tiket PDF</title>
</head>
<body>
<table style="width: 50%;border: solid 2px #5544DD" align="center">
  <tbody>
  <?php foreach($dt_transaksi->result() as $row) { ?>
    <tr>
      <td colspan="2" align="left" valign="middle"><?=$row->id_transaksi?> </td>
      <td align="right" valign="middle">Dikeluarkan pada <?=mdate('%d %M %Y - %h:%i %a',time())?></td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="middle"><h1>Tiket Masuk Keraton <br>
        Surakarta</h1></td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="23%">&nbsp;</td>
      <td width="37%" align="right" valign="middle">Jenis Tiket: <?=$row->nama_tiket?></td>
    </tr>
    <tr>
      <td><p>Dilarang menggunakan celana pendek dan <br/>sendal saat memasuki keraton. <br/>Terima kasih</p>
      <p><em>Prohibited from using shorts and <br/>sandals when entering the palace. <br/>Thank you.</em></p></td>
      <td>&nbsp;</td>
      <td align="center" valign="middle"><h2><?=$row->tot_tiket?> Pengunjung</h2></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right"><?=$row->nama_loket?>: <?=$row->nama_staf?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</body>
</html>
