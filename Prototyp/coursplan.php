<?php
//$xml = file_get_contents("http://localhost:3030/Test_2_Unip/query");
//print_r($xml);

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

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/sparql-query",
        'method'  => 'POST',
        //'content' => http_build_query($data)
        'content' => $data
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
print_r($result);

$json = json_decode($result, true);
print_r($json);

foreach ($json as $element) {
  echo 'uri: ' . $element["P"] ;
  echo 'Name: ' . $element["gname"] . '<br>';
}

print('test 4');
