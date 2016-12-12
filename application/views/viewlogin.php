<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <title><?=$judul?> | <?=$app?></title>
        <meta name="description" content="">
        <meta name="author" content="pdeddy78">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div class="container-fluid">
            <?php
                $attributes = array('name'=>'form_login','class'=>'form-signin','role'=>'form');
                echo form_open('Auth/login', $attributes);
            ?>
                <h2 class="form-signin-heading"><strong>MUSEUM</strong> SURAKARTA</h2>
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-user"></i></span>
                  <input type="text" tabindex="1" name="username" required value="<?=set_value('username')?>" placeholder="Username">
                </div>
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-lock"></i></span>
                  <input type="password" tabindex="2" name="password" required placeholder="Password">
                </div>
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-tasks"></i></span>
                  <select id="id_loket" tabindex="3" class="chzn-select" name="id_loket" placeholder="Pilih Untuk Bagian Loket...">
                        <option value=""></option>
                        <?php
                            if(isset($open_loket)){
                                foreach($open_loket as $row){
                        ?>
                                <option value="<?php echo $row->id_loket?>"><?php echo $row->nama_loket?></option>
                            <?php
                                }
                            }
                            ?>
                  </select>
                  <button class="btn btn-info" type="submit"><i class="icon-ok"></i> OK</button>
                </div>
            </form>
            <div class="signInRow">
                <div><h1>Sign in</h1></div>
                <div>&nbsp</div>
            </div>
        </div>    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="<?=base_url()?>assets/js/vendor/bootstrap.min.js"></script>
    </body>
</html>