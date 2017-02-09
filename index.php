
<?php 
// ini_set('display_errors',1); 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Andrea Caravani Full-Stack Web Developer - London</title>
    <link rel="shortcut icon" type="image/png" href="favicon.ico"/>

    <link href="public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-59421060-1', 'auto');
      ga('send', 'pageview');

    </script>

</head>
    <body>

    <?php 
    require_once 'includes/global.inc.php'; 
    require_once 'classes/MyTools.class.php';
phpinfo();
    //generate token
    $mytool = new MyTools();
    $token = $mytool->generateToken();

    include 'sections/header.php'; 
    ?>

    <section id="section-whatido">
        <div class="container-fluid container-wid-foto brd-ble">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wid-text">
                            <p class="padding-20 thin-font">
                                Web developer based in London. Passionate about developing websites and applications using the most recent technologies. 
    Flexible in achieving fast-paced web related projects. 

                            </p>
                        </div>
                    </div>
                </div>
        </div>
        <div class="container-fluid text-center section-box-wid">
            <div class="row text-center title-wid">
                <h2 class="title-spacer">WHAT I DO</h2>
            </div>
            <div class="row">
                <div class="col-md-4 parent">
                    <div class="inseide-box-wid child" data-0="border-color:rgb(0, 180, 204);" data-1000="border-color:rgb(0, 180, 204);">
                        <h2 class="adj-top">
                            SEO
                        </h2>
                        <p>
                            Optimize the indexing on search engines, today is the most important thing to do to reach the right customer
                        </p>
                    </div>
                    <div id="yyskill" class="foto_skill">
                        <img src="public/images/media.png">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="inseide-box-wid " data-0="border-color:rgb(0,95,107);" data-1000="border-color:rgb(0, 180, 204);">
                        <h2>
                            DEVELOPMENT
                        </h2>
                        <p>
                            Simplicity, elegance, professionalism and creativity, these are the three ingredients that I love use in my works
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="wwskill" class="foto_skill">
                        <img src="public/images/wwww.png">
                    </div>
                    <div id="socialmediabox" class="inseide-box-wid " data-0="border-color:rgb(0, 180, 204);" data-1000="border-color:rgb(0, 180, 204);">
                        
                        <p>
                            Today the advertising has moved on social networks, have a profile on them is important to be found by the right customer
                        </p>
                        <h2>
                            SOCIAL MEDIA
                        </h2>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="section-background">
        <div class="container">

        </div>
    </section>

    <section id="section-whativedone" data-parallax="scroll" data-image-src="public/images/bgworks.gif">
        <div class="container-fluid container-palette"></div>
        <div class="container-fluid">
            <div class=" text-center title-wivd">
                <h2 class="title-spacer">WHAT I HAVE DONE</h2>
            </div>

            <div id="myCarousel-portfolio" class="carousel slide">
                <div id="portfolio" class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <?php 
                                $portfolio = new PortfolioTools();

                                $allportfolios = $portfolio->getAllFirstPicture();

                                $num_work = count($allportfolios);
                                $num_slide = ceil($num_work/4);
                                $count = 1;

                                foreach ($allportfolios as $key) {
                                    ?>
                                    <form action="#" id="form-thumb-<?php echo $key['id_work']; ?>" method="POST" class="form-thumb">
                                        <?php
                                        $urlimg = "public/".$key['firstpiclink']['link_photo_album'];
                                        ?>
                                        <div id="<?php echo $key['id_work']; ?>" class="col-md-3 col-sm-6 box-single-portfolio loadWork showmodal" meta-work-id="<?php echo $key['id_work']; ?>">
                                            <div class="insede-box-portfolio" style="background-image: url('<?php echo $urlimg; ?>');">
                                              
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo $key['id_work']; ?>" class="work-id-thumb">
                                        <input type="hidden" value="<?php echo $token; ?>" class="token">
                                    </form>
                            <?php
                             if( !($count%4) ){
                            ?>
                        </div> 
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <?php
                            }
                                $count++;
                                }
                            ?>
                        </div> 
                    </div>
                </div>
                <a class="left carousel-control" href="#myCarousel-portfolio" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="right carousel-control" href="#myCarousel-portfolio" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </section>

    <?php include 'sections/footer.php'; ?>

    <link rel="stylesheet" href="public/lib/font-awesome45/css/font-awesome.min.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <script src="public/lib/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="public/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/lib/parallax.min.js"></script>
    <script src="public/lib/jquery.mobile.custom.min.js"></script>
    <script src="public/js/ajax.js"></script>
    <script src="public/js/andy.js"></script>
    </body>
</html>