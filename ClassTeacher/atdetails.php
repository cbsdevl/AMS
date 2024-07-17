<?php
include '../includes/dbcon.php';
if (isset($_POST['take'])) {
    $className = $_POST['className'];
    $mode = $_POST['event'];
    $presentboys = $_POST['presentboys'];
    $absentboys= $_POST['absentboys'];
    $presentgirls = $_POST['presentgirls'];
    $absentgirls = $_POST['absentgirls'];

          $sql = "INSERT INTO atdetails (className,mode,presentboys,absentboys,presentgirls,absentgirls) VALUES ('$className','$mode','$presentboys','$absentboys','$presentgirls','$absentgirls')";
        mysqli_query($conn,$sql);
        }

?>

<?php 
error_reporting(0);
include '../Includes/session.php';


//session and Term
        $querey=mysqli_query($conn,"select * from tblsessionterm where isActive ='1'");
        $rwws=mysqli_fetch_array($querey);
        $sessionTermId = $rwws['Id'];

        $dateTaken = date("Y-m-d");

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
  
                  <!-- Form Basic -->
                  <div class='alert alert-success'>Data Taken Successfully! Then</div>
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Choose All Absent Students In <?php echo $className;?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Student in Class</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
<?php

$sql = "SELECT * FROM tblclass WHERE className = '$className'";
$res = $conn->query($sql);

  while ($row = $res->fetch_assoc())
    {
      $totalS = $row["totalStudents"];
      $total = $presentboys+$presentgirls;
    

if ($totalS == $total) {
  
    echo 'In '.$className.' The Total Number Of Students Is '. $totalS.' In '.$total;
  
    echo   
    '<div class="alert alert-danger" role="alert">
     No Absents Students In '.$className.' then
     </div>';
     echo "           <a href='takeAttendance.php' class='btn btn-primary'>Back To Take Attendance Of Another Class</a></button>
     ";
}else {
  echo '


  <!-- Input Group -->
  <form action="attend.php" method="post">
     <div class="row">
  <div class="col-lg-12">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">All Student In Classes</h6>
    </div>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Other Name</th>
            <th>Class</th>
            <th>Check Here</th>
          </tr>
        </thead>
        <input type="hidden" name="mode" value='.$mode.' class="form-control">
        <tbody>
        ';
        $query = "SELECT tblstudents.Id,tblclass.className,tblclassarms.classArmName,tblclassarms.Id AS classArmId,tblstudents.firstName,
        tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber,tblstudents.dateCreated
        FROM tblstudents
        JOIN tblclass ON tblclass.Id = tblstudents.classId
        INNER JOIN tblclassarms ON tblclassarms.Id = tblstudents.classArmId
        where tblclass.className = '$className'
        ";

          $rs = $conn->query($query);
          $num = $rs->num_rows;
          $sn=0;
          if($num > 0)
          { 
            while ($rows = $rs->fetch_assoc())
              {
                 $sn = $sn + 1;
                 
                echo "
                  <tr>
                    <td>".$sn."</td>
                    <td>".$rows["firstName"]."</td>
                    <td>".$rows["lastName"]."</td>
                    <td>".$rows["otherName"]."</td>
                    <td>".$rows["className"]."</td>
                    echo 
                    <td><input name='check[]' type='checkbox' value=".$rows["Id"]." class='form-control'></td>
                  </tr>";
              }

              
          }
          else
          {
               echo   
               '<div class="alert alert-danger" role="alert">
                No Record Found!
                </div>';
          }
          echo "
          
        </tbody>
      </table>
      <br>
      <button type='submit' name='sav' class='btn btn-primary'>Take Attendance</button>
        </form>
        ";
}
   
   
   
  }
    
?>
                </div>
              </div>
            </div>
            </div>
          </div>

</div>
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