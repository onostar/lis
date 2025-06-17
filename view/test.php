<div id="add_template">
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_GET['investigation'])){
        $test = $_GET['investigation'];
        $visit = $_GET['visit'];
        $patient = $_GET['patient'];
        //get patient details
        $get_item = new selects();
        $results = $get_item->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($results as $result){
            $full_name = $result->last_name." ".$result->other_names;
            $patient_gender = $result->gender;
            $date = new DateTime($result->dob);
            $now = new DateTime();
            $age = ($now->diff($date))->y;
        }
        //get investigation details
        $details = $get_item->fetch_details_cond('items', 'item_id', $test);
        foreach($details as $detail){
            $investigation =  $detail->item_name;
        }
        //check if there is a template for the investigation
        $temps = $get_item->fetch_count_cond('lab_templates', 'investigation', $test);
        if($temps > 0){
            //get templates
            //check for age parameter
            $dobss = $get_item->fetch_lab_age_template($test, $age);
            //check for gender parameter
            $gends = $get_item->fetch_lab_gender_template($test, $patient_gender);
            //check if every parameter matches
            $formats = $get_item->fetch_lab_template1($test, $patient_gender, $age);
            if(is_array($formats) && count($formats) > 0){
                foreach($formats as $format){
                    $template = $format->template_number;
                }
            }
            //check for age parameter
            elseif(is_array($dobss) && count($dobss) > 0){
                foreach($dobss as $dobs){
                    $template = $dobs->template_number;
                }
            }
           // 3. Check for template matching gender only
            elseif(is_array($gends) && count($gends) > 0){
                foreach($gends as $gend){
                    $template = $gend->template_number;
                }
            }
            
            //get general template
            else{
                $generals = $get_item->fetch_general_template($test);
                if(is_array($generals) && count($generals) > 0){
                    foreach($generals as $general){
                        $template = $general->template_number;
                    }
                }
            }
            //get template details
            $rows = $get_item->fetch_details_cond('lab_templates', 'template_number', $template);
            foreach($rows as $row){
               
                $template_details = $row->template;
                $type = $row->template_type;
            }
?>
   <style>
    .toolbar button{
        color:#222!important;
        margin-right:5px;
        /* border-radius:0!important; */
    }
    .toolbar button:hover, .toolbar button:focus{
        color:#fff!important;
    }
</style>
    <div class="info"></div>
    <div class="add_user_form" style="width:90%">
        <h3 style="background:linear-gradient(45deg, rgba(226, 127, 85, 0.9), hsla(120, 100%, 25%, 0.8));text-transform:uppercase;font-size:1.2rem"><?php echo $investigation?> result for <?php echo $full_name?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <div class="constraints" style="justify-content:left;gap:1rem; padding:10px 20px">
            <input type="hidden" id="investigation" name="investigation" value="<?php echo $test?>">
            <input type="hidden" id="patient" name="patient" value="<?php echo $patient?>">
            <input type="hidden" id="visit" name="visit" value="<?php echo $visit?>">
            <div class="data" style="font-weight:bold;">
                <label for="">Gender:</label>
                <span><?php echo $patient_gender?></span>
            </div>
            <div class="data" style="font-weight:bold;">
                <label for="">Age:</label>
                <span><?php echo $age."years(s)"?></span>
            </div>
        </div>
        <?php if($type == "values"){?>
        <div class="template_content">

            <!-- Rich Text Editor Content -->
            <div id="lab_template"  name="lab_template">
                <div class="allResults" style="width:100%">
                    <table id="lab_table" class="searchTable">
                    <thead>
                        <tr style="background:var(--moreColor)">
                            <td>S/N</td>
                            <td>Parameter</td>
                            <td>Value</td>
                            <td>Unit</td>
                            <td>Status</td>
                            <td>Operator</td>
                            <td>Normal Range</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //get all parameters with this number
                        
                            $n = 1;
                            $get_details = new selects();
                            $shows = $get_details->fetch_details_cond('lab_template_values', 'template_number', $template);
                            if(is_array($shows)){
                                foreach($shows as $show){
                        ?>
                        <tr>
                            <td><?php echo $n;?></td>
                            <td><?php echo $show->parameter;?></td>
                            <td><input type="text" onkeyup="updateStatus('<?php echo $show->value_id?>', this.value)"></td>
                            <td><?php echo $show->unit;?></td>
                            <td id="<?php echo $show->value_id?>"><p>Normal</p></td>
                            <td style="text-transform:capitalize"><?php echo $show->operator?></td>
                            <td>
                                <?php
                                    if($show->operator == "range"){
                                        echo "$show->lower_limit - $show->upper_limit";
                                    }else{
                                        echo $show->normal_value;
                                    }
                                ?>
                            </td>
                            
                        </tr>
                    <?php
                        $n++;
                                }
                            }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            <input type="hidden" name="lab_content" id="lab_content" value="">
            
        </div>
        <?php }else{?> 
            <div class="template_content">

            <?php include "tool_bar.php"?>

            <!-- Rich Text Editor Content -->
            <div id="lab_template" contenteditable="true" name="lab_template">
                <?php echo $template_details?>
                
            </div>
            <input type="hidden" name="lab_content" id="lab_content" value="">
            
        </div>
        <?php }?>
        <div class="add_temp">
            <a href="javascript:void(0)" style="background:silver; color:#222; border-radius:15px; padding:5px;box-shadow:1px 1px 1px #222;border:1px solid #fff" onclick="postLabResult();">Post Result <i class="fas fa-plus"></i></a>
            <a style="border-radius:15px; background:brown;color:#fff;padding:5px; border:1px solid #fff; box-shadow:1px 1px 1px #222; margin:20px!important"href="javascript:void(0)" onclick="showPage('show_tests.php?bill=<?php echo $visit?>')"><i class="fas fa-angle-double-left"></i> Return</a>
        </div>
        

    </div>

<?php
        }else{     
?>
<style>
    .toolbar button{
        color:#222!important;
        margin-right:5px;
        /* border-radius:0!important; */
    }
    .toolbar button:hover, .toolbar button:focus{
        color:#fff!important;
    }
</style>
    <div class="info"></div>
    <div class="add_user_form" style="width:90%">
        <h3 style="background:linear-gradient(45deg, rgba(226, 127, 85, 0.9), hsla(120, 100%, 25%, 0.8));text-transform:uppercase;font-size:1.2rem"><?php echo $investigation?> result for <?php echo $full_name?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <div class="constraints" style="justify-content:left;gap:1rem; padding:10px 20px">
            <input type="hidden" id="investigation" name="investigation" value="<?php echo $test?>">
            <input type="hidden" id="patient" name="patient" value="<?php echo $patient?>">
            <input type="hidden" id="visit" name="visit" value="<?php echo $visit?>">
            <div class="data" style="font-weight:bold;">
                <label for="">Gender:</label>
                <span><?php echo $patient_gender?></span>
            </div>
            <div class="data" style="font-weight:bold;">
                <label for="">Age:</label>
                <span><?php echo $age."years(s)"?></span>
            </div>
        </div>
        <div class="template_content">

            <?php include "tool_bar.php"?>

            <!-- Rich Text Editor Content -->
            <div id="lab_template" contenteditable="true" name="lab_template">
                
                
            </div>
            <input type="hidden" name="lab_content" id="lab_content" value="">
            
        </div>    
        <div class="add_temp">
            <a href="javascript:void(0)" style="background:silver; color:#222; border-radius:15px; padding:5px;box-shadow:1px 1px 1px #222;border:1px solid #fff" onclick="postLabResult();">Post Result <i class="fas fa-plus"></i></a>
            <a style="border-radius:15px; background:brown;color:#fff;padding:5px; border:1px solid #fff; box-shadow:1px 1px 1px #222; margin:20px!important"href="javascript:void(0)" onclick="showPage('show_tests.php?bill=<?php echo $visit?>')"><i class="fas fa-angle-double-left"></i> Return</a>
        </div>
        

    </div>
 <?php
        }
    }
