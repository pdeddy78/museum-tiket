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
            <div class="row-fluid">
                <div class="span2"></div>
                <div class="span8 page404-container">
                    <h1 class="page404">Oh noooo...it's here,</h1>
                    <h1 class="page404 nextLine">God protect us!</h1>
                    <h1 class="heading404">404</h1>
                    <h4 class="subheading404">error</h4>
                    <p class="first-line">something's not right here</p>
                    <p class="second-line">the page you are looking for cannot be found</p>
                    <div class="buttonHolder">
                        <button class="btn btn-small btn-primary" onClick="history.back();"><i class="icon-refresh"></i> Try again</button>
                        <a class="btn btn-small btn-danger" href="<?=base_url()?>Welcome"><i class="icon-home"></i> Return to home</a>
                    </div>
                </div>
                <div class="span2"></div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="<?=base_url()?>assets/js/vendor/bootstrap.min.js"></script>
    </body>
</html>