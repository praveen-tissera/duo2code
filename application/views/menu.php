<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand no-padding" href="<?php echo  base_url('/welcome'); ?>">
                    <img width="70px" height="50px" alt="Brand" src="<?php echo  base_url('/assets/images/logo.png');?>">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                

                <ul class="nav navbar-nav navbar-right">
                    
                   <li id="fat-menu" class="dropdown"> 
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                       <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                       <span class="caret"></span> 
                       </a>     
                       <ul class="dropdown-menu" aria-labelledby="drop3"> 
                            <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a></li> 
                            <li><a href="#"><span class="glyphicon glyphicon glyphicon-book" aria-hidden="true"></span> My Course</a></li> 
                            <li><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li> 
                             
                            <li role="separator" class="divider"></li> 
                            <li><a href="<?php echo base_url('/user/logout'); ?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
                        </ul> 
                    </li>

                </ul>
                <button type="button" class="glyphicon glyphicon glyphicon-search btn btn-default navbar-btn navbar-right collapsed" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    
                </button>
                
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group ">
                      <input type="text" class="form-control" placeholder="Search with case title">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
