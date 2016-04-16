<?php


function sendsms($number, $test)
{
    $sql = InsertBuilder('outbox', array(
        'DestinationNumber' => '',
        'TextDecoded' => '',
        'CreatorID' => '',
    ));

    $CI =& get_instance();
    $CI->koneksi->Save($sql, array(
        $number,
        $test,
        'RCSukamakmur'
    ));
}