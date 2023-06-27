<?php
include 'includes/header.php';
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-danger text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Dashboard
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
        <div class="row">
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-danger bg-gradient card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            Total Patients
                            <i class="mdi mdi-heart mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">0</h2>
                        <h6 class="card-text">Increased by 60%</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-danger bg-gradient card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">
                            Total Camps
                            <i class="mdi mdi-heart mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">
                            <?php
                                $url = "https://apis.stmorg.in/medical/camps/camps?count=true";
                                $data = get_api_data($url);
                                $data = json_decode($data, true);
                                $data = $data['data'];
                                echo $data[0]['count'];
                            ?>
                        </h2>
                        <h6 class="card-text">Decreased by 10%</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent records</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Record Id</th>
                                        <th>Diagnosis</th>
                                        <th>Prescription</th>
                                        <th>Doctor</th>
                                        <th>Last Visit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $url = "https://apis.stmorg.in/medical/records/records";
                                        $data = get_api_data($url);
                                        $data = json_decode($data, true);
                                        $data = $data['data'];
                        foreach ($data as $row) {
                                        $doctor = $row['doctor'];
                                        $url = "https://apis.stmorg.in/medical/doctors/doctors?did=".$doctor;
                                        $ddata = get_api_data($url);
                                        $ddata = json_decode($ddata, true);
                                        $ddata = $ddata['data'];
                                        $diag = $row['diagnosis'];
                                        $url = "https://apis.stmorg.in/medical/diagnosis/diagnosis?did=".$diag;
                                        $diagdata = get_api_data($url);
                                        $diagdata = json_decode($diagdata, true);
                                        $diagdata = $diagdata['data'];
                    ?>
                                    <tr onclick="window.location.href='recordview?id=<?php echo $row['id']; ?>'">
                                        <td>STMR<?php echo $row['id']; ?></td>
                                        <td><?php echo $diagdata[0]['name'] ?></td>
                                        <td><?php echo $row['prescription']; ?></td>
                                        <td><?php echo $ddata[0]['name'] ?></td>
                                        <td><?php echo $row['last_visit']; ?></td>
                                    </tr>
                                    <?php
                        }
                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php
    include 'includes/footer.php';
    ?>