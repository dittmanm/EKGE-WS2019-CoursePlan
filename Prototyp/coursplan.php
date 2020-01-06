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
        //'content' => http_build_query($data)
        'content' => $data
    )
);
print('test 1');

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
$xml = simplexml_load_string($result);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
print('test 2');

$result1 = $array[results];
print('test 3');

$result2 = $result1[result];
print_r($result2);
print('test 4');

foreach ($result2 as $key => $value) {
  
}