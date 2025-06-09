<?php

/**
 * DASHBOARD DATA
 */

function getInfoSheetTotal ($field){
    include("db_connect.php");

    $sql = "";

    if($field != "all") {
        $sql = "SELECT SUM($field) AS total FROM information_sheet";
    }else{
        $sql = "SELECT SUM(landbased + seafarer + rehire) AS total FROM information_sheet";
    }
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row["total"];
    } else {
        return 0;
    }
    $conn->close();

    return $total;
}


function getTotalResumptionByGender($gender){
    include("db_connect.php");
    $sql = "SELECT COUNT(*) AS total FROM work_resumption WHERE sex = '$gender'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row["total"];
    } else {
        return 0;
    }
    $conn->close();
    return $total;
}

function getTotalGovToGovByGender($gender){
    include("db_connect.php");
    $sql = "SELECT COUNT(*) AS total FROM gov_to_gov WHERE sex = '$gender'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row["total"];
    } else {
        return 0;
    }
    $conn->close();
    return $total;
}

function getLocationByYear(){
    include("db_connect.php");
    $sql = "SELECT YEAR(date) AS year, SUM(male) AS total_male, SUM(female) AS total_female
        FROM information_sheet
        GROUP BY YEAR(date)
        ORDER BY YEAR(date)";

    $result = $conn->query($sql);
    $yearlyData = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $year = $row["year"];
            $yearlyData[$year] = [
                'male' => (int)$row["total_male"],
                'female' => (int)$row["total_female"],
            ];
        }

        return $yearlyData;
    } else {
        return [];
    }

    $conn->close();
}


function getData($id, $table){
    include("db_connect.php");

    $data = null; 

    $sql = "SELECT *
            FROM $table
            WHERE id = $id LIMIT 1";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc(); 
    }

    $conn->close();
    return $data;
}

function getUser($user_id) {
    include("db_connect.php");
    $data = null;

    $sql = "SELECT users.*, permissions.*
            FROM users
            JOIN permissions ON users.account_type = permissions.account_type
            WHERE users.id = ?
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
        }

        $stmt->close();
    }

    $conn->close();
    return $data;
}

function getUnapproved(){
    include("db_connect.php");
    $data = [];

    $sql = "SELECT *
            FROM users
            WHERE is_approved = 0";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC); 
        }
        $stmt->close();
    }

    $conn->close();
    return $data;
}

function getDashboardGraphData(){

    $locationByYearLabels = [];
    $locationByYearMale = [];
    $locationByYearFemale = [];

    $workResumptionGenderLabels = ['Male', 'Female'];
    $workResumptionGenderValues = [getTotalResumptionByGender("Male"), getTotalResumptionByGender("Female")];
    $workResumptionGenderColors = ['#4C84FF', '#202A39'];

    $govtToGovtGenderLabels = ['Male', 'Female'];
    $govtToGovtGenderValues = [getTotalGovToGovByGender("Male"), getTotalGovToGovByGender("Female")];
    $govtToGovtGenderColors = ['#4C84FF', '#202A39'];


    $yearlyData = getLocationByYear();
    foreach ($yearlyData as $year => $counts) {
        $locationByYearLabels[] = $year;
        $locationByYearMale[] = $counts['male'];
        $locationByYearFemale[] = $counts['female'];
    }

    $dashboardData = [
        'userStats' => [
            'totalUsers' => number_format(getInfoSheetTotal("landbased")),
            'newUsers' => number_format(getInfoSheetTotal("rehire")),
            'activeUsers' => number_format(getInfoSheetTotal("seafarer")),
            'returningUsers' => number_format(getInfoSheetTotal("all")),
        ],
        'locationByYear' => [
            'labels' => $locationByYearLabels,
            'male' => $locationByYearMale,
            'female' => $locationByYearFemale,
        ],
        'WorkresumptionGender' => [
            'labels' => $workResumptionGenderLabels,
            'values' => $workResumptionGenderValues,
            'colors' => $workResumptionGenderColors,
        ],
        'GovernmentToGovernmentGender' => [
            'labels' => $govtToGovtGenderLabels,
            'values' => $govtToGovtGenderValues,
            'colors' => $govtToGovtGenderColors,
        ],
    ];

    return json_encode ($dashboardData);
}

/**
 * END DASHBOARD DATA
 */

function generateForm(){

}


function generateDataTable($headers = [], $data = [], $noData = "No Data", $hasAction = false, $viewDetails = false, $actionRenderer = null) {
    $thead = "<thead><tr>";
    foreach ($headers as $header) {
        $thead .= "<th>" . $header . "</th>";
    }
    if ($hasAction) {
        $thead .= "<th class='actions-column'>Actions</th>";
    }
    $thead .= "</tr></thead>";

    $tbody = "<tbody>";
    if (!empty($data)) {
        foreach ($data as $key => $values) {
            $tbody .= "<tr>";

            for ($i = 0; $i < count($values) - 1; $i++) {
                $tbody .= "<td>" . $values[$i] . "</td>";
            }

            if ($hasAction && !empty($values)) {
                $lastValue = end($values); 
                $tbody .= "<td class='action-buttons'>";

                if (is_callable($actionRenderer)) {

                    $tbody .= $actionRenderer($values, $lastValue);
                } else {
 
                    $tbody .= "<a class='icon-btn edit-btn' href='?action=edit&id=" . htmlspecialchars($lastValue) . "'><i class='fas fa-edit'></i></a>";
                    $tbody .= "<a class='icon-btn delete-btn' href='?action=delete&id=" . htmlspecialchars($lastValue) . "' data-id='" . htmlspecialchars($lastValue) . "'><i class='fas fa-trash'></i></a>";

                    if ($viewDetails) {
                        $tbody .= "<button class='icon-btn view-btn' data-id='" . htmlspecialchars($lastValue) . "'><i class='fas fa-eye'></i></button>";
                    }
                }

                $tbody .= "</td>";
            }

            $tbody .= "</tr>";
        }
    } else {
        $colspan = count($headers) + ($hasAction ? 1 : 0);
        $tbody .= "<tr><td colspan='{$colspan}'>{$noData}</td></tr>";
    }
    $tbody .= "</tbody>";

    return "<table class='data-table'>" . $thead . $tbody . "</table>";
}

//Upload File 
function uploadFile($file, $upload_dir = "uploads/") {

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
    $max_file_size = 25 * 1024 * 1024; // 25MB

    if (empty($file["name"])) return false;

    $file_tmp  = $file["tmp_name"];
    $file_size = $file["size"];
    $file_type = mime_content_type($file_tmp);
    $file_ext  = pathinfo($file["name"], PATHINFO_EXTENSION);

    if (!in_array($file_type, $allowed_types)) return false;
    if ($file_size > $max_file_size) return false;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $random_str = bin2hex(random_bytes(8)); // 16 characters
    $file_name = $random_str . "_" . time() . "." . $file_ext;
    $destination = $upload_dir . $file_name;

    if (move_uploaded_file($file_tmp, $destination)) {
        return $destination;
    }

    return false;
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}