<?php
  function getFiscalCode($name, $surname, $genderNumber, $birthDate, $birthCity){
    $fiscalCode = "";

    $fiscalCode .= surnameLetters($surname);
    $fiscalCode .= nameLetters($name);
    $fiscalCode .= date('y', $birthDate);
    $fiscalCode .= monthLetter($birthDate);

    if($genderNumber != 0)
      $fiscalCode .= (date('d', $birthDate) + $genderNumber);
    else
      $fiscalCode .= (date('d', $birthDate));

    $code = getCode($birthCity);
    if(empty($code))
      return "";

    $fiscalCode .= $code;
    $fiscalCode .= lastLetter($fiscalCode);

    return $fiscalCode;
  }

  function surnameLetters($surname){
    $found=0;
    $consonants="";

    for($i=0; ($i < strlen($surname)) && ($found < 3); $i++){
      if(isConsonant($surname[$i])){
        $consonants .= strtoupper($surname[$i]);
        $found++;
      }
    }

    if($found == 3)
      return $consonants;

    return abnornmalField($surname, $consonants);
  }

  function nameLetters($name){
    $found=0;
    $consonants="";

    for($i=0; ($i < strlen($name)) && ($found < 4); $i++){
      if(isConsonant($name[$i])){
        $consonants .= strtoupper($name[$i]);
        $found++;
      }
    }

    if($found == 4)
      return substr($consonants, 0, 1) . substr($consonants, 2, 2);
    if($found == 3)
      return substr($consonants, 0, 3);

    return abnornmalField($name, $consonants);
  }

  function monthLetter($birthDate){
    switch (date('m', $birthDate)){
      case 12:
        return 'T';
      case 1:
        return 'A';
      case 2:
        return 'B';
      case 3:
        return 'C';
      case 4:
        return 'D';
      case 5:
        return 'E';
      case 6:
        return 'H';
      case 7:
        return 'L';
      case 8:
        return 'M';
      case 9:
        return 'P';
      case 10:
        return 'R';
      case 11:
        return 'S';
    }
  }

  function lastLetter($fiscalCode){
    $odd = array(1, 0, 5, 7, 9, 13, 15, 17, 19, 21, 2, 4, 18, 20, 11, 3, 6, 8, 12, 14, 16, 10, 22, 25, 24, 23);
    $evenAndRest = range(0, 25);
    $char = range('A','Z');
    $sum=0;

    for($i=1; $i < strlen($fiscalCode); $i+=2){
      $letter = convertInChar($fiscalCode[$i]);
      for($j=0; $j < count($char); $j++){
        if($letter == $char[$j]){
          $sum+=$evenAndRest[$j];
          break;
        }
      }
    }
    for($i=0; $i < strlen($fiscalCode); $i+=2){
      $letter = convertInChar($fiscalCode[$i]);
      for($j=0; $j < count($char); $j++){
        if($letter == $char[$j]){
          $sum+=$odd[$j];
          break;
        }
      }
    }

    $rest = ($sum) % 26;
    for($j=0; $j < count($evenAndRest); $j++){
      if($rest == $evenAndRest[$j])
        return $char[$j];
    }

    return;
  }

  function abnornmalField($field, $consonants){
    for($i=0; ($i < strlen($field)) && (strlen($consonants) < 3); $i++){
      if(!isConsonant($field[$i]))
        $consonants .= strtoupper($field[$i]);
    }

    while(strlen($consonants) < 3)
      $consonants .= 'X';

    return $consonants;
  }

  function isConsonant($letter){
    if($letter!='a' && $letter!='e' && $letter!='i' && $letter!='o' && $letter!='u')
      if($letter!='A' && $letter!='E' && $letter!='I' && $letter!='O' && $letter!='U')
        return true;
  }

  function dontHackMySite(){
    echo "<center><h2>Don't hack my site!</h2><br>";
    echo  "<img src=\"img/kickass.png\"><br><br><br>";
    echo  "<input type=\"button\" value=\"Login\" onclick=\"history.back(-1)\"></center>";
  }

  function getCode($birthCity){
    $json = file_get_contents('https://raw.githubusercontent.com/matteocontrini/comuni-json/master/comuni.json');
    $obj = json_decode($json);

    foreach($obj as $city){
      if(strtolower($city->nome) == strtolower($birthCity))
        return $city->codiceCatastale;
    }

    return "";
  }

  function convertInChar($value){
    switch ($value) {
      case '0':
        return 'A';
      case '1':
        return 'B';
      case '2':
        return 'C';
      case '3':
        return 'D';
      case '4':
        return 'E';
      case '5':
        return 'F';
      case '6':
        return 'G';
      case '7':
        return 'H';
      case '8':
        return 'I';
      case '9':
        return 'J';
      default:
        return $value;
    }
  }

  function findUser($rows, $username, $password){
    foreach ($rows as $row => $data) {
      if(substr($data, 0, 1) == "#")
        continue;

      $tok = $name = strtok($data, ",");

      for($i=0; $tok != false; $i++){
        $passFind = false;
        $userFind = false;

        $tok = strtok(",");

        if($username == $tok)
          $userFind = true;

        $tok = strtok(",");
        if($password == $tok)
          $passFind = true;


        if($passFind && $userFind)
          return $name;

        $tok = $name = strtok(",");
      }
    }

    return "";
  }
?>
