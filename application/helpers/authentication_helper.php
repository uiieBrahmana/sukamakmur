<?php

function securedHash($idpemesanan, $ammount)
{
    $words = sha1($ammount . 'e6E7p9K4g7s6' . $idpemesanan);
    return $words;
}