<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*  Fungsi dekripsi_cipher2 digunakan untuk algoritma block cipher dengan mode operasi selain stream */
function dekripsi_cipher2($algoritma,$mode,$iv,$secretkey,$fileplain,$filecipher){

	/* Membuka Modul untuk memilih Algoritma dan Mode Operasi */
	$td = mcrypt_module_open($algoritma, '', $mode, '');

	/* Inisialisasi IV dan Menentukan panjang kunci yang digunakan*/
	$iv =base64_decode($iv);
	$ks = mcrypt_enc_get_key_size($td);

	/* Menghasilkan Kunci */

	$key = $secretkey;

	/* Inisialisasi */
	mcrypt_generic_init($td, $key, $iv);

	/* Dekripsi Data */
	$buffer = $filecipher;
	$buffer =base64_decode($buffer);
	$fileplain = mdecrypt_generic($td, $buffer);

	/* Menghentikan proses dekripsi dan menutup modul */
	mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    return $fileplain;

}

/*  Fungsi enkripsi_plain2 digunakan untuk algoritma block cipher dengan mode operasi selain stream */
function enkripsi_plain2($algoritma,$mode,$secretkey,$fileplain){

	/* Membuka Modul untuk memilih Algoritma & Mode Operasi */
	$td = mcrypt_module_open($algoritma, '', $mode, '');

	/* Inisialisasi IV dan Menentukan panjang kunci yang digunakan*/
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	$ks = mcrypt_enc_get_key_size($td);

	/* Menghasilkan Kunci */
	$key = $secretkey;
	//echo "kuncinya : ". $key. "<br>";

	/* Inisialisasi */
	mcrypt_generic_init($td, $key, $iv);

	/* Enkripsi Data, dimana hasil enkripsi harus di encode dengan base64.\
         Hal ini dikarenakan web browser tidak dapat membaca karakter-karakter\
         ASCII dalam bentuk simbol-simbol */
	$buffer = $fileplain;
	$encrypted = mcrypt_generic($td, $buffer);
	$encrypted1=base64_encode($iv).";".base64_encode($encrypted);
	$encrypted2=base64_encode($encrypted1);
	$filecipher=$encrypted2;

	/* Menghentikan proses enkripsi dan menutup modul */
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);

  
    return $filecipher;

}

?>
