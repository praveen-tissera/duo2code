

<?php

if (!($this->session->userdata('userinfo'))) {
   
    redirect('/user/login');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo  base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">

   <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
        font-family: 'Roboto', sans-serif;
        line-height: 28px;
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
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
                <a class="navbar-brand" href="<?php echo  base_url('/welcome'); ?>">Start Bootstrap</a>
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





    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="collapse" id="collapseExample" aria-expanded="false" style="height: 0px;"> 
                    <div class="well"> 
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                    Nihil anim keffiyeh helvetica, 
                    craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
          
           <?php 
           if (isset($course_details)) {
            echo "<h2>Course List</h2>";
            echo "<ul>";
               foreach ($course_details as $key => $value) {


                  echo "<li><a href=\"".base_url('/user/selectCourse/'.$value->course_id. "")."\" >" . $value->course_name . "</a></li>";
               }

            echo "<ul>";
           }


           ?>
                <h3>Notification</h3>
                <h3>Recent Brief Caseses</h3>
                <h3>Recent Brief Caseses</h3>
               
            </div>
            
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo  base_url('/assets/script/jquery.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo  base_url('/assets/script/bootstrap.min.js');?>"></script>

</body>

</html>
