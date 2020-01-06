<?php
$url = 'http://localhost:3030/Test_2_Unip/query';
$data = 'PREFIX schema: <https://schema.org/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

SELECT ?P ?gname ?fname ?hon
WHERE {
  ?P a schema:Person;
            schema:givenName ?gname;
            schema:familyName ?fname;
			schema:honorificPrefix ?hon.
}
ORDER BY (?fname)';

$options = array(
    'http' => array(
        'header'  => ['Content-type: application/sparql-query'],['Accept: application/json'],
        'method'  => 'POST',
        'content' => $data
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
$xml = simplexml_load_string($result);
$jsonEn = json_encode($xml);
$jsonDe= json_decode($jsonEn,TRUE);
$result1 = $jsonDe[results];
foreach ($result1[result] as $key2 => $val2) {
  foreach ($val2['binding'] as $key3 => $val3) {    
    foreach ($val3 as $key4 => $val4) {
      $val = '';
      if (is_array($val4)) {
        foreach ($val4 as $key5 => $val5) { $key = $val5; }
      } else { $val = $val4; }
      $resArr[$key] = $val;
    }
  }
  $finalArr[] = $resArr;
}
print_r($finalArr);