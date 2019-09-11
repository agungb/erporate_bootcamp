<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('bulan'))
{
  function bulan($bln)
  {
    switch ($bln)
    {
      case 1:
      return "Januari";
      break;
      case 2:
      return "Februari";
      break;
      case 3:
      return "Maret";
      break;
      case 4:
      return "April";
      break;
      case 5:
      return "Mei";
      break;
      case 6:
      return "Juni";
      break;
      case 7:
      return "Juli";
      break;
      case 8:
      return "Agustus";
      break;
      case 9:
      return "September";
      break;
      case 10:
      return "Oktober";
      break;
      case 11:
      return "November";
      break;
      case 12:
      return "Desember";
      break;
    }
  }
}

    //Format tanggal_indo
if ( ! function_exists('tanggal_indo'))
{
  function tanggal_indo($tanggal)
  {
    $ubah = gmdate($tanggal, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];
    $bulan = bulan($pecah[1]);

    $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
    $nama_hari = "";
    if($nama=="Sunday") {$nama_hari="Minggu";}
    else if($nama=="Monday") {$nama_hari="Senin";}
    else if($nama=="Tuesday") {$nama_hari="Selasa";}
    else if($nama=="Wednesday") {$nama_hari="Rabu";}
    else if($nama=="Thursday") {$nama_hari="Kamis";}
    else if($nama=="Friday") {$nama_hari="Jumat";}
    else if($nama=="Saturday") {$nama_hari="Sabtu";}
    return $nama_hari . ', ' . $tgl . ' ' . $bulan .' '. $thn;
  }
}


    //Format tanggal
if ( ! function_exists('tanggal_aja'))
{
  function tanggal_aja($tanggal)
  {
    $ubah = gmdate($tanggal, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];
    $bulan = bulan($pecah[1]);

    $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
    $nama_hari = "";
    if($nama=="Sunday") {$nama_hari="Minggu";}
    else if($nama=="Monday") {$nama_hari="Senin";}
    else if($nama=="Tuesday") {$nama_hari="Selasa";}
    else if($nama=="Wednesday") {$nama_hari="Rabu";}
    else if($nama=="Thursday") {$nama_hari="Kamis";}
    else if($nama=="Friday") {$nama_hari="Jumat";}
    else if($nama=="Saturday") {$nama_hari="Sabtu";}
    return $tgl . ' ' . $bulan .' '. $thn;
  }
}

    //Format nama hari
if ( ! function_exists('hari_aja'))
{
  function hari_aja($tanggal)
  {
    $ubah = gmdate($tanggal, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];
    $bulan = bulan($pecah[1]);

    $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
    $nama_hari = "";
    if($nama=="Sunday") {$nama_hari="Minggu";}
    else if($nama=="Monday") {$nama_hari="Senin";}
    else if($nama=="Tuesday") {$nama_hari="Selasa";}
    else if($nama=="Wednesday") {$nama_hari="Rabu";}
    else if($nama=="Thursday") {$nama_hari="Kamis";}
    else if($nama=="Friday") {$nama_hari="Jumat";}
    else if($nama=="Saturday") {$nama_hari="Sabtu";}
    return $nama_hari;
  }
}
