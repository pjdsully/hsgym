<?php

ini_set('display_errors', 'On'); // TODO: turn display_errors off in production
require 'config.php';

$dbname = $config["db"]["dbname"];
$host = $config["db"]["host"];
$dbusername = $config["db"]["username"];
$dbpassword = $config["db"]["password"];
$db = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

// TODO: Generalize this. It is dep. on my network specifically
function requestIsInternal() {
    if (php_sapi_name() === 'cli') {
        return true;
    }
    $remoteIP = $_SERVER['REMOTE_ADDR'];
    return preg_match('/^10\.0\.0\./', $remoteIP);
}

function insertParticipant($family, $rowNum) {
    global $db;

    if($statement = $db->prepare("INSERT INTO participant (family, fullName, birthMonth, birthYear, grade, parentConcerns) VALUES (?,?,?,?,?,?)")) {
        $fullName = $_POST['name_' . $rowNum];
        $birthMonth = $_POST['dobm_' . $rowNum];
        $birthYear = $_POST['doby_' . $rowNum];
        $grade = $_POST['grade_' . $rowNum];
        $parentConcerns = $_POST['restrictions_' . $rowNum];
        if ($parentConcerns == '') {
            $parentConcerns = NULL;
        }
        $statement->bind_param("isiiis", $family, $fullName, $birthMonth, $birthYear, $grade, $parentConcerns);
        $statement->execute();
    }
}

function insertFamily() {
    global $db;
    global $config;
    
    if($statement = $db->prepare("INSERT INTO family (schoolYear, fullNames, address, cityStateZip, telephone, cell, email, newToMinistry, yearsParticipated, parish, parishCity)VALUES (?,?,?,?,?,?,?,?,?,?,?)")) {
        $schoolYear = $config['schoolYear'];
        $fullNames = $_POST['pname'];
        $address = $_POST['address'];
        $cityStateZip = $_POST['city'];
        $telephone = $_POST['telephone'];
        $cell = $_POST['cellphone'];
        $email = $_POST['email'];
        $newToMinistry = $_POST['new'];
        $yearsParticipated = $_POST['years'];
        $parish = $_POST['parish'];
        $parishCity = $_POST['pcity'];

        $statement->bind_param("issssssiiss", $schoolYear, $fullNames, $address, $cityStateZip, $telephone, $cell, $email, $newToMinistry, $yearsParticipated, $parish, $parishCity);
        $statement->execute();

        $family = $db->insert_id;

        $children = $_POST['count'];

        for ($i = 1; $i <= $children; ++$i) {
            // TODO: Error checking?
            insertParticipant($family, $i);
        }
    }
}
?>
