<?php
class InstructorPerson {
  protected $result;
    public function getFielddata () {
    $id = $_GET["id"];
    $givenName = $_GET["givenName"];
    $familyName = $_GET["familyName"];
    $honorificPrefix = $_GET["honorificPrefix"];
    $contructualHours = $_GET["contructualHours"];
    $reductingHours = $_GET["reductingHours"];
    
    $fielddata = array(
        "id" => $id, 
        "givenName" => $givenName,
        "familyName" => $familyName,
        "honorificPrefix" => $honorificPrefix,
        "contructualHours" => $contructualHours,
        "reductingHours" => $reductingHours);
    return $fielddata;
  }
  public function listAction() {
    echo 'listAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <>

      SELECT ?id ?givenName ?familyName ?honorificPrefix
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix.
      }
      ORDER BY (?familyName)';
    return $data;
  }
}
?>