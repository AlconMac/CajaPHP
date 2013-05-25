<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DownloadControl
 *
 * @author Luis
 */
include_once 'LibreriasMVC/_Download.php';
class DownloadControl {
    public static function index() {
        _Download::index();
    }
}

?>
