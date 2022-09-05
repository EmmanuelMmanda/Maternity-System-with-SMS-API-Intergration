<?php include '../includes/database.php';?>
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
<?php
if(isset($_GET['app_id'])){
    $app_id = $_GET['app_id'];
    $sql = "SELECT * FROM `appointments`  WHERE `id`='$app_id'";
    $query = mysqli_query($conn,$sql);
    if($query==TRUE){
        if($data = mysqli_fetch_assoc($query)){
            $req_date = $data['req_date'];
            $desc = $data['description'];
            $status = $data['status'];
        }
    }
}
//check if url has user parameter
 if(isset($_GET['user'])){
    $username = $_GET['user'];
    $sql = "SELECT * FROM `diagnosis`  WHERE `maternal_uname`='$username'";
    $query = mysqli_query($conn,$sql);
    if($query==TRUE){
        if($data = mysqli_fetch_assoc($query)){
            $weight = $data['weight'];
            $blood = $data['blood_group'];
            $stage = $data['stage'];
            $remarks = $data['remarks'];
            $queryname = $data['maternal_uname'];
        }} 
        //then get maternals data.. 
        $sql = "SELECT * FROM `maternals` WHERE username = '$username'";
        $query = mysqli_query($conn,$sql);
        if($query==TRUE){
            if($data = mysqli_fetch_assoc($query)){
                $user = $data['username'];
                $fullname = $data['fullname'];
                $phone = $data['phone'];
                $address = $data['address'];
                $birthdate = $data['birth_date'];

            }
        }
 }
 
?>
<?php
//accept appointments
if(isset($_POST['accept_app'])){
    $date = $_POST['date'];
    $time = $_POST['time'];
    $sql = "UPDATE `appointments` SET `status`=1 WHERE `id`='$app_id'";
    $query = mysqli_query($conn,$sql);
    if($query){
        $message = "Martenity Clinic: Hello $user, Your clinic Appointment has been accepted. You are expected on $date at $time Thanks.";
        $sql = "INSERT INTO `notifications`(maternal_uname,phone,notification,appointment_date,appointment_time)
            VALUES('$user',$phone,'$message','$date','$time')";
            $query = mysqli_query($conn,$sql);
            if($query){
                echo "<script>
                alert('Appoinments has been Approved ! You will be notified via SMS and Notification.');
                window.location.href='appointments.php';
                </script>";
            
            //sendi sms messages ---
            $message = "Martenity Clinic: Hello $user, Your clinic Appointment has been accepted. You are expected on $date at $time Thanks.";
                
            $api_key='0e202e87941163b0';
                $secret_key = 'ODY5NTQyMjczM2E1NmYxYmM1NTdmNDE5MTg4YjJlZDk5N2I0ZmM0OWMzODI3MjUzZTg4OTZiOTkyYmQzMWIxOA==';

                $postData = array(
                    'source_addr' => 'INFO',
                    'encoding'=>0,
                    'schedule_time' => '',
                    'message' => $message,
                    'recipients' => [array('recipient_id' => '1','dest_addr'=> $phone)]
                );

                $Url ='https://apisms.beem.africa/v1/send';

                $ch = curl_init($Url);
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt_array($ch, array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => array(
                        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                        'Content-Type: application/json'
                    ),
                    CURLOPT_POSTFIELDS => json_encode($postData)
                ));

                $response = curl_exec($ch);

                if($response === FALSE){
                        echo $response;

                    die(curl_error($ch));
                }
                if($response == TRUE){
                    echo "<script>
                    alert('Message was sent Succesfully');
                    window.location.href='appointments.php';
                    </script>";
                }else{
                    echo "<script>
                    alert('Failed to send Message !! Probably check your internet connection');
                    window.location.href='appointments.php';
                    </script>";
                }
            }else{
                echo "<script>
            alert('Failed to send Notifications');
            window.location.href='appointments.php';
        </script>";
            }
        
    }else{
        echo "<script>
    alert('Failed to Approve appoinment');
    window.location.href='appointments.php';
    </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Officer | View Appointments</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 90px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        z-index: 99;
        font-size: 18px;

    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 11.5rem;
            padding: 0;
        }
    }

    .navbar {
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
    }

    @media (min-width: 767.98px) {
        .navbar {
            top: 0;
            position: sticky;
            z-index: 999;
        }
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }
    </style>
</head>

<body>
    <?php include '../includes/officer_header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <?php include '../includes/officer_nav.php' ?>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Appointments</li>
                    </ol>
                </nav>
                <h1 class="h2"></h1>
                <div class="container-fluid ">
                    <div class="container">
                        <div class="card col-11 p-2 m-auto bg-light">
                            <div class="card-body p-2">
                                <div class="row mx-2">
                                    <p> <u>Appoinment Details</u> </p>
                                    <div class="col-6">
                                        <label for="">Date Maternal Requests:</label>
                                        <p><?php echo $req_date; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Appoinments Description:</label>
                                        <p><?php echo $desc; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Status:</label>
                                        <p><?php 
                                        if($status==0){
                                            echo 'Received';
                                        }elseif($status==1){
                                            echo 'Approved';
                                            
                                        }elseif($status==2){
                                            echo 'Denied';
                                        }
                                         ?></p>
                                    </div>
                                    <hr>
                                    <p> <u>Profile Information</u> </p>
                                    <div class="col-6">
                                        <label for="">Full Name:</label>
                                        <p><?php echo $fullname; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Phone Number:</label>
                                        <p><?php echo $phone; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Address/Residency:</label>
                                        <p><?php echo $address; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Date of Birth:</label>
                                        <p><?php echo $birthdate; ?></p>
                                    </div>
                                    <hr>
                                    <p> <u>Diagosis Information</u> </p>
                                    <div class="col-6">
                                        <label for="">Weight:</label>
                                        <p><?php echo $weight; ?> kg</p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Blood Group:</label>
                                        <p><?php echo $blood; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Stage:</label>
                                        <p><?php echo $stage; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Remarks:</label>
                                        <p><?php echo $remarks; ?></p>
                                    </div>
                                    <hr>
                                    <p> <u>Appoinment Information </u><small class="text-danger">*sent to
                                            maternals</small> </p>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone" value="255<?php echo $phone;?>"
                                                class="form-control" placeholder="" required>
                                        </div>
                                        <div class="d-flex">
                                            <div class="form-group col-6">
                                                <label for="">Date of Appoinment</label>
                                                <input type="date" name="date" id="date" onclick="cdate()" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Time of Appointment</label>
                                                <input type="time" name="time" class="form-control" placeholder=""
                                                    aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-5 mt-3 m-auto text-center">
                                            <?php 
                                            if($status==0){
                                                        echo '<button type="submit" name="accept_app" class="btn btn-success">Approve
                                                            Appoinment</button>';
                                                    echo '
                                            <a href="appointments.php?deny='.$app_id.'" class="btn btn-danger">Deny
                                                Appoinment</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

        </main>
    </div>
    </div>
    <script>
function cdate() {
 var date = new Date().toJSON().slice(0, 10);
  document.getElementById("date").setAttribute("min", date); 
}
</script>
</body>

</html>