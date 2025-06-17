<?php
  include "../classes/dbh.php";
  include "../classes/select.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HMS, Hospital management system, hospital, clinics, LIS, inventory, pharmacy">
    <meta name="description" content="AN hospital management system for managing patients, doctors consultaion, nursing(ODP and inpatient), Dianostics, pharmacy and finances">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="icon" type="image/png" size="32x32" href="../images/icon.png">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../select2.min.css">
    
</head>
<body>
    <main>
      <?php
        if(isset($_GET['patient'])){
          $patient = $_GET['patient'];
        $get_foto = new selects();
        $rows = $get_foto->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($rows as $row){
          $foto = $row->photo;
          $name = $row->title." ".$row->last_name." ".$row->other_names;
        }
        // echo $foto;
      ?>
      <figure class="current_photo">
        <img src="<?php echo '../photos/'.$foto?>" alt="Photo">
      </figure>
      <h2 style="background:green;color:#fff; padding:5px; width:70%;margin:auto; text-align:center; font-size:1rem"><?php echo $name?></h2>
    <div class="container">	
  <div class="row">
	<div class="col-lg-6" align="center">
		<label>Capture live photo</label>
		<div id="my_camera" class="pre_capture_frame" ></div>
		<input type="hidden" name="captured_image_data" id="captured_image_data">
		<br>
    <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
		<input type="button" class="btn btn-info btn-round btn-file" value="Take Snapshot" onClick="take_snapshot()">	
	</div>
	<div class="col-lg-6" align="center">
		<label>Result</label>
		<div id="results" >
			<img style="width: 350px;" class="after_capture_frame" src="image_placeholder.jpg" />
		</div>
		<br>
		<button type="button" class="btn btn-success" onclick="saveSnap()">Save Picture</button>
	</div>	
  </div><!--  end row -->
</div><!-- end container -->

<?php }?>

    </main>
    <div class="close_page" style="width:50%;margin:20px auto">
  <a href="javascript:void()" title="Close page" style="background:brown;color:#fff;padding:10px;border-radius:15px; border:1px solid #fff; box-shadow:1px 1px 1px #222;text-align:center" onclick="window.close()">CLose <i class="fas fa-close"></i></a>
</div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script> -->

     <script src="../jquery-3.7.1.min.js"></script>
    <script src="../bootstrap-4.0.0/js/bootstrap.min.js"></script>
    <script src="../webcam.js"></script>
    <script src="../script.js"></script>

</body>
</html>