<?php
session_start();
include 'includes/functions.php';
if(isset($_POST['name']) && isset($_POST['pass'])){

    $name=$_POST['name'];
    $pass=$_POST['pass'];
    $camp_id = $_POST['camp'];

    $data=get_api_data("https://apis.stmorg.in/common/login?username=".$name."&password=".$pass);
    $data=json_decode($data,true);
    // Check for API errors
    if ($data['status'] !== "success") {
        echo "API error: " . $data['data'];
        exit;
    }
    // Get payment logs data
    $user_data = $data['data'];
    $_SESSION['ID']=$user_data['id'];
    $_SESSION['NAME']=$user_data['name'];
    $_SESSION['EMAIL']=$user_data['mail'];
    $_SESSION['ROLE_ID']=$user_data['role'];
    $_SESSION['CAMP_ID']=$camp_id;

    if($_SESSION['ROLE_ID']!=''){
        $role_id=$_SESSION['ROLE_ID'];
        $data=get_api_data("https://apis.stmorg.in/global/roles?role=".$role_id);
        $data=json_decode($data,true);
        // Check for API errors
        if ($data['status'] !== "success") {
            echo "API error: " . $data['data'];
            exit;
        }
        // Get payment logs data
        $role_data = $data['data'];
        // print_r($role_data);
        // die();
        $_SESSION['ROLE_NAME']=$role_data[0]['role-name'];
    }

}
if(isset($_SESSION['ID']) && $_SESSION['ID']!=''){
    // header('location:index.php');
    echo "<script>window.location.href='index.php'</script>";
}
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Medico Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img style="width: 80px;" src="assets/images/logoui.svg">
                            </div>
                            <h4>STM Medical Management System</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" method="POST">
                                <div class="form-group">
                                    <select class="form-control" name="camp">
                                        <option value="">Select Camp</option>
                                        <?php
                                            $data=get_api_data("https://apis.stmorg.in/medical/camps/camps");
                                            $data=json_decode($data,true);
                                            // Check for API errors
                                            // if ($data['status'] !== "success") {
                                            //     echo "API error: " . $data['data'];
                                            //     exit;
                                            // }
                                            // Get payment logs data
                                            $camp_data = $data['data'];
                                            foreach($camp_data as $camp){
                                                echo "<option value='".$camp['id']."'>".$camp['camp_name']."</option>";
                                            }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        placeholder="Email" name="name">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" name="pass">
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                        IN</button>
                                </div>
                                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>