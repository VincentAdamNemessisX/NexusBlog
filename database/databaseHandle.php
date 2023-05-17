<?php
global $conn;
error_reporting(0);
$conn = mysqli_connect('localhost:3306', 'root', 'root')
or die("Database connect failed!" . mysqli_error($conn));
mysqli_select_db($conn, 'nexusblog');
mysqli_set_charset($conn, 'utf-8');

function queryData($table, $fields = "*", $condition = "", $offset = -1, $limit = -1)
{
    global $conn;
    $sql = "select $fields from $table";
    if ($condition != '') {
        $sql .= " where $condition";
    }
    if ($offset != -1 && $limit != -1) {
        $sql .= " limit $offset,$limit";
    }
//    print $sql;
    return mysqli_query($conn, $sql);
}

function insertData($table, $fields, $values, $data = [])
{
    global $conn;
    if (count($data) > 0) {
        $fields = array_keys($data);
        $values = array_values($data);
    }
    // implode fields fuck shit implements
//    foreach ($fields as $f) {
//        $index++;
//        if ($index < sizeof($fields)) {
//            $fieldsSql .= $f . ",";
//        } else {
//            $fieldsSql .= $f;
//        }
//    }
    $fieldsSql = implode(',', $fields);
//     implode values fuck shit implements
//    $index = 0;
//    foreach ($values as $value) {
//        $index++;
//        if ($index < sizeof($values)) {
//            $valuesSql .= "'" . $value . "',";
//        } else {
//            $valuesSql .= "'" . $value . "'";
//        }
//    }
    $valuesSql = implode(',', $values);
    $sql = "insert into $table($fieldsSql) values ($valuesSql)";
//    print $sql;
    return mysqli_query($conn, $sql);
}

function updateData($table, $condition, $data = [])
{
    global $conn;
    $dataSql = "";
    foreach ($data as $k => $v) {
        if ($k == array_key_last($data)) {
            $dataSql .= $k . "=" . $v;
        } else {
            $dataSql .= $k . "=" . $v. ",";
        }
    }
    $sql = "update $table set $dataSql  where $condition";
//    print $sql;
    return mysqli_query($conn, $sql);
}

function removeData($table, $condition)
{
    global $conn;
    $sql = "delete from $table where $condition";
//    print $sql;
    return mysqli_query($conn, $sql);
}

function closeDatabase()
{
    global $conn;
    mysqli_close($conn);
}