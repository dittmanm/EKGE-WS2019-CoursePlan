<?php
class CoursPlan {
  protected $result;
  
  public function getFielddata () {
    global $request;
    $fielddata = array(
        "id" => $request["id"], 
        "semesterSeason" => $request["semesterSeason"],
        "Name" => $request["name"],
        "startDate" => $request["startDate"],
        "timeRequired" => $request["timeRequired"],
        "isPartOf" => $request["isPartOf"]);
    return $fielddata;
  }

  public function listAction() {
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?semesterSeason ?name ?startDate ?timeRequired ?isPartOf
      WHERE { 
        ?id a cp:Module ;
              cp:semesterSeason ?semesterSeason ;
              schema:name ?name ;
              schema:isPartOf ?isPartOf ;
              schema:startDate ?startDate ;
              schema:timeRequired ?timeRequired.
      } ORDER BY (?name)';
    return $data;
  }
  
  public function valuesAction($values = '') {
    //echo 'valuesAction';
    //VALUES (?startDate ?isPartOf) {('2. Semester' cp:wi_ba)}
    $values = 'VALUES (?startDate ?isPartOf) {('.$values.')}';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?semesterSeason ?name ?startDate ?timeRequired ?isPartOf
      WHERE { 
        ?id a cp:Module ;
          cp:semesterSeason ?semesterSeason ;
          schema:name ?name ;
          schema:isPartOf ?isPartOf ;
          schema:startDate ?startDate ;
          schema:timeRequired ?timeRequired.
        '.$values.'
      } ORDER BY (?name)';
    return $data;
  }
  
  public function filterAction($filter = '') {
    //echo 'filterAction';
    //FILTER ( ?name LIKE "Wirtschaftsinformatik" )
    $filter = 'FILTER (?id LIKE '.$filter.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?semesterSeason ?name ?startDate ?timeRequired ?isPartOf
      WHERE { 
        ?id a cp:Module ;
          cp:semesterSeason ?semesterSeason ;
          schema:name ?name ;
          schema:isPartOf ?isPartOf ;
          schema:startDate ?startDate ;
          schema:timeRequired ?timeRequired.
        '.$filter.'
      } ORDER BY (?name)';
    return $data;
  }
}
?>