<?php

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

function getUserData($file, $userId) {
  $data = file_get_contents($file);
  if(!empty($data)) {
      $jsonArr = json_decode($data, true);
      foreach ($jsonArr as $userData) {
          if($userId == $userData["user_id"]) {
              $userDataArr = $userData;
              return $userDataArr;
          }
      }
  }
}

function getOrderId($file) {
  $data = file_get_contents($file);
  $jsonArr = json_decode($data, true);
  $orderId =  isset($jsonArr) ? count($jsonArr) + 1 : 1;
  return $orderId;
}

function getAllOrderData($file) {
  $data = file_get_contents($file);
  $jsonArr = json_decode($data, true);
  return $jsonArr;
}

function setOrderDataInJson($file, $resDataArr) {
  $data = file_get_contents($file);
  $jsonArr = json_decode($data, true);
  $jsonArr[] = $resDataArr;
  file_put_contents($file, json_encode($jsonArr));
}

function updateUser($file, $userId, $userDataArr) {
  $data = file_get_contents($file);
  $jsonArr = json_decode($data, true);
  foreach ($jsonArr as $userData) {
    if($userId == $userData["user_id"]) {
        $userData["user_address"] = $userDataArr;
    }
  }
  $userData = [$userData];
  file_put_contents($file, json_encode($userData));
}

function convertReversedDate($date) {
  $newDate = date("d.m.Y", strtotime($date));
  return $newDate;
}

function escooterType($type) {
  switch ($type) {
    case "casual":
        return "SOFLOW - SO1";
        break;
    case "offroad":
        return "VIRON";
        break;
    case "ftl":
        return "SXT Compact Ultimate";
        break;
  }
}

function formTimeCheck($timeStart, $timeEnd) {
  $today = date("d.m.Y");
  if(strtotime($today) <= strtotime($timeEnd) && strtotime($today) < strtotime($timeStart)) {
    return true;
  } else {
    return false;
  }
}

function timeStatus($timeStart, $timeEnd) {
  $today = date("d.m.Y");
  if(strtotime($today) <= strtotime($timeEnd)) {
    return "<td class='running'>Reservierung aktiv </td>";
  } elseif (strtotime($today) < strtotime($timeStart)) {
    return "<td class='planned'>Reservierung geplant</td>";
  } else {
    return "<td class='expired'>Reserveriung abgelaufen</td>";
  }
}

?>