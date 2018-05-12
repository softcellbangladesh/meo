<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MEO - CENTRAL</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/full-slider.css" rel="stylesheet">

    <!-- Font added -->
    <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">

    <!-- jquery -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- DataTable -->
    <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/custom_css.css" rel="stylesheet">

  </head>

  <body data-base="<?php echo base_url(); ?>">

    <!-- Loader & Overlay -->
    <div class="overlay" id="overlay"></div>
    <div class="loader" id="loader"><div class="lds-facebook"><div></div><div></div><div></div></div></div>
    <!-- toaster starts -->
    <div class="toaster-box" id="toaster-box">
      <div class="toaster" success warning error">
        <div class="container">
          <div class="row">
            <div class="toaster-left-box col-10">
              <div class="toaster-header">
                <i class="fa fa-check"></i>
                <span class="toaster-title"> </span>
              </div>
              <div class="toaster-details"> </div>
            </div>
            <div class="toaster-right-box col-2">
              <div class="toaster-cross">
                <i class="fa fa-2x fa-times"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- toaster ends -->

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
        	<img class="img-fluid float-left" style="max-height: 50px" src="<?php echo base_url(); ?>assets/image/logo.png" alt="logo"> 
        	<p class="float-left" style="padding-left: 10px; margin-top: .6rem">MEO CENTRAL</p>
        </a>
        <!-- <img class="img-fluid navbar-brand" src="image/logo.png" alt="logo"> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url(); ?>">মুলপাতা
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">এমইও সম্পর্কে</a>
            </li>
            
            <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          সেবা
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">ভূমির সেবা</a>
		          <a class="dropdown-item" href="#">ফ্ল্যাট সেবা</a>
		          <a class="dropdown-item" href="<?php echo base_url(); ?>admin">সেবার অনুরোধ</a>
		        </div>
		     </li>
		        <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>assets/file/form.pdf">ফর্ম</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">ফ্ল্যাট</a>
            </li>
            <? if(!$this->session->logged_in){ ?>
            <!-- <li class="nav-item" <?php if($this->uri->segment(1) == 'registration'){echo 'class="active"';}?>>
            <a class="nav-link" href="<?php echo base_url(); ?>registration">নিবন্ধন</a>
            </li> -->
             <li class="nav-item" <?php if($this->uri->segment(1) == 'login'){echo 'class="active"';}?>>
            <a class="nav-link" href="<?php echo base_url(); ?>login">লগইন</a>
            </li>
            <? } ?>
            <? if($this->session->logged_in){ ?>
            <li class="nav-item log-out"><a class="nav-link" href="#">প্রস্থান</a></li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ?>user/<? echo $this->session->land_owner_id ?>" style="padding: 0px;">
                <? if(empty($this->session->photo)){ ?>
                    <img class="img-fluid rounded-circle" src="http://placehold.it/50" alt="">
                <?} else { ?>    
                <img class="img-fluid rounded-circle header-img" src="<?php echo base_url() ?>uploads/<?echo $this->session->photo?>" alt="">
                <?}?>
              </a>
            </li>
            <? } ?>
           
          </ul>
        </div>
      </div>
    </nav>