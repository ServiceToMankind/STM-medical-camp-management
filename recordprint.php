<?php 
include('includes/functions.php');
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css" />
    <!-- ovveride css -->
    <link rel="stylesheet" href="assets/css/custom_override.css?v=1" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css" />

    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <script>
    window.onload = function() {
        window.print();
    }
    </script>
    <style>
    body {
        height: 100vh;
    }

    .viewrecord.top {
        border: 1px solid;
        padding: 1em;

    }

    .main-col {
        width: 50%;
        display: flex;

    }

    .main-col .row {
        margin: 0;
    }

    .row-col {
        display: flex;
    }

    .pre {
        white-space: pre-wrap;
        margin-top: 1.5em;
    }

    .pre .main-col {
        flex-direction: column;
    }
    </style>
</head>

<body>
    <header style="text-align: center;     height: 12vh;">
        <img src="assets/arundhati/header.jpg" alt="Lights">
    </header>
    <main style="margin: auto 10%;margin-top: 0.1em;">
        <p style="text-align: center;
    font-style: italic;">The following camp was conducted by Service to Mankind (https://stmorg.in)</p>
        <div class="viewrecord top">

            <div class="row-col">
                <div class="main-col">
                    <h5>Patient Name : <?php echo $pdata[0]['name']; ?></h5>
                </div>
                <div class="main-col">
                    <h5>Patient Id : <?php echo $data[0]['pid']; ?></h5>
                </div>
            </div>
            <div class="row-col">
                <div class="main-col">
                    <h5>Diagnosis : <?php echo $diagdata[0]['name']; ?></h5>
                </div>
                <div class="main-col">
                    <h5>Doctor <?php echo $ddata[0]['name']; ?></h5>
                </div>
            </div>
            <div class="row-col">
                <div class="main-col">
                    <h5>Record Id : <?php echo $data[0]['id']; ?></h5>
                </div>
                <div class="main-col">
                    <h5>Date : <?php echo $data[0]['last_visit']; ?></h5>
                </div>
            </div>
        </div>
        <div class="viewrecord bottom">
            <div class="row-col pre">
                <div class="main-col">
                    <h5>Prescription : </h5>
                    <p><?php echo $data[0]['prescription']; ?></p>
                </div>
            </div>
        </div>
    </main>
    <footer style="text-align: center;height: 8.5vh;
        position: absolute;
    width: 100%;
    bottom: 0;">
        <img src=" assets/arundhati/footer.jpg" alt="Lights">
    </footer>
</body>

</html>