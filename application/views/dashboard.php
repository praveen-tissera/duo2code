

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
    <link href="<?php echo  base_url('/assets/css/custom.css');?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    




    <!-- Page Content -->
    <div class="container">
        
        <div class="row">
            <div class="col-md-12 text-center">
          
           <?php 
           if (isset($course_details)) {
            echo "<h2>Course List</h2>";
            
               foreach ($course_details as $key => $value) {
               echo "<div class=\"col-md-4 text-center\">";
                echo "<div class=\"jumbotron text-left\">";
                  echo "<h3><a class=\"btn btn-danger\" href=\"".base_url('/user/selectCourse/'.$value->course_id. "")."\" >" . $value->course_name . "</a></h3>";
                  echo "<h4 class=\"text-left\">";
                  echo $value->course_description;
                  echo "</h4>";
               echo "</div>";
               echo "</div>";

               }

           
           }


           ?>
               
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
