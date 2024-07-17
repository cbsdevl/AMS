
<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';



  
      



if(isset($_POST['save'])){
    
    $admissionNo=$_POST['admissionNo'];

    $check=$_POST['check'];
    $N = count($admissionNo);
    $status = "";


//check if the attendance has not been taken i.e if no record has a status of 1
  $qurty=mysqli_query($conn,"select * from tblattendance  where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]' and dateTimeTaken='$dateTaken' and status = '1'");
  $count = mysqli_num_rows($qurty);

  if($count > 0){

      $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Attendance has been taken for today!</div>";

  }

    else //update the status to 1 for the checkboxes checked
    {

        for($i = 0; $i < $N; $i++)
        {
                $admissionNo[$i]; //admission Number

                if(isset($check[$i])) //the checked checkboxes
                {
                      $qquery=mysqli_query($conn,"update tblattendance set status='1' where admissionNo = '$check[$i]'");

                      if ($qquery) {

                          $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Attendance Taken Successfully!</div>";
                      }
                      else
                      {
                          $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
                      }
                  
                }
          }
      }

   

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">



   <script>
    function classArmDropdown(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxClassArms2.php?cid="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
      <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
<div class="cont">
  
                  <!-- Form Basic -->
                  <style>
                    .atvir{
                      margin-left: 30px;
                      margin-top: 80px;
                    }
                  </style>
<div class="atvir">
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tblclass WHERE Id=$id";
$res = $conn->query($sql);

  while ($row = $res->fetch_assoc())
    {
echo "
  <h2 >Class Name:".$row['className']."</h2>
    <h2> Total Student:".$row['totalStudents']."</h2>
    <span><h3>Boys:".$row['boys']."</h3></span><span><h3>Girls:".$row['girls']."</h3></span></span>              
<form action='atdetails.php' method='post'>
  <table>
  <tr>
  <td></td>
  <td><input type='hidden' name='className' value='".$row['className']."' </td>
  </tr>
    <tr>
      <td>Prep Mode:</td>
      <td><select name='event' required id=''>
      <option value=''>--Select Event--</option>
      <option value='morning'>Morning Prep</option>    
      <option value='evening'>Evening Prep</option>    
    </select>
    </td>
    </tr>
<tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>

<tr>
    <td>Present Boys:</td>
    <td><input type='number' name='presentboys'>
    
</td>
</tr>
<tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>

<tr>
    <td>Absent Boys:</td>
    <td><input type='number' name='absentboys'>
</td>
</tr>
<tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>

<tr>
    <td>Present Girls:</td>
    <td><input type='number' name='presentgirls'>
</td>
</tr>
<tr>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>

<tr>
    <td>Absent Girls:</td>
    <td><input type='number' name='absentgirls'>
</td>
</tr>

<tr>
      <td></td>
      <td></td>
    </tr>
    
    <tr>
      <td></td>
      <td><input type='submit' name='take' class='btn btn-primary' value='Take Attandance'></td>
    </tr>

  </table>
</form>";
    }
?>
</div><br><br>

      <!-- Footer -->
       <?php include "Includes/footer.php";?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>