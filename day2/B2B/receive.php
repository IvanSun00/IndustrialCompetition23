<?php
require("connect.php");
$db = $conn;
$tableName = "day2_bid";
$columns = ['id', 'id_post', 'id_kelompok', 'timestamp'];
$bids = fetch_bid($db, $tableName, $columns);
$fixes = fetch_fixed($db, $tableName, $columns);
$bidCheck = bid_check($db, $tableName, $columns);

$query = "SELECT day FROM day2_day";
$stmt = $db->query($query);
$days = ($stmt->fetch());
$updatedDay = $days['day'];
function fetch_bid($db, $tableName, $columns) {
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "Columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $query = "SELECT " . "*" . 
        " FROM day2_bid 
        where day <= (SELECT day from day2_day) AND result_day > (SELECT day from day2_day)
        ORDER BY id DESC";
        $stmt = $db->query($query);

        if ($stmt !== false) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                $msg = $rows;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = $db->errorInfo();
        }
    }
    return $msg;
}

function fetch_fixed($db, $tableName, $columns) {
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "Columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $query = "SELECT " . "*" . 
        " FROM day2_fixed 
        where day <= (SELECT day from day2_day) AND result_day > (SELECT day from day2_day)
        ORDER BY id DESC";
        $stmt = $db->query($query);

        if ($stmt !== false) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                $msg = $rows;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = $db->errorInfo();
        }
    }
    return $msg;
}

function bid_check($db, $tableName, $columns) {
    $namaKelompok = $_SESSION["nama_kelompok"];
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "Columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $query = "SELECT " . "id_bid" . 
        " FROM day2_kelompok_bid
        where id_kelompok = (SELECT id from day2_kelompok where nama = \"" . $namaKelompok .
        "\") ORDER BY id DESC";
        $stmt = $db->query($query);

        if ($stmt !== false) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                $msg = $rows;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = $db->errorInfo();
        }
    }
    return $msg;
}

//biar echo nya ga ke print waktu di require di index.php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo json_encode([
        'day' => $updatedDay,
    ]);
} else {

}
?>