?>
</div>

<script>
    //post lab result
function postLabResult(){
     saveLabTemplate();
     let investigation = document.getElementById("investigation").value;
     let patient = document.getElementById("patient").value;
     let visit = document.getElementById("visit").value;
     let lab_template = document.getElementById("lab_template").innerHTML;
     document.getElementById("lab_content").value = lab_template;
     let lab_content = document.getElementById("lab_content").value;
     
     if(!lab_content || lab_content == ""){
          alert("Please input result values");
          $("#lab_template").focus();
          return;
     }else{
          let confirm_post = confirm("Are you sure you want to post this result?", "");
          if(confirm_post){
               $.ajax({
                    type : "POST",
                    url : "../controller/post_lab_result.php",
                    data : {investigation:investigation, patient:patient, visit:visit, lab_content:lab_content},
                    success : function(response){
                         $("#add_template").html(response);
                    }
               })
               
          }else{
               return;
          }
     }
}
function saveLabTemplate() {
     let labTemplate = document.getElementById("lab_template").cloneNode(true);
     
     // Get all input and select fields inside the table
     let inputs = labTemplate.querySelectorAll("input, select");
     
     inputs.forEach(input => {
          if (input.tagName === "INPUT") {
               input.setAttribute("value", input.value); // ✅ Preserve input value
          } 
          else if (input.tagName === "SELECT") {
               let selectedValue = input.value; // ✅ Get selected value
               
               input.querySelectorAll("option").forEach(option => {
                    if (option.value === selectedValue) {
                         option.setAttribute("selected", "selected"); // ✅ Mark selected
                    } else {
                         option.removeAttribute("selected"); // ✅ Unset others
                    }
               });
     
               // ✅ Store selected value in a data attribute to ensure retention
               input.setAttribute("data-selected", selectedValue);
          }
     });
     
     // Save updated HTML to hidden input
     document.getElementById("lab_content").value = labTemplate.innerHTML;
}
</script>