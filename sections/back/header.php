<header id="section-top-backend">

    <nav class="navbar navbar-default navbar-style" style="position: relative;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header my-navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">tnav</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand my-navbar-brand" href="index.php">
                    <div id="logo" class="cont-brand">
                        <img src="../public/images/logo.gif" alt="">
                    </div>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
                <ul class="nav navbar-nav navbar-right">
                <?php 
                //check to see if they're logged in
                if(!isset($_SESSION['logged_in'])) {
                   ?>
                    <li><a href="index.php">Login</a></li>
                    <?php
                }else{
                    ?>
                    <li><a href="index.php">AllPortfolio</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php
                }
                ?>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

</header>
