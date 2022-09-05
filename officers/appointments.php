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
<!--deny appointments -->
<?php
if(isset($_GET['deny'])){
    $denyid = $_GET['deny'];
    $sql = "UPDATE `appointments` SET `status`=2 WHERE `id`='$denyid'";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "<script>
        alert('Appointments has been marked as denied');
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
    <title>Medical Officer | Appointments</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                    </ol>
                </nav>
                <h1 class="h2">Appointments</h1>
                <div class="container ">
                    <!--Table for display appoinmtnts-->
                    <?php if(!isset($_GET['app_name'])){
?>
                    <table class="table table-striped table-bordered rounded" border="1">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Full Name </th>
                                <th>Date of Request</th>
                                <th>Appointment Description</th>
                                <th>Status</th>
                                <th>Stage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    $sql = "SELECT * FROM `appointments`";
                                $query = mysqli_query($conn,$sql);
                                $rows = mysqli_num_rows($query);
                                if($rows>0){                                   
                                    $num = 1;
                                    while($data = mysqli_fetch_assoc($query)){
                                        $id = $data['id'];
                                        $uname = $data['maternal_uname'];
                                        $stage = $data['stage'];
                                        ?>

                            <tr>
                                <td scope="row"><?php echo $num++ ; ?></td>
                                <td>
                                    <?php
                                     $infosql = "SELECT `fullname`,`username` FROM `maternals` WHERE `username`='$uname'";
                                    $querysql = mysqli_query($conn,$infosql);
                                    $info = mysqli_fetch_assoc($querysql);
                                    if($querysql = TRUE){
                                        $fullname = $info['fullname'];
                                        $uname = $info['username'];
                                        echo $fullname;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $data['req_date'] ?></td>
                                <td><?php echo $data['description'] ?></td>
                                <td><?php $status = $data['status'];
                                    if($status==0){
                                        echo '<b class="text-secondary">';
                                        echo 'Received';
                                        echo '</b>';
                                    }elseif($status==1){
                                        echo '<b class="text-success">';
                                        echo 'Approved';
                                        echo '</b>';
                                    }elseif($status==2){
                                        echo '<b class="text-danger">';
                                        echo 'Denied';
                                        echo '</b>';
                                    }
                                 ?></td>
                                 <td><?php echo $stage;?></td>
                                <td>
                                    <a type="button" data-bs-toggle="model" data-bs-target="#appointment"
                                        href="viewapp.php?app_id=<?php echo $id;?>&user=<?php echo $uname;?>"
                                        class="btn btn-success btn-sm">View
                                        More</a>
                                </td>
                            </tr>
                            <?php }
                                }else{
                                    echo '<h6 class="text-center text-danger">';
                                    echo '<b>No Appointments record Found !!</b>';
                                    echo '</h6>';
                                }
                                ?>
                        </tbody>
                    </table>
                    <?php  } ?>
                </div>
            </main>
        </div>
    </div>

</body>

</html>