<?php
class CoursPlan {
  protected $result;
    public function getFielddata () {
    $id = $_GET["id"];
    $givenName = $_GET["givenName"];
    $familyName = $_GET["familyName"];
    $honorificPrefix = $_GET["honorificPrefix"];
    $email = $_GET["email"];
    $contructualHours = $_GET["contructualHours"];
    $reductingHours = $_GET["reductingHours"];
    
    $fielddata = array(
        "id" => $id, 
        "givenName" => $givenName,
        "familyName" => $familyName,
        "honorificPrefix" => $honorificPrefix,
        "email" => $email,
        "contructualHours" => $contructualHours,
        "reductingHours" => $reductingHours);
    return $fielddata;
  }

  public function listAction() {
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contructualHours ?reductingHours
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contructualHours ?contructualHours; 
          cp:reductingHours ?reductingHours.
      }
      ORDER BY (?familyName)';
    return $data;
  }
  public function valuesAction($values = '') {
    echo 'valuesAction';
    //VALUES (?givenName ?familyName) {('Robert' 'Franz')}
    $values = 'VALUES (?givenName ?familyName) {('.$values.')}';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contructualHours ?reductingHours
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contructualHours ?contructualHours; 
          cp:reductingHours ?reductingHours.
          '.$values.'
      }
      ORDER BY (?familyName)';
    return $data;
  }
  public function filterAction($filter = '') {
    echo 'filterAction';
    //FILTER ( ?name LIKE "Wirtschaftsinformatik" )
    $filter = 'FILTER (?id LIKE '.$filter.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contructualHours ?reductingHours
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contructualHours ?contructualHours; 
          cp:reductingHours ?reductingHours.
          '.$filter.'
      }
      ORDER BY (?familyName)';
    return $data;
  }
}
?>