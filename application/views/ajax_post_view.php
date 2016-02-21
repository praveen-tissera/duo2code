<?php

if (!($this->session->userdata('userinfo'))) {
   
    redirect('/user/login');
}

?>
<?php 
$this->session->userdata('userinfo')['user_id'];
//echo $abc['user_id'];
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

            <div class="col-sm-4">
                <div class="btn-group" role="group" aria-label="Basic example"> 

                    <?php 
                 
                    foreach ($select_case_report['law_report'] as $key => $value) {
                        echo "<a href=\"" . base_url() . "user/mycase/{$value->report_id}/$subjectid\" type=\"button\" class=\"btn btn-default\">Report View</a>";
                        echo "<a href=\"" . base_url() . "user/viewbrief/{$value->auto_id}\" type=\"button\" class=\"btn btn-default\">Brief View</a>";
                    }

                    ?>

                     
                   
                </div>

            </div>
            <div class="col-sm-8">
                <?php 
                echo "<div class=\"btn-group pull-right\" role=\"group\" aria-label=\"Basic example\"> ";
                foreach ($facts as $key => $value) {


                    echo "<button type=\"button\" class=\"btn btn-default\" id=\"colorbtn\" onclick=\"highlight({$value->fact_id},'{$value->fact_color}');\">";
                        echo $value->fact_name;
                    echo "</button>";       
                }
                
                echo "</div>";
               



                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12"><hr></div>
        </div>
        <div class="row">

            <div class="col-sm-9 col-md-9">

<?php 
           if (isset($select_case_report)) {
           
            echo "<h2>Law Report</h2>";
            if ($select_case_report == 'No Level found for this course') {
                echo "<h2>No Law Report Found</h2>";
            }
            else{
            
                
               foreach ($select_case_report['law_report'] as $key => $value) {

                echo "<input type=\"hidden\" name=\"reportid\" id=\"reportid\" value=\"{$value->report_id}\">";
                echo "<input type=\"hidden\" name=\"user\" id=\"userid\" value=\"{$this->session->userdata('userinfo')['user_id']}\">";
                echo "<input type=\"hidden\" name=\"user\" id=\"subjectid\" value=\"{$subjectid}\">";
                if(isset($value->auto_id)){
                    echo "<input type=\"hidden\" name=\"user\" id=\"auto_id\" value=\"{$value->auto_id}\">";    
                }
                else{
                    echo "<input type=\"hidden\" name=\"user\" id=\"auto_id\" value=\"null\">";
                }
                
                 echo "<h4>";
                 echo $value->report_title;
                 echo "</h4>";
                  echo "<p id=\"Text\" class=\"text-justify\">";
                  if (isset($value->report_full_with_fact)) {
                      echo $value->report_full_with_fact;
                  }
                  else{
                    echo $value->report_full;
                  }
                    
                  echo "</p>";
               }

            
            }
           }


           ?>




            </div>
            <div class="col-sm-3 col-md-3">
                
            <?php 

            echo "<div id=\"facts_box\">";

             foreach ($select_case_report['facts'] as $key => $value) {
                echo "<div class=\"panel panel-success {$value->fact_select_id}\">";
                echo "<div class=\"panel-heading\">Panel heading without title";
                echo "<button type=\"button\" class=\"close {$value->fact_select_id}\" onclick=\"deselect('#{$value->fact_select_id}')\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";

                echo "</div>";
                echo "<div class=\"panel-body\">";
                echo "<textarea  onchange=\"factnote(this.value,{$value->fact_select_id});\">{$value->fact_note}</textarea>";
                
                echo "</div></div>";
            }
                

             

            ?>

                <p id="results"></p>

            </div>
        </div>
       
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo  base_url('/assets/script/jquery.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo  base_url('/assets/script/bootstrap.min.js');?>"></script>
    <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/aes.js"></script>
    <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/pad-nopadding-min.js"></script>

    <script>

// Ajax post
/*$(document).ready(function() {
    $(".submit").click(function(event) {
        event.preventDefault();
        var user_name = $("input#name").val();
        var password = $("input#pwd").val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax_post_controller/user_data_submit",
            dataType: 'json',
            data: {name: user_name, pwd: password},
            success: function(res) {
                if (res)
                    {
                        // Show Entered Value
                        jQuery("div#result").show();
                        jQuery("div#value").html(res.username);
                        jQuery("div#value_pwd").html(res.pwd);
                    }
             }
        });
    });
});*/


    </script>


<script>


window.highlight = function(factid,factcolor) {
  //alert(factid);
  //alert(factcolor);

   var selection = window.getSelection().getRangeAt(0);//get selected text
    //alert(selection);
   // var timestamp = new Date().getUTCMilliseconds();

    var now = new Date();
    //timestamp = now.getFullYear().toString(); // 2011
    //timestamp += now.getMonth()
    //timestamp += (now.getMonth() < 9 ? '0' : '') + now.getMonth().toString(); // JS months are 0-based, so +1 and pad with 0's
    timestamp = (now.getDate() < 10 ? '0' : '') + now.getDate().toString(); // pad with a 0
    timestamp += now.getMilliseconds();
        
    var selectedText = selection.extractContents();
    var x = Math.floor((Math.random() * 100) + 1) + (timestamp);
    var span = $("<span class='" + factcolor + "' id='" + x +"'>" + selectedText.textContent + "</span>");
    selection.insertNode(span[0]);
    
///////////////////////////////

jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax_post_controller/user_data_submit",
            dataType: 'json',
            data: {
                name: document.getElementById('Text').innerHTML, report: document.getElementById('reportid').value, 
                user: document.getElementById('userid').value,
                subjectid: document.getElementById('subjectid').value,
                autoid: document.getElementById('auto_id').value,
                factid:factid,
                selectid:x
            },
            
            success: function(res) {
                if (res)
                    {
                        //alert('test');
                        $('#facts_box').append(
                            '<div class="panel panel-success ' + x+'" ><div class="panel-heading">Panel heading without title'+
                            '<button type="button" class="close ' + x + ' " onclick="deselect(\'' + '#' + x + '\');" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '</div><div class="panel-body">Panels content'+
                                '<textarea  onchange="factnote(this.value,' + x + ');"></textarea>'
                           

                            );
                    }
                }
            });

    /////////////////////////////////
        
        }




//delete fact 
    window.deselect = function(selector) {
        var wrap = $(selector);
        var text = wrap.text();
    wrap.replaceWith(text);
    
    jQuery.ajax({

            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax_post_controller/delete_fact",
            dataType: 'json',
            data: {
                name: document.getElementById('Text').innerHTML, 
                report: document.getElementById('reportid').value, 
                user: document.getElementById('userid').value,
                subjectid: document.getElementById('subjectid').value,
                autoid: document.getElementById('auto_id').value,
                factselectid:selector
            },
            
            success: function(res) {
                if (res)
                    {
                        btnselector = selector.replace('#','');
                        //alert(btnselector);
                        var btnselector = "div."+btnselector;
                         //alert(btnselector);
                        $(btnselector).remove();
                        
                  
                    }
            }
        });
    //alert(selector);
};





////////////////////////
//insert fact note

window.factnote = function(factmsg,userfactid) {
alert(userfactid);

    jQuery.ajax({

            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax_post_controller/fact_note",
            dataType: 'json',
            data: {
                factmsg: factmsg, 
                factuserid: userfactid 
                
            },
            
            success: function(res) {
                if (res)
                    {
                        alert('works');
                        
                  
                    }
            }
        });





}
////////////////////////////



function clearSelection() {
    if ( document.selection ) {
        document.selection.empty();
    } else if ( window.getSelection ) {
        window.getSelection().removeAllRanges();
    }
}

</script>



</body>

</html>
