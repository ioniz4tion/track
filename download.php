<?php

namespace WebDesign;
  //spl_autoload_extensions(".class.php");
  //spl_autoload_register();

  spl_autoload_register(function ($class){      
      $class .= ".class.php";
      $class = str_ireplace('\\', "/", $class);       
        if(is_file($class)&&!class_exists($class)) require_once $class;
    }); 

  $functions = new Functions();
  $tbAthlete = new Database("tb_athlete","ID");

  $data = array();

  $i = 0;
 for ($i=0; $i < $tbAthlete->rowNumber; $i++) {

    $tempData = array();
      
    $tempdata["First Name"] = $tbAthlete->first[$i];
    $tempdata["Last Name"] = $tbAthlete->last[$i];
    $tempdata["Cell-Phone Number"] = $tbAthlete->phone[$i];
    $tempdata["Email"] = $tbAthlete->email[$i];
    $tempdata["Sex"] = $tbAthlete->sex[$i];
    $tempdata["Shirt Size"] = $tbAthlete->shirt[$i];
    $tempdata["Sweatshirt Size"] = $tbAthlete->sweatshirt[$i];
    $tempdata["Grade"] = $tbAthlete->grade[$i];
    $data[] = $tempdata;
    unset($tempData);   
  }
  
  function cleanRecord(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // filename for download
  $filename = "AthleteInfo" . date('Ymd') . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data as $row) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    array_walk($row, 'WebDesign\cleanRecord');
    echo implode("\t", array_values($row)) . "\r\n";
  }
  exit;

  ?>