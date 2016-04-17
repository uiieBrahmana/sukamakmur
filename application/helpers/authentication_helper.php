<?php

function securedHash($idpemesanan, $ammount)
{
    $words = sha1($ammount . 'P4J7r3x9S4V7' . $idpemesanan);
    return $words;
}