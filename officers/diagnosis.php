<?php include '../includes/database.php'; ?>
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
if(isset($_POST['add-details'])){
    $name = $_POST['name'];
    $blood = $_POST['blood'];
    $weight = $_POST['weight'];
    $stage = $_POST['stage'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO `diagnosis`(maternal_uname,blood_group,weight,stage,remarks)
    VALUES('$name','$blood','$weight','$stage','$remarks')";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "<script>
    alert('Data recorded succesfully');
    window.location.href='maternals.php';
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
    <title>Diagnosis</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!--Librarys for search select chosen plugin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

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
                        <li class="breadcrumb-item active" aria-current="page">Diagnosis</li>
                    </ol>
                </nav>
                <h1 class="h2">Diagnosis</h1>
                <h5 class="text-center m-0 p-0 text-secondary">Maternal's Diagnosis Records Form</h5>
                <hr>
                <!--Step 1 fill in maternals name -->
                <div class="container-fluid">
                    <div class="container">
                        <div class="col-6 m-auto bg-light p-3 rounded">
                            <form action="" class=" p-1 m-auto" method="post">
                                <div class="form-group mb-2">
                                    <label for="">Full Name:</label><br>
                                    <select name="name" class="chosen w-100 form-group col-9"
                                        style="display: block;">
                                        <?php
                                    $sql = "SELECT * FROM `maternals`";
                                    $query = mysqli_query($conn,$sql);
                                    $num_rows = mysqli_num_rows($query);
                                    if($num_rows>0){
                                        while($data = mysqli_fetch_assoc($query)){
                                            ?>
                                        <option value="<?php echo $data['username']; ?>">
                                            <?php echo $data['fullname']; ?>
                                        </option>
                                        <?php
                                        }
                                    }
                                ?>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Blood Group:</label>
                                    <select class="form-select" name="blood">
                                        <option value="0+">Group 0+</option>
                                        <option value="0-">Group 0-</option>
                                        <option value="A-">Group A-</option>
                                        <option value="A+">Group A+</option>
                                        <option value="B-">Group B-</option>
                                        <option value="B+">Group B+</option>
                                        <option value="AB+">Group AB+</option>
                                        <option value="AB-">Group AB-</option>

                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Weight:</label>
                                    <input type="number" name="weight" id="" class="form-control" placeholder=""
                                        aria-describedby="helpId">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Stage:</label>
                                    <select class="form-select" name="stage">
                                        <option value="Pre Natal">Pre Natal</option>
                                        <option value="Post Natal">Post Natal</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Doctor Remarks:</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Short remarks on diagnosis"
                                        aria-describedby="helpId">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="add-details" class="btn btn-success">Add
                                        Records</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script type="text/javascript">
    $(".chosen").chosen();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

</body>

</html>