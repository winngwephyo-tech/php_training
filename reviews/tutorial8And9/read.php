<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        require_once "config.php";

        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM staff WHERE ID = '$id'");

        if ($staff = mysqli_fetch_assoc($query)) {
            $staffName   = $staff["name"];
            $email       = $staff["email"];
            $phoneNumber = $staff["phone_no"];
            $salary     = $staff["salary"];
        } else {
            header("location: read.php");
            exit();
        }

        mysqli_close($conn);
    } else {
        header("location: read.php");
        exit();
    }
    ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1> Staff View</h1>
                    </div>
                    <div class="form-group">
                        <label>Staff Name</label>
                        <p class="form-control-static"><?php echo $staffName ?></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control-static"><?php echo $email ?></p>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <p class="form-control-static"><?php echo $phoneNumber ?></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p class="form-control-static"><?php echo $salary ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>