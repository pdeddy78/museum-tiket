<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<?php $this->load->view("themes/header")?>
</head>
<body class="dashboard">
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<?php $this->load->view("themes/top-menu")?>
<?php // $this->load->view("themes/sidebar")?>
<?php $this->load->view("themes/main-menu")?>
<!-- ==================== PAGE CONTENT ==================== -->
<div class="content">
<!-- ==================== TITLE LINE FOR HEADLINE ==================== -->
<?php $this->load->view("themes/headline")?>
<!-- ==================== END OF TITLE LINE ==================== -->
<!-- ==================== BREADCRUMBS / DATETIME ==================== -->
<?php $this->load->view("themes/breadcrumb")?>
<!-- ==================== END OF BREADCRUMBS / DATETIME ==================== -->
<!-- ==================== WIDGETS CONTAINER ==================== -->
<div class="container-fluid">
<?php $this->load->view($main_view)?>
</div>
<!-- ==================== END OF WIDGETS CONTAINER ==================== -->
</div>
<!-- ==================== END OF PAGE CONTENT ==================== -->
<?php $this->load->view("themes/footer")?>
</body>
</html>