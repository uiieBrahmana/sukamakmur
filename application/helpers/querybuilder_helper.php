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

?>