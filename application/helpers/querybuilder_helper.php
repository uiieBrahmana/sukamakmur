<?php

/**
 * @param $tablename
 * @param $array
 * @return string
 */
function InsertBuilder($tablename, $array)
{
    $insert_text = "INSERT INTO `$tablename`";
    $keys = array();
    $values = array();
    foreach ($array as $k => $v) {
        $keys[] = $k;
        $values[] = $v;
    }
    $key_string = "(";
    foreach ($keys as $key) {
        $key_string = $key_string . "`" . $key . "`, ";
    }
    $key_string = substr($key_string, 0, -2);
    $insert_text = $insert_text . " " . $key_string . ")";
    $insert_text = $insert_text . " VALUES ";
    $value_string = "(";

    foreach ($keys as $key) {
        $value_string = $value_string . "?, ";
    }
    $value_string = substr($value_string, 0, -2);
    return $insert_text . $value_string . ");";

}

/**
 * @param $table
 * @param $id
 * @param $array
 * @return string
 */
function UpdateBuilder($table, $id, $array)
{
    $array = array_merge($id, $array);

    $update_text = "UPDATE `$table` SET ";

    $key_string = "";
    $key_where = " WHERE ";

    foreach ($array as $key => $val) {
        $key_string = $key_string . "`" . $key . "` = ?, ";
    }
    $key_string = substr($key_string, 0, -2);

    foreach ($id as $key => $val) {
        $key_where = $key_where . "`" . $key . "` = '" . $val . "' AND ";
    }
    $key_where = substr($key_where, 0, -4);

    return $update_text . " " . $key_string . $key_where . ";";

}

/**
 * @param $tablename
 * @param $array
 * @return string
 */
function DeleteBuilder($tablename, $array)
{
    $del_text = "DELETE FROM `$tablename` WHERE ";
    foreach ($array as $col => $value) {
        $del_text .= "`" . $col . "`" . " = '" . $value . "' AND ";
    }
    return substr($del_text, 0, -4);
}

function indonesianMonth($datesource)
{
$datepart = explode(" ",$datesource);
    switch($datepart[1]){
        case "January":
            $datepart[1] = "Januari";
            break;
        case "February":
            $datepart[1] = "Februari";
            break;
        case "March":
            $datepart[1] = "Maret";
            break;
        case "April":
            $datepart[1] = "April";
            break;
        case "May":
            $datepart[1] = "Mei";
            break;
        case "June":
            $datepart[1] = "Juni";
            break;
        case "July":
            $datepart[1] = "Juli";
            break;
        case "August":
            $datepart[1] = "Agustus";
            break;
        case "September":
            $datepart[1] = "September";
            break;
        case "October":
            $datepart[1] = "Oktober";
            break;
        case "November":
            $datepart[1] = "November";
            break;
        case "December":
            $datepart[1] = "Desember";
            break;
    }
    return $datepart[0]." ". $datepart[1]." ". $datepart[2];
}

?>