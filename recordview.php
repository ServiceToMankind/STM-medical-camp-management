<?php
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
    $doctor = $data[0]['doctor'];
    $url = "https://apis.stmorg.in/medical/doctors/doctors?did=".$doctor;
    $ddata = get_api_data($url);
    $ddata = json_decode($ddata, true);
    $ddata = $ddata['data'];
    $diag = $data[0]['diagnosis'];
    $url = "https://apis.stmorg.in/medical/diagnosis/diagnosis?did=".$diag;
    $diagdata = get_api_data($url);
    $diagdata = json_decode($diagdata, true);
    $diagdata = $diagdata['data'];
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
                            <p><b>Patient Id :</b> <?php echo $data[0]['pid']; ?></p>
                            <p><b>Record Id :</b> <?php echo $data[0]['id']; ?></p>
                        </div>
                        <p><b>Patient Name :</b> <?php echo $pdata[0]['name']; ?></p>
                        <p><b>Diagnosis :</b> <?php echo $diagdata[0]['name'] ?></p>
                        <p><b>Prescription :</b> <?php echo $data[0]['prescription']; ?></p>
                        <p><b>Doctor :</b> <?php echo $ddata[0]['name'] ?></p>
                        <p><b>Date :</b> <?php echo $data[0]['last_visit']; ?></p>
                        <div class="recordviewimg">
                            <p><b>Prescription Image :</b> </p>
                            <img src="<?php echo $data[0]['prescription_image']; ?>" alt="Prescription Image"
                                width="90%">
                        </div>

                    </div>
                    <!-- print button  -->
                    <div class="printbtn">
                        <a href="recordprint.php?id=<?php echo $rid; ?>" target="_blank"
                            class="btn btn-gradient-primary">Print</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php
include 'includes/footer.php';
?>