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
<?php
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `notifications` WHERE `id`='$id'";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "<script>
        alert('Notification is deleted.');
        window.location.href='notifications.php';
    </script>";  
  }else{
    echo "<script>
	alert('Failed to delete notification');
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
    <title>Maternals Notifications</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                    </ol>
                </nav>
                <h1 class="h2">Notifications</h1>
                <div class="container ">
                    <!--Table for display appoinmtnts-->
                    <table class="table table-striped table-bordered rounded" border="1">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Appoinment Date</th>
                                <th>Appoinment Time</th>
                                <th>Received On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($_GET['view'])){
                                    $id = $_GET['view'];
                                    $sql = "SELECT * FROM `notifications` WHERE `id`='$id'";
                                }else{
                                    $sql = "SELECT * FROM `notifications` WHERE `maternal_uname`='$user'";
                                }
                                    $query = mysqli_query($conn,$sql);
                                    $rows = mysqli_num_rows($query);
                                    if($rows>0){                                   
                                        $num = 1;
                                        while($data = mysqli_fetch_assoc($query)){
                                            $id = $data['id'];
                                            ?>

                            <tr>
                                <td scope="row"><?php echo $num++ ; ?></td>
                                <td><?php echo $data['notification'] ?></td>
                                <td><?php echo $data['appointment_date'] ?></td>
                                <td><?php echo $data['appointment_time'] ?></td>
                                <td><?php echo $data['sent_on'] ?></td>
                                <td>
                                    <a href="?delete_id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php }
                                    }else{
                                        echo '<h6 class="text-center text-danger">';
                                        echo '<b>No Notifications for now. !!</b>';
                                        echo '</h6>';
                                    }                             
                                ?>
                        </tbody>
                    </table>
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