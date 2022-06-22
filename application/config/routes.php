<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'data';
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;

$route['kelola_petugas']                      = 'PetugasController';
$route['kelola_petugas/data_petugas']         = 'PetugasController/data';
$route['kelola_petugas/tambah']['get']        = 'PetugasController/create';
$route['kelola_petugas/tambah']['post']       = 'PetugasController/store';
$route['kelola_petugas/edit/(:any)']['get']   = 'PetugasController/edit/$1';
$route['kelola_petugas/edit/(:any)']['post']  = 'PetugasController/update/$1';
$route['kelola_petugas/delete/(:any)']['get'] = 'PetugasController/destroy/$1';
