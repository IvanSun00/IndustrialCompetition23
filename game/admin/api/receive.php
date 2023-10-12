<?php
require_once("../../connect.php");
$db = $conn;
$tableName = "game_historykelompok";
$columns = ['id', 'id_post', 'id_kelompok', 'timestamp', 'status'];
$fetchData = fetch_data($db, $tableName, $columns);
$dataKelompok = fetch_kelompok($db, $tableName, $columns);

function fetch_kelompok($db, $tableName, $columns) {
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "Columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $columnName = implode(", ", $columns);
        // $query = "SELECT " . $columnName . " FROM $tableName" . " ORDER BY id DESC";
        $query = "SELECT id, nama FROM game_kelompok ORDER BY nama ASC";
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

function fetch_data($db, $tableName, $columns) {
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "Columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $columnName = implode(", ", $columns);
        // $query = "SELECT " . $columnName . " FROM $tableName" . " ORDER BY id DESC";
        $query = "SELECT $columnName, (SELECT nama FROM game_kelompok k WHERE k.id = h.id_kelompok) AS namaKelompok, (SELECT nama FROM game_post p WHERE p.id = h.id_post) AS namaPost FROM $tableName h ORDER BY id DESC";
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
?>