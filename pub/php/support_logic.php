<?php
session_start();

function decryptKey() {
  $cryptKey = $_SESSION['user_crypt'];
  $key = base64_decode($cryptKey);
  return $key;
}

function encrypt($plaintext) {
  //$key = "jfASJwf(=82jSUHjnsdaJNS)U!uS/673SDZsfUGFAasdf19354##1/(&/24hdSFHJhdfj";
  $key = decryptKey();
  $ivlen = openssl_cipher_iv_length($cipher="AES-256-CBC");
  $iv = openssl_random_pseudo_bytes($ivlen);
  $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
  $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
  $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
  return $ciphertext;
}

function decrypt($ciphertext) {
  //$key = "jfASJwf(=82jSUHjnsdaJNS)U!uS/673SDZsfUGFAasdf19354##1/(&/24hdSFHJhdfj";
  $key = decryptKey();
  $c = base64_decode($ciphertext);
  $ivlen = openssl_cipher_iv_length($cipher="AES-256-CBC");
  $iv = substr($c, 0, $ivlen);
  $hmac = substr($c, $ivlen, $sha2len=32);
  $ciphertext_raw = substr($c, $ivlen+$sha2len);
  $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
  $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
  if (hash_equals($hmac, $calcmac))
  {
      return $original_plaintext;
  } else return false;
}
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>