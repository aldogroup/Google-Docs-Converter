<?php

/**
 * Converts the CSV output from Google Docs to an array
 * we can work with.
 *
 * @string $file Google docs URL
 * @string $delimiter The seperator
 *
 * @return $arr CSV converted array
 */
function csvToArray($file, $delimiter) {
  if (($handle = fopen($file, 'r')) !== FALSE) {
    $i = 0;
    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) {
      for ($j = 0; $j < count($lineArray); $j++) {
        $arr[$i][$j] = $lineArray[$j];
      }
      $i++;
    }
    fclose($handle);
  }
  return $arr;
}

/**
 * Encodes an array to JSON format - in this case
 * the Google Docs URL we pass as a parameter
 *
 * @string $feed Google Docs URL
 *
 * @return $newArray Encoded JSON
 */
function encodeArraytoJSON($feed = '') {
  $keys = array();
  $newArray = array();

  $data = csvToArray($feed, ',');
  $count = count($data) - 1;
  $labels = array_shift($data);

  foreach ($labels as $label) {
    $keys[] = $label;
  }

  $keys[] = 'id';

  for ($i = 0; $i < $count; $i++) {
    $data[$i][] = $i;
  }

  for ($j = 0; $j < $count; $j++) {
    $d = array_combine($keys, $data[$j]);
    $newArray[$j] = $d;
  }

  echo json_encode($newArray, JSON_UNESCAPED_UNICODE);
}

if ( $_POST['key'] == '' ) {
    echo 'Empty value';
    return;
}

// Format the Google Docs link before converting
$docsUrl = 'https://docs.google.com/spreadsheet/pub?key=' . $_POST['key'] . '&single=true&gid=0&output=csv';

// Bombs away!
encodeArraytoJSON($docsUrl);
