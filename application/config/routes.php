<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']            = 'data';
$route['404_override']                  = '';
$route['translate_uri_dashes']          = FALSE;
$route['data/kategori/(:any)']['get']   = 'KategoriController/index/$1';
$route['token']['get']                  = 'Data/generateToken';

$route['track_pengunjung']['get']   = 'Data/trackPengunjung';
$route['track_pengunjung']['post']  = 'Data/storeTrackPengunjung';

$route['data/subkategori/data/(:any)']['post']          = 'KategoriController/data/$1';
$route['data/subkategori/data_select/(:any)']['post']   = 'KategoriController/data_select/$1';
$route['data/subkategori/(:any)']['post']               = 'KategoriController/store/$1';
$route['data/subkategori/(:any)']['get']                = 'KategoriController/index/$1';
$route['data/subkategori/update/(:any)']['post']        = 'KategoriController/store/$1';
$route['data/subkategori/delete/(:any)']['get']         = 'KategoriController/store/$1';

$route['data/sumber/data']['post']          = 'SumberController/data';
// $route['data/sumber/data_select/(:any)']['post']   = 'SumberController/data_select/$1';
$route['data/sumber']['post']               = 'SumberController/store';
$route['data/sumber']['get']                = 'SumberController/index';
$route['data/sumber/update']['post']        = 'SumberController/store';
$route['data/sumber/delete']['get']         = 'SumberController/store';

$route['kelola_petugas']                      = 'PetugasController';
$route['kelola_petugas/data_petugas']         = 'PetugasController/data';
$route['kelola_petugas/tambah']['get']        = 'PetugasController/create';
$route['kelola_petugas/tambah']['post']       = 'PetugasController/store';
$route['kelola_petugas/edit/(:any)']['get']   = 'PetugasController/edit/$1';
$route['kelola_petugas/edit/(:any)']['post']  = 'PetugasController/update/$1';
$route['kelola_petugas/delete/(:any)']['get'] = 'PetugasController/destroy/$1';
