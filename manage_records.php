<?php
include 'includes/header.php';
$pid='';
if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
}else{
    $pid = '';
}
if(isset($_GET['rid'])){
    $rid = $_GET['rid'];
    $url = "https://apis.stmorg.in/medical/records/records?rid=".$rid;
    $data = get_api_data($url);
    $data = json_decode($data, true);
    $total_pages = $data['total_pages'];
    $data = $data['data'];
    $data = $data[0];
    $doctor = $data['doctor'];
    $diag = $data['diagnosis'];
    $pid = $data['pid'];
    $prescription = $data['prescription'];
    $last_visit = $data['last_visit'];
    $prescriptionfile = $data['prescriptionfile'];
    $status = $data['status'];
}else{
    $rid = '';
    $prescription = '';
    $last_visit = '';
    $diagnosis = '';
    $doctor = '';
    $prescriptionfile = '';
}
// send both $_POST and $_FILES via api
if (isset($_POST['pid']) && $_POST['pid'] != ''  && $_POST['rid'] == '') {
    $post = $_POST;
    echo "<script>console.log(" . json_encode($post) . ");</script>";
    $files = $_FILES['prescriptionfile'];
    $url = 'https://apis.stmorg.in/medical/records/add_records';
    $output = get_api_data_post($url, $post, $files);
    $output = json_decode($output, true);
    if ($output['status'] == 'success') {
        echo '<script>alert("Record Added Successfully");</script>';
    } else {
        echo '<script>alert("Record Not Added");</script>';
    }
}elseif(isset($_POST['pid']) && $_POST['pid'] != '' && $_POST['rid'] != ''){
    $post = $_POST;
    $url = 'https://apis.stmorg.in/medical/records/update_records';
    $output = get_api_data_post($url, $post);
    $output = json_decode($output, true);
    if ($output['status'] == 'success') {
        echo '<script>window.location.href="manage_records?rid='.$rid.'";</script>';
    } else {
        echo '<script>alert("Record Not Updated");</script>';
    }
}
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-danger text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Add Patients
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview
                        <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- form  -->
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Medical Record</h4>
                    <p class="card-description"> For proffesional use only </p>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Record Id</label>
                            <input type="text" class="form-control" name="rid" id="exampleInputUsername1"
                                placeholder="Record Id" value="<?php echo $rid; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Patient Id</label>
                            <input type="text" class="form-control" name="pid" id="exampleInputUsername1"
                                placeholder="Patient Id" value="<?php echo $pid; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Doctor Id</label>
                            <select class="form-control" name="doctor" id="exampleInputUsername1" required>
                                <option value="">Select Doctor</option>
                                <?php
                                $url = 'https://apis.stmorg.in/medical/doctors/doctors';
                                $output = get_api_data($url);
                                $output = json_decode($output, true);
                                foreach ($output['data'] as $key => $value) {
                                    if($value['id'] == $doctor){
                                        echo '<option value="' . $value['id'] . '" selected>' . $value['name'] . '</option>';
                                    }else{
                                        echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea1">Diagnosis</label>
                            <select class="form-control" name="diagnosis" id="exampleTextarea1" required>
                                <option value="">Select Diagnosis</option>
                                <?php
                                $url = 'https://apis.stmorg.in/medical/diagnosis/diagnosis';
                                $output = get_api_data($url);
                                $output = json_decode($output, true);
                                foreach ($output['data'] as $key => $value) {
                                    if($value['id'] == $diag){
                                        echo '<option value="' . $value['id'] . '" selected>' . $value['name'] . '</option>';
                                    }else{
                                        echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea2">Prescription</label>
                            <textarea class="form-control" name="prescription" value="<?php echo $prescription ?>"
                                id="exampleTextarea2" rows="6" required><?php echo $prescription ?></textarea>
                        </div>
                        <!-- status  -->
                        <div class="form-group">
                            <label for="exampleSelectGender">Status</label>
                            <select class="form-control" name="status" id="exampleSelectGender" required>
                                <option value="">Select Status</option>
                                <?php if($status == 0){
                                    echo '<option value="0" selected>Inactive</option>
                                    <option value="1">Active</option>';
                                }else{
                                    echo '<option value="0">Inactive</option>
                                    <option value="1" selected>Active</option>';
                                } ?>
                            </select>
                        </div>
                        <?php if($rid == ''){ ?>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="prescriptionfile" required />
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php
include 'includes/footer.php';
?>