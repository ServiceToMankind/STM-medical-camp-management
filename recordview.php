<?php
// show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'includes/header.php';
if(isset($_GET['id'])){
    $rid = $_GET['id'];
    $url = "https://apis.stmorg.in/medical/records/records?rid=".$rid;
    $data = get_api_data($url);
    $data = json_decode($data, true);
    $data = $data['data'];
    $pid = $data[0]['pid'];
    $url = "https://apis.stmorg.in/medical/patients/patients?pquery=".$pid;
    $pdata = get_api_data($url);
    $pdata = json_decode($pdata, true);
    $pdata = $pdata['data'];
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
                Record View
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">View Records</h4>
                    <p class="card-description">Data must be verified.</p>
                    <!-- Full Record  -->
                    <div class="viewrecord">
                        <div class="viewrecordid">
                            <p><b>Patient Id:</b> <?php echo $data[0]['pid']; ?></p>
                            <p><b>Record Id:</b> <?php echo $data[0]['id']; ?></p>
                        </div>
                        <p><b>Patient Name:</b> <?php echo $pdata[0]['name']; ?></p>
                        <p><b>Diagnosis:</b> <?php echo $data[0]['diagnosis']; ?></p>
                        <p><b>Prescription:</b> <?php echo $data[0]['prescription']; ?></p>
                        <div class="recordviewimg">
                            <p><b>Prescription Image:</b> </p>
                            <img src="https://storage.googleapis.com/weber_storage/<?php echo $data[0]['prescription_image']; ?>"
                                alt="Prescription Image" width="90%">
                        </div>
                        <p><b>Doctor:</b> <?php echo $data[0]['doctor']; ?></p>
                        <p><b>Last Visit:</b> <?php echo $data[0]['last_visit']; ?></p>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php
include 'includes/footer.php';
?>