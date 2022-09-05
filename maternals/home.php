<?php include '../includes/database.php'; ?>
<?php session_start();
if(isset($_SESSION['maternal'])){
    $user = $_SESSION['maternal'];
}else{
    echo "<script>
    alert('Invalid Seesion Please relogin');
    window.location.href='../';
</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maternals Dashboard</title>
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
    <?php include '../includes/header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <?php include '../includes/maternals-nav.php' ?>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Overview</li>
                    </ol>
                </nav>
                <h1 class="h2">Dashboard</h1>

                <div class="row my-4">
                    <div class="col-7 col-md-5  mb-4 text-light ">
                        <div class="card bg-info">
                            <h5 class="card-header">Appointment Requests</h5>
                            <div class="card-body">
                                <h5 class="card-title text-center m-auto">
                                    <div class="text-center">
                                        <?php
                                $sql = "SELECT * FROM `appointments` WHERE `maternal_uname`='$user'";
                                $query = mysqli_query($conn,$sql);
                                if($num = mysqli_num_rows($query))
                                {
                                    echo '<h3>';
                                   echo $num ;
                                   echo '</h3>';
                                }else{
                                    echo '<h3>';
                                   echo '0' ;
                                   echo '</h3>';
                                }?>
                                    </div>

                                </h5>
                                <hr class="p-0 m-0">
                                <p class="card-text  text-center"><b><a class="text-light" href="appointments.php">View
                                            More</a></b></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-7 col-md-5  mb-4 text-light">
                        <div class="card bg-success">
                            <h5 class="card-header">Notifications</h5>
                            <div class="card-body">
                                <h5 class="card-title text-center m-auto">
                                    <div class="text-center">
                                        <?php
                                $sql = "SELECT * FROM `notifications` WHERE `maternal_uname`='$user'";
                                $query = mysqli_query($conn,$sql);
                                if($num = mysqli_num_rows($query))
                                {
                                    echo '<h3>';
                                   echo $num ;
                                   echo '</h3>';
                                }else{
                                    echo '<h3>';
                                   echo '0' ;
                                   echo '</h3>';
                                }?>
                                    </div>

                                </h5>
                                <hr class="p-0 m-0">
                                <p class="card-text text-center"><b><a href="notifications.php" class="text-light">View
                                            More</a></b></p>
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