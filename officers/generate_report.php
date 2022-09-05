<?php session_start();
if(isset($_SESSION['officer'])){
    $user = $_SESSION['officer'];
}else{
    echo "<script>
    alert('Invalid Session Please relogin');
    window.location.href='../admin.php';
</script>";
}
?>
<!--pdf  maternals generation-->
<?php
 function fetch_maternals()  
 {   
      include "../includes/database.php";
      $sql = "SELECT * FROM `maternals` ORDER BY id ASC";  
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result))  
      {   
          $data .='<tbody>
               <tr>
                    <td>'.$row["id"].'</td>
                    <td>'.$row["fullname"].'</td>
                    <td>'.$row["email"].'</td>
                    <td>'.$row["address"].'</td>
                    <td>'.$row["birth_date"].'</td>  
                    <td>'.$row["phone"].'</td>      
               </tr>
          </tbody>';
      } 
      return $data;


 }
 ?>

<?php

 if(isset($_POST["maternal_report"]))  
 {  
      include ('../library/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Maternals System General Report.");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage(); 
      $content = '';
      $content .= '<h3 align="center">Maternals System Report.</h3><br>
          *This is General  maternals report from the System .<br><br>
          <table border="0" style="border-color: red;border-right-width: 0.01px solid black;">
                        <tr>
                              <td style="color: green;">ID</td>
                            <td style="color: green;">Maternals Name</td>
                            <td style="color: green;">Email Address</td>
                            <td style="color: green;">Residency</td>
                            <td style="color: green;">BirthDate</td>
                            <td style="color: green;">PhoneNumber</td>

                      </tr>
      ';   
      $content .= fetch_maternals();  
      $obj_pdf->writeHTML($content); 
      ob_end_clean(); 
      $obj_pdf->Output('maternalsreport.pdf', 'I');  
 } 
?>
<!--Children reports -->

<?php
 function fetch_child()  
 {   
      include "../includes/database.php";
      $sql = "SELECT * FROM `child` ORDER BY id ASC";  
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result))  
      {   
          $data .='<tbody>
               <tr>
                    <td>'.$row["child_name"].'</td>
                    <td>'.$row["maternal_uname"].'</td>
                    <td>'.$row["gender"].'</td>
                    <td>'.$row["blood_group"].'</td>  
                    <td>'.$row["weight"].'</td>          
                    <td>'.$row["vaccinated"].'</td> 
                    <td>'.$row["remarks"].'</td>                  
               </tr>
          </tbody>';
      } 
      return $data;


 }
 ?>

<?php

 if(isset($_POST["child_report"]))  
 {  
      include ('../library/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Maternals System General Report.");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage(); 
      $content = '';
      $content .= ' <h3 align="center">Childrens System Report.</h3><br>
          *This is Childrens  report for the Maternal System.<br><br>
          <table border="1">
                        <tr>
                        <td style="color: green;">Childs Name</td>
                        <td style="color: green;">Mothers Username</td>
                        <td style="color: green;">Gender</td>
                        <td style="color: green;">Blood Group</td>  
                        <td style="color: green;">Weight</td>          
                        <td style="color: green;">Vaccinated?</td> 
                        <td style="color: green;">Dr.Remarks</td> 
                      </tr>
      ';   
      $content .= fetch_child();  
      $obj_pdf->writeHTML($content); 
      ob_end_clean(); 
      $obj_pdf->Output('childrenreport.pdf', 'I');  
 } 
?>
<!--pdf  apointment generation-->
<?php
 function fetch_appointment()  
 {   
      include "../includes/database.php";
      $sql = "SELECT * FROM `appointments` ORDER BY id ASC";  
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result))  
      {   
          $data .='<tbody>
               <tr>
                    <td>'.$row["maternal_uname"].'</td>
                    <td>'.$row["stage"].'</td>
                    <td>'.$row["description"].'</td>
                    <td>'.$row["req_date"].'</td>   
                    <td>'.$row["status"].'</td>          
       
               </tr>
          </tbody>';
      } 
      return $data;


 }
 ?>

<?php

 if(isset($_POST["appointment_report"]))  
 {  
      include ('../library/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Maternals System General Report.");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage(); 
      $content = '';
      $content .= ' <h3 align="center">Maternals System Report.</h3><br>
          *This is Appoinments report for the system.<br><br>
          <table border="1"  style="background-color: blue;">
                        <tr>
                            <td style="color: green;">Maternal</td>
                            <td style="color: green;">Maternal Stage</td>
                            <td style="color: green;">Description</td>
                            <td style="color: green;">Req. Date</td>
                            <td style="color: green;">App. Status
                            <small>1 = Approved</small>
                            </td>
                      </tr>
      ';   
      $content .= fetch_appointment();  
      $obj_pdf->writeHTML($content); 
      ob_end_clean(); 
      $obj_pdf->Output('appoinmentsreport.pdf', 'I');  
 } 
?>