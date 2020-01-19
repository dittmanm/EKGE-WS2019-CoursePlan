<?php
class InstructorPerson {
  protected $result;
    public function getFielddata () {
      global $request;
      $fielddata = array(
        "id" => $request["id"], 
        "givenName" => $request["givenName"],
        "familyName" => $request["familyName"],
        "honorificPrefix" => $request["honorificPrefix"],
        "email" => $request["email"],
        "contructualHours" => $request["contructualHours"],
        "reductingHours" => $request["reductingHours"]);
    return $fielddata;
  }

  public function listAction() {
    //echo 'listAction';
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
    //echo 'valuesAction';
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
    //echo 'filterAction';
    $filter = 'FILTER (?id = '.$filter.')';
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
  
  public function insertAction($datArr) {
    //echo 'insertAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr["givenName"].$datArr["familyName"].' a schema:Person;
        schema:givenName "'.$datArr["givenName"].'" ;
        schema:familyName "'.$datArr["familyName"].'" ;
        schema:honorificPrefix "'.$datArr["honorificPrefix"].'" ;
        schema:email "'.$datArr["email"].'" ;
        cp:contructualHours "'.$datArr["contructualHours"].'" ;
        cp:reductingHours "'.$datArr["reductingHours"].'" .
      }';
    return $data;
  }
  
  public function updateAction($datArr) {
    //echo 'updateAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr["id"].' a schema:Person;
        schema:givenName "'.$datArr["givenName"].'" ;
        schema:familyName "'.$datArr["familyName"].'" ;
        schema:honorificPrefix "'.$datArr["honorificPrefix"].'" ;
        schema:email "'.$datArr["email"].'" ;
        cp:contructualHours "'.$datArr["contructualHours"].'" ;
        cp:reductingHours "'.$datArr["reductingHours"].'" .
      }';
    return $data;
  }
  
  public function deleteAction($datArr) {
    //echo 'deleteAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      DELETE DATA { 
        cp:'.$datArr["id"].' a schema:Person;
        schema:givenName "'.$datArr["givenName"].'" ;
        schema:familyName "'.$datArr["familyName"].'" ;
        schema:honorificPrefix "'.$datArr["honorificPrefix"].'" ;
        schema:email "'.$datArr["email"].'" ;
        cp:contructualHours "'.$datArr["contructualHours"].'" ;
        cp:reductingHours "'.$datArr["reductingHours"].'" .
      }';
    return $data;
  }
}
?>