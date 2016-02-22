

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

                <div class="col-sm-4">
                    <div class="btn-group" role="group" aria-label="Basic example"> 

                        <?php 
                     
                        foreach ($result_report as $key => $value) {
                           // print_r($value);

                            echo "<a href=\"" . base_url() . "user/mycase/{$value->report_id}/{$value->subject_id}\" type=\"button\" class=\"btn btn-default\">Report View</a>";
                            echo "<a href=\"" . base_url() . "user/viewbrief/{$value->auto_id}\" type=\"button\" class=\"btn btn-default\">Brief View</a>";
                        }

                        ?>

                         
                       
                    </div>

                </div>
                <div class="col-sm-8">
                    <?php 
                    /*echo "<div class=\"btn-group pull-right\" role=\"group\" aria-label=\"Basic example\"> ";
                    foreach ($facts as $key => $value) {


                        echo "<button type=\"button\" class=\"btn btn-default\" id=\"colorbtn\" onclick=\"highlight({$value->fact_id},'{$value->fact_color}');\">";
                            echo $value->fact_name;
                        echo "</button>";       
                    }
                    
                    echo "</div>";*/
                   



                    ?>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12"><hr></div>
            </div>








            <div class="row">
                <div class="col-md-12">
              
               <?php 

             foreach ($facts as $key => $factvalue) {
                 $fact_color = $factvalue->fact_color;
                 echo "<div class=\"panel panel-default\">";
                 echo "<div class=\"panel-heading {$factvalue->fact_color}\">";

                 echo "</div>";
                    echo "<div class=\"panel-body\">";
                        //echo $fact_color.'<br>';

                       
                       if(isset(${$fact_color})){
                        foreach (${$fact_color} as $key => $factvalue) {
                         if(isset(${$fact_color}[$key]['user_facts'][0]->fact_note)){
                          echo "<p style=\"font-size: 20px;\">" . ${$fact_color}[$key]['user_facts'][0]->fact_note.'<br></p>';
                          }
                          if(isset(${$fact_color}[$key]['base_text'])){
                         echo '<span style="font-size: 30px;">"</span><span style="font-size: 15px;">' . ${$fact_color}[$key]['base_text'] . '</span><span style="font-size: 30px;">"</span>';
                        }
                         echo "<hr>";
                        }
                   }
                        //echo ${$fact_color}['user_facts'][0]->fact_note.'<br>';
                        //echo ${$fact_color}['base_text'];

                 echo "</div>";
                    echo "</div>";
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
