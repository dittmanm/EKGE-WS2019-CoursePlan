<?php
class CoursPlan {
  protected $result;
  
  public function getFielddata () {
    global $request;
    $fielddata = array(
        "id" => $request["id"],
        "instructor" => $request["instructor"],
        "contributor" => $request["contributor"],
        "courseWorkloadi" => $request["courseWorkloadi"],
        "courseWorkloadc" => $request["courseWorkloadc"]);
    return $fielddata;
  }
  
//  public function getWorkload($personId) {
//    
//  }
  
  public function listAction() {
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?instructor ?contributor ?courseWorkloadi ?courseWorkloadc
      WHERE { 
        ?id a schema:CourseInstance ;
          schema:instructor ?instructor ;
          schema:contributor ?contributor ;
          schema:courseWorkloadi ?courseWorkloadi ;
          schema:courseWorkloadc ?courseWorkloadc .
      } ORDER BY (?id)';
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

      SELECT ?id ?instructor ?contributor ?courseWorkloadi ?courseWorkloadc
      WHERE { 
        ?id a schema:CourseInstance ;
          schema:instructor ?instructor ;
          schema:contributor ?contributor ;
          schema:courseWorkloadi ?courseWorkloadi ;
          schema:courseWorkloadc ?courseWorkloadc .
        '.$values.'
      } ORDER BY (?id)';
    return $data;
  }
  
  public function filterAction($filter = '') {
    //echo 'filterAction';
    //FILTER ( ?name LIKE "Wirtschaftsinformatik" )
    $filter = 'FILTER (?id = '.$filter.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?instructor ?contributor ?courseWorkloadi ?courseWorkloadc
      WHERE { 
        ?id a schema:CourseInstance ;
          schema:instructor ?instructor ;
          schema:contributor ?contributor ;
          schema:courseWorkloadi ?courseWorkloadi ;
          schema:courseWorkloadc ?courseWorkloadc .
        '.$filter.'
      } ORDER BY (?id)';
    return $data;
  }
  
  public function insertAction($datArr) {
    //echo 'insertAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr["id"].' a schema:CourseInstance;
        schema:instructor '.$datArr["instructor"].' ;
        schema:contributor '.$datArr["contributor"].' ;	
        schema:courseWorkloadi "'.$datArr["courseWorkloadi"].'" ;
        schema:courseWorkloadc "'.$datArr["courseWorkloadc"].'" .
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
        cp:'.$datArr["id"].' a schema:CourseInstance;
        schema:instructor '.$datArr["instructor"].' ;
        schema:contributor '.$datArr["contributor"].' ;	
        schema:courseWorkloadi "'.$datArr["courseWorkloadi"].'" ;
        schema:courseWorkloadc "'.$datArr["courseWorkloadc"].'" .
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
        cp:'.$datArr["id"].' a schema:CourseInstance;
        schema:instructor '.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $datArr['instructor']).' ;
        schema:contributor '.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $datArr['contributor']).' ;	
        schema:courseWorkloadi "'.$datArr["courseWorkloadi"].'" ;
        schema:courseWorkloadc "'.$datArr["courseWorkloadc"].'" .
      }';
    return $data;
  }
}
?>