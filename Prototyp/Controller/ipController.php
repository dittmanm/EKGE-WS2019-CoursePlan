<?php
class InstructorPerson {
  /**
   * 0 => Noch kein Eintrag vorhanden
   * 1 => ID schon vergeben
   */
  function checkId($id = '') {
    $main = new Main();
    $ans = $main->queryAction($this->checkIdAction($id));
    if (gettype($ans) === 'integer') { $result = 0; } 
    else { $result = 1; }
    return $result;
  }

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
  
  public function getInstructorHours($personId, $year) {
   $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?instructor ?courseWorkloadi ?startDate
      WHERE {
        ?hasCourseInstance a schema:CourseInstance ;
        schema:instructor ?instructor ;
        schema:courseWorkloadi ?courseWorkloadi ;
        schema:startDate ?startDate .
        VALUES (?instructor ?startDate) {('.$personId.' \''.$year.'\')} .
      }';
      //echo $data;
    return $data; 
  }
  
  public function getContributorHours($personId, $year) {
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?contributor ?courseWorkloadc ?startDate
      WHERE {
        ?hasCourseInstance a schema:CourseInstance ;
        schema:contributor ?contributor ;
        schema:courseWorkloadc ?courseWorkloadc ;
        schema:startDate ?startDate .
        VALUES (?contributor ?startDate) {('.$personId.' \''.$year.'\')} .
      }';
      //echo $data;
    return $data;
  }

  public function listAction() {
    //echo 'listAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contractualHours ?reductingHours ?memberOf
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName ;
          schema:familyName ?familyName ;
          schema:honorificPrefix ?honorificPrefix ;
          schema:email ?email ;
          cp:contractualHours ?contractualHours ; 
          cp:reductingHours ?reductingHours .
          OPTIONAL { ?id schema:memberOf ?memberOf . }
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

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contractualHours ?reductingHours ?memberOf
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contractualHours ?contractualHours; 
          cp:reductingHours ?reductingHours.
          OPTIONAL { ?id schema:memberOf ?memberOf . }
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

      SELECT ?id ?givenName ?familyName ?honorificPrefix ?email ?contractualHours ?reductingHours ?memberOf
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName;
          schema:honorificPrefix ?honorificPrefix;
          schema:email ?email;
          cp:contractualHours ?contractualHours; 
          cp:reductingHours ?reductingHours.
          OPTIONAL { ?id schema:memberOf ?memberOf . }
          '.$filter.'
      }
      ORDER BY (?familyName)';
    return $data;
  }
  
  public function insertAction($datArr) {
    //echo 'insertAction';
    $datArr['memberOf'] = implode(", ", $datArr['memberOf']);
    $datArr['memberOf'] = str_replace('"', '', $datArr['memberOf']);
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
        cp:reductingHours "'.$datArr["reductingHours"].'" ;
        schema:memberOf "'.$datArr["memberOf"].'" .
      }';
    return $data;
  }
  
  public function updateAction($datArr) {
    //echo 'updateAction';
    $datArr['memberOf'] = implode(", ", $datArr['memberOf']);
    $datArr['memberOf'] = str_replace('"', '', $datArr['memberOf']);
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
        cp:reductingHours "'.$datArr["reductingHours"].'" ;
        schema:memberOf "'.$datArr["memberOf"].'" .
      }';
      print_r($data);
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
        cp:reductingHours "'.$datArr["reductingHours"].'" ;
        schema:memberOf "'.$datArr["memberOf"].'" .
      }';
    return $data;
  }

  public function checkIdAction($filter = '') {
    //echo 'filterAction';
    $filter = 'FILTER (?id = '.$filter.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?givenName ?familyName
      WHERE {
        ?id a schema:Person;
          schema:givenName ?givenName;
          schema:familyName ?familyName.
          '.$filter.'
      }';
    return $data;
  }

  public function addMemberOf($idIp, $idMo) {
    //echo 'addMemberOf';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr["id"].' a schema:Person;
        schema:memberOf "'.$datArr["memberOf"].'" .
      }';
    return $data;
  }

  public function deleteMemberOf ($idIp, $idMo) {
    //echo 'deleteMemberOf';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      DELETE DATA { 
        cp:'.$datArr["id"].' a schema:Person;
        schema:memberOf "'.$datArr["memberOf"].'" .
      }';
    return $data;
  }

  public function listMemberOf($idIp) {
    //echo 'listMemberOf';
    $filter = 'FILTER (?id = '.$idIp.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?memberOf
      WHERE {
        ?id a schema:Person;
        schema:memberOf ?memberOf . 
        '.$filter.'
      }
      ORDER BY (?familyName)';
    return $data;
  }

}
?>