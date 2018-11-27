<?php require_once('config.php'); ?> 
<header>
        <div class="topHeaderRow" style="color:#fff;background:#3b3a30">
            <div class="container">
                <div class="pull-right">
                    <ul class="list-inline">
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Sign Up/Log In/Log Out</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                        <!-- <li><a href="#"><span class="glyphicon glyphicon-star"></span> Favorites</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- end topHeaderRow -->


        <nav class="navbar navbar-default" style="">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="landingpage.php"><img src="images/logo2.png" title="LiveMusicGram!" alt="LiveMusicGram!"style="position:relative; top: -50px"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="landingpage.php">Home</a></li>
                        <li><a href="uploadpage.php">Upload a Picture</a></li>
                        
                    </ul>


                    <form class="navbar-form navbar-right" role="search" method="get" action="findTags.php">
                        <div class="form-group">
                            <input type="text" class="form-control" name="tagSearch" id="tagSearch" placeholder="Search Image Tags">
                        </div>
						
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.navbar-collapse -->


            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>