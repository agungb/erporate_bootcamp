<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $title; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Toast CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/js/toastr/toastr.min.css') ?>">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.css'); ?>">
  <!-- JQuery Js  -->
  <script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
  <!-- Toast JS -->
  <script src="<?php echo base_url('assets/js/toastr/toastr.min.js') ?>"></script>
  <!-- Select 2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css') ?>">
</head>
<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header">
    <!-- Header logo -->
    <a class="app-header__logo" href="<?php echo base_url(); ?>">Aplikasi Absensi</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  </header>
