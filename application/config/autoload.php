<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages']   = array();
$autoload['libraries']  = array('database','session','cart','pagination','form_validation');
$autoload['drivers']    = array();
$autoload['helper']     = array('url','file','alert','sqlquery');
$autoload['config']     = array();
$autoload['language']   = array();
$autoload['model']      = array('M_Datatables','M_Admin', 'PetugasModel');
