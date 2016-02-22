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
      <link rel="stylesheet" href="<?php echo  base_url('/assets/font-awesome/css/font-awesome.min.css');?>" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    
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
                       echo "<span class=\"fa fa-1x fa-circle\" aria-hidden=\"true\" style=\"color:{$value->fact_hash_code}\"></span>";
                        echo " ". $value->fact_name;
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
            //print_r($select_case_report);
             foreach ($select_case_report['facts'] as $key => $value) {
                echo "<div class=\"panel panel-default  {$value->fact_select_id}\">";
                echo "<div class=\"panel-heading {$value->fact_color}\">{$value->fact_name}";
                echo "<button type=\"button\" class=\"close {$value->fact_select_id}\" onclick=\"deselect('#{$value->fact_select_id}')\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";

                echo "</div>";
                echo "<div class=\"panel-body\">";
                echo "<textarea  class=\"form-control\" onchange=\"factnote(this.value,{$value->fact_select_id});\">{$value->fact_note}</textarea>";
                
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
                            '<div class="panel panel-success ' + x+'" ><div class="panel-heading">issue'+
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
alert('confirm to add the note');

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
