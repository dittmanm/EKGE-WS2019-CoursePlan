<?php
class StudyProgram {
  protected $result;
  
  public function getFielddata () {
    global $request;
    $fielddata = array(
        "id" => $request["id"], 
        "Name" => $request["name"],
        "educationalCredentialAwarded" => $request["educationalCredentialAwarded"],
        "timeRequired" => $request["timeRequired"],
        "provider" => $request["provider"]);
    return $fielddata;
  }

  public function listAction() {
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?name ?educationalCredentialAwarded ?provider
      WHERE { 
        ?id a cp:StudyProgram ;
        schema:name ?name ;
        schema:educationalCredentialAwarded ?educationalCredentialAwarded ;
        schema:provider ?provider .
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

      SELECT ?id ?name ?educationalCredentialAwarded ?provider
      WHERE { 
        ?id a cp:StudyProgram ;
        schema:name ?name ;
        schema:educationalCredentialAwarded ?educationalCredentialAwarded ;
        schema:provider ?provider .
        '.$values.'
      } ORDER BY (?Name)';
    return $data;
  }
  
  public function filterAction($filter = '') {
    //echo 'filterAction';
    $filter = 'FILTER (?id = '.$filter.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?name ?educationalCredentialAwarded ?provider
      WHERE { 
        ?id a cp:StudyProgram ;
        schema:name ?name ;
        schema:educationalCredentialAwarded ?educationalCredentialAwarded ;
        schema:provider ?provider .
        '.$filter.'
      } ORDER BY (?name)';
    return $data;
  }
}
?>