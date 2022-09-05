<?php include '../includes/database.php'; ?>
<?php session_start();
if(isset($_SESSION['maternal'])){
    $user = $_SESSION['maternal'];
}else{
    echo "<script>
    alert('Invalid Session Please relogin');
    window.location.href='../';
</script>";
}
?>
<?php
    if(isset($_POST['send'])){
        $date = $_POST['date'];
        $desc = $_POST['description'];
        $stage = $_POST['stage'];
        $user = $user;
        $sql = "INSERT INTO `appointments`(`maternal_uname`,`description`,`req_date`,`stage`)
        VALUES ('$user','$desc','$date','$stage')";
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "<script>
            alert('Appointment Sent Succesfully.');
            window.location.href='#';
        </script>";
        }else{
            echo "<script>
            alert('Failed to send Appointment');
            window.location.href='#';
        </script>";
        }
    }
?>
<?php
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `appointments` WHERE `id`='$id'";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "<script>
        alert('Appointment is deleted.');
        window.location.href='appointments.php';
    </script>";  
  }else{
    echo "<script>
	alert('Failed to delete Appoinment');
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
    <title>Maternals Appointments</title>
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
                <nav aria-label="breadcrumb mb-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                    </ol>
                </nav>
                <h1 class="h2">Appointments</h1>
                <!--modal-->
                <div class="container-fluid mt-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                        Make Appointment
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title m-0 p-0">
                                        <h6 class="text-info"> Provide Us some Appointment Details
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group row bg-light p-1 mb-2 border-rounded border-info">
                                            <div class="col-sm-1-12">
                                                <label for="inputName" class="col-sm-1-12 col-form-label">Martenity
                                                    Stage</label>
                                                <select class="form-select" name="stage" id="">
                                                    <option value="Pre Natal">Pre Natal</option>
                                                    <option value="Post Natal">Post Natal</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1-12">
                                                <label for="inputName" class="col-sm-1-12 col-form-label">Requested
                                                    Date for
                                                    Appointment</label>
                                                <input type="date" onclick="cdate()" class="form-control" name="date" id="date"
                                                    placeholder="">
                                                <small id="helpId" class="text-muted">*Date you want to see a
                                                    doctor.</small>

                                            </div>
                                            <div class="col-sm-1-12">
                                                <label for="inputName" class="col-sm-1-12 col-form-label">Appointment
                                                    Description</label>
                                                <textarea name="description" class="w-100" id="" cols="40"
                                                    rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" name="send" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="container ">
                    <!--Table for display appoinmtnts-->
                    <table class="table table-striped table-bordered rounded" border="1">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Date of Request</th>
                                <th>Appointment Description</th>
                                <th>Martenity Stage</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                        $sql = "SELECT * FROM `appointments` WHERE appointments.maternal_uname='$user'";  
                              $query = mysqli_query($conn,$sql);
                                $rows = mysqli_num_rows($query);
                                if($rows>0){                                   
                                    $num = 1;
                                    while($data = mysqli_fetch_assoc($query)){
                                        $id = $data['id'];
                                        ?>

                            <tr>
                                <td scope="row"><?php echo $num++ ; ?></td>
                                <td><?php echo $data['req_date'] ?></td>
                                <td><?php echo $data['description'] ?></td>
                                <td><?php echo $data['stage'] ?></td>
                                <td><?php $status = $data['status'];
                                    if($status==0){
                                        echo '<b class="text-secondary">';
                                        echo 'sent';
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
                                <td>
                                    <a href="?delete_id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Delete</a>
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
                </div>

            </main>
        </div>
    </div>
    <!--restrict previous date -->
    <script>
    function cdate() {
        var date = new Date().toJSON().slice(0, 10);
        document.getElementById("date").setAttribute("min", date);
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

</body>

</html>