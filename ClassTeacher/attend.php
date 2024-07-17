<?php
include '../includes/dbcon.php';


                    if(isset($_POST['sav'])){
    

    $check=$_POST['check'];
    $N = count($check);
    $mode = $_POST['mode'];

        for($i = 0; $i < $N; $i++)
        {
            $query = "SELECT tblstudents.Id,tblclass.className,tblclassarms.classArmName,tblclassarms.Id AS classArmId,tblstudents.firstName,
            tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber,tblstudents.dateCreated
            FROM tblstudents
            JOIN tblclass ON tblclass.Id = tblstudents.classId
            INNER JOIN tblclassarms ON tblclassarms.Id = tblstudents.classArmId
            where tblstudents.Id = '$check[$i]'
            ";
            $rs = $conn->query($query);
              while ($rows = $rs->fetch_assoc())
                {
                 $a = $rows['firstName'];
                 $b = $rows['lastName'];  
                 $c = $rows['className']; 
                 $d = $rows['otherName']; 
  
                }
            
                $s = "INSERT INTO absents (firstName,lastName,otherName,className,mode) VALUES ('$a','$b','$d','$c','$mode')";
                mysqli_query($conn,$s);

                if(isset($check[$i])) //the checked checkboxes
                {

                }
          }
      }

   




?>

