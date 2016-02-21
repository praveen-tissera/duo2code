<?php
print_r($this->session->userdata('userinfo'));
if ($this->session->userdata('userinfo') != NULL) {
    $this->load->helper('url');
    
    redirect('/user/dashboard');
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
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo  base_url('/user/register'); ?>">Sign In</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-6 text-center">
                <h2>Registration Form</h2>
               <?php

echo form_open('user/newregistration');
if(form_error('fname') || form_error('lname') || form_error('email_value') || form_error('password')){
echo '<div class="alert alert-danger" role="alert">';
    echo form_error('fname');
    echo form_error('lname');
    echo form_error('email_value');
    echo form_error('password');
echo '</div>';
}
if(isset($error_message_display)){
echo '<div class="alert alert-danger" role="alert">';
echo $error_message_display;
echo '</div>';
}
if(isset($success_message_display)){
echo '<div class="alert alert-success" role="alert">';
echo $success_message_display;
echo '</div>';
}
echo "<div class='form-group'>";
$data = array(
    'type' => 'text',
    'name' => 'fname',
    'class' => 'form-control',
    'placeholder' => 'First Name'
    );
    echo form_input($data);
echo "</div>";

echo "<div class='form-group'>";
$data = array(
    'type' => 'text',
    'name' => 'lname',
    'class' => 'form-control',
    'placeholder' => 'Last Name'
    );
    echo form_input($data);
echo "</div>";


echo "<div class='form-group'>";
$options = array(
        '10'         => '10 Years',
        '11'         => '11 Years',
        '12'         => '12 Years',
        '13'         => '13 Years',
        '14'         => '14 Years',
        
);
$extra = 'class="form-control"';

echo form_dropdown('age', $options,'',$extra);
echo "</div>";


echo "<div class='form-group'>";
    $data = array(
    'type' => 'email',
    'name' => 'email_value',
    'class' => 'form-control',
    'placeholder' => 'Email'
    );
    echo form_input($data);
echo "</div>";


echo "<div class='form-group'>";
    $data = array(
    'type' => 'text',
    'name' => 'password',
    'class' => 'form-control',
    'placeholder' => 'Password [Minimum 8 Charactors Length]'
    );
    echo form_password($data);
echo "</div>";

echo form_submit('submit', 'Sign Up', "class='btn btn-success btn-lg btn-block'");
echo form_close();
?>





            </div>
            <div class="col-md-6 text-center">
                 <h2>Login</h2>
               <?php

echo form_open('user/login');
echo "<div class='form-group'>";
 if(form_error('log_email') || form_error('log_password')){
echo '<div class="alert alert-danger" role="alert">';
   
    echo form_error('log_email');
    echo form_error('log_password');
echo '</div>';
}
if(isset($error_loginmessage_display)){
echo '<div class="alert alert-danger" role="alert">';
echo $error_loginmessage_display;
echo '</div>';
}
    $data = array(
    'type' => 'email',
    'name' => 'log_email',
    'class' => 'form-control',
    'placeholder' => 'Email'
    );
    echo form_input($data);
echo "</div>";


echo "<div class='form-group'>";
    $data = array(
    'type' => 'text',
    'name' => 'log_password',
    'class' => 'form-control',
    'placeholder' => 'Password [Minimum 8 Charactors Length]'
    );
    echo form_password($data);
echo "</div>";

echo form_submit('submit', 'Log Now', "class='btn btn-primary btn-lg btn-block'");
echo form_close();
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
