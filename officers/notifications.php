<?php include '../includes/database.php'; error_reporting(0);?>
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
if(isset($_POST['notify'])){
    $name = $_POST['name'];
    $message = $_POST['message'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
 //insert notifications.
    $sql = "INSERT INTO `notifications`(maternal_uname,phone,notification,appointment_date,appointment_time)
    VALUES('$name',$phone,'$message','$date','$time')";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "<script>
        alert('Notifications sent Successfully');
    </script>";
    $message = "Martenity Clinic: Hello $name, Your clinic Appointment has been accepted. You are expected on $date at $time Thanks.";
    }else{
        echo "<script>
    alert('Failed to send Notifications');
    window.location.href='notifications.php';
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
    <title>Notifications | SMS</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                    </ol>
                </nav>
                <h1 class="h2">SMS & Notifications</h1>
                <div class="container-fluid">

                    <div class="alert alert-success m-auto mb-1 col-11 alert-sm text-center alert-dismissible fade show"
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>
                            <?php
                            if(isset($_GET['sent'])){
                                echo 'Notifications has already been sent, You can send An SMS Also';
                            }else{
                                echo 'You are About to send a Notification or SMS, &nbsp;Maternal Name->' .$_GET['to'];
                            }
                            ?>

                        </strong>
                    </div>

                    <script>
                    $(".alert").alert();
                    </script>
                    <div class="container">
                        <div class="row">
                            <div class="col-6 m-auto bg-info">
                                <form class=" p-2 m-2 rounded" action="" method="post">
                                    <h5 for="">Send a Notifications</h5>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="">Maternal's Username</label>
                                            <input type="text" name="name" value="<?php echo $_GET['to'];?>"
                                                class="form-control" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone" value="<?php echo $_GET['phone'];?>"
                                                class="form-control" placeholder="" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Date of Appoinment</label>
                                            <input type="date" name="date" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Time of Appointment</label>
                                            <input type="time" name="time" class="form-control" placeholder=""
                                                aria-describedby="helpId">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Message</label>
                                            <select class="form-control form-select" name="message">
                                                <option>Congrats!! Your Clinic appointment has been accepted</option>
                                                <option>Sorry!! Your Clinic appointment has been denied</option>
                                            </select>
                                        </div>
                                        <div class="text-center m-2">
                                            <button type="submit" name="notify" class="btn btn-success">Send
                                                Notification</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--text-sms sending section-->
                            <div class="col-6  bg-info p-1 border-rounded">
                                <div class="form-group pt-1">
                                    <h5 for="">Send an SMS</h5>
                                    <small class="text-light">*Fields will be automatically
                                        generated if a notification is sent!</small>
                                    <form action="sendsms.php" method="post">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone" value="255<?php echo $_GET['phone'];?>"
                                                class="form-control" placeholder="" required>
                                        </div>
                                        <label for="">Message</label>
                                        <div class="form-group my-1">
                                            <textarea class="form-control" name="message" id=""
                                                value="<?php echo $message;?>" rows="2"
                                                required><?php echo $message;?></textarea>
                                        </div>
                                        <div class="text-center">
                                        <button type="submit" name="send" class="btn btn-success">Send SMS</button>
                                        </div>
                                    </form>
                                            
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

</body>

</html>