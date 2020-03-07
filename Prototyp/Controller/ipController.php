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
        "contractualHours" => $request["contractualHours"],
        "reductingHours" => $request["reductingHours"]);
    return $fielddata;
  }
  
//  public function getWorkload($personId) {
//    
//  }
  
  public function getInstructorHours($personId) {
   $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?instructor ?courseWorkloadi
      WHERE {
        ?hasCourseInstance a schema:CourseInstance ;
        schema:instructor ?instructor ;
        schema:courseWorkloadi ?courseWorkloadi .
        
        FILTER (?instructor = '.$personId.') .
      }';
    return $data; 
  }
  
  public function getContributorHours($personId) {
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?contributor ?courseWorkloadc
      WHERE {
        ?hasCourseInstance a schema:CourseInstance ;
        schema:contributor ?contributor ;
        schema:courseWorkloadc ?courseWorkloadc .
        
        FILTER (?contributor = '.$personId.') .
      }';
    return $data;
  }

  public function listAction() {
    //echo 'listAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contractualHours ?reductingHours
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contractualHours ?contractualHours; 
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

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contractualHours ?reductingHours
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contractualHours ?contractualHours; 
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

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contractualHours ?reductingHours
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contractualHours ?contractualHours; 
          cp:reductingHours ?reductingHours.
          '.$filter.'
      }
      ORDER BY (?familyName)';
    return $data;
  }
  
  public function insertAction($datArr) {
    //echo 'insertAction';
    $namArr = (str_word_count($datArr["givenName"].' '.$datArr["familyName"], 1));
    foreach ($namArr as $value) {
      $word = $word . substr($value, 0, 1);
    }
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
        cp:contractualHours "'.$datArr["contractualHours"].'" ;
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
        cp:contractualHours "'.$datArr["contractualHours"].'" ;
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
        cp:contractualHours "'.$datArr["contractualHours"].'" ;
        cp:reductingHours "'.$datArr["reductingHours"].'" .
      }';
    return $data;
  }
}
?>