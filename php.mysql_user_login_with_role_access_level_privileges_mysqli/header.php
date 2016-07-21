<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <meta name="author" content="">
        <meta name="keywords" content="">
        <title><?php echo PROJECT_NAME ?></title>
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/bootstrap/css/bootstrap-social.css" rel="stylesheet">
        <link href="assets/bootstrap/css/font-awesome.css" rel="stylesheet">
        <link href="assets/style-common.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="assets/bootstrap/html5shiv.js"></script>
          <script src="assets/bootstrap/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand"><?php echo PROJECT_NAME; ?></a>
                </div>
            </div>
        </div>

        <div class="container mainbody">
            <div class="page-header">
                <h1><?php echo $pageTitle; ?></h1>
            </div>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <div class="container-fluid">
            <div class="col-lg-12">
                <?php msgs(); ?>
                <div style="height: 10px;">&nbsp;</div>
            </div>