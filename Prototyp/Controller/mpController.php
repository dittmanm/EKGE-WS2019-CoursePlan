<?php
class ModulPlan {
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

      SELECT ?id ?semesterSeason ?name ?startDate ?timeRequired ?isPartOf ?hasCourseInstance
      WHERE { 
        ?id a cp:Module ;
              cp:semesterSeason ?semesterSeason ;
              schema:name ?name ;
              schema:isPartOf ?isPartOf ;
              schema:startDate ?startDate ;
              schema:timeRequired ?timeRequired.
              OPTIONAL { ?id schema:hasCourseInstance ?hasCourseInstance . }
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

      SELECT ?id ?semesterSeason ?name ?startDate ?timeRequired ?isPartOf ?hasCourseInstance
      WHERE { 
        ?id a cp:Module ;
          cp:semesterSeason ?semesterSeason ;
          schema:name ?name ;
          schema:isPartOf ?isPartOf ;
          schema:startDate ?startDate ;
          schema:timeRequired ?timeRequired.
          OPTIONAL { ?id schema:hasCourseInstance ?hasCourseInstance . }
        '.$values.'
      } ORDER BY (?name)';
    return $data;
  }
  
  public function filterAction($filter = '') {
    //echo 'filterAction';
    //FILTER ( ?isPartOf = cp:wi_ba )
    $filter = 'FILTER (?isPartOf = '.$filter.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?semesterSeason ?name ?startDate ?timeRequired ?isPartOf ?hasCourseInstance
      WHERE { 
        ?id a cp:Module ;
          cp:semesterSeason ?semesterSeason ;
          schema:name ?name ;
          schema:isPartOf ?isPartOf ;
          schema:startDate ?startDate ;
          schema:timeRequired ?timeRequired.
          OPTIONAL { ?id schema:hasCourseInstance ?hasCourseInstance . }
        '.$filter.'
      } ORDER BY (?name)';
    return $data;
  }

  public function detailAction($id) {
    //echo 'detailAction';
    $filter = 'FILTER (?id = '.$id.')';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?semesterSeason ?name ?startDate ?timeRequired ?isPartOf ?hasCourseInstance
      WHERE { 
        ?id a cp:Module ;
          cp:semesterSeason ?semesterSeason ;
          schema:name ?name ;
          schema:isPartOf ?isPartOf ;
          schema:startDate ?startDate ;
          schema:timeRequired ?timeRequired.
          #OPTIONAL { ?id schema:hasCourseInstance ?hasCourseInstance . }
        '.$filter.'
      } ORDER BY (?name)';
    return $data;
  }
  
  public function insertInstanceAction($datArr) {
    //echo 'insertInstanceAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr["hCi"].' a cp:Module ;
        schema:hasCourseInstance cp:'.$datArr["id"].' .
      }';
    return $data;
  }
  
  public function insertAction($datArr) {
    //echo 'insertAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr["id"].' a cp:Module ;
        cp:semesterSeason "'.$datArr["semesterSeason"].'" ;
        schema:name "'.$datArr["name"].'" ;
        schema:isPartOf cp:'.$datArr["isPartOf"].' ;
        schema:startDate "'.$datArr["startDate"].'" ;
        schema:timeRequired "'.$datArr["timeRequired"].'".
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
        cp:'.$datArr["id"].' a cp:Module ;
        cp:semesterSeason "'.$datArr["semesterSeason"].'" ;
        schema:name "'.$datArr["name"].'" ;
        schema:isPartOf cp:'.$datArr["isPartOf"].' ;
        schema:startDate "'.$datArr["startDate"].'" ;
        schema:timeRequired "'.$datArr["timeRequired"].'".
      }';
    return $data;
  }
  
  public function deleteAction($datArr) {
    //echo 'deleteAction';
    $ipo = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $datArr['isPartOf']);
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      DELETE DATA { 
        cp:'.$datArr["id"].' a cp:Module ;
        cp:semesterSeason "'.$datArr["semesterSeason"].'" ;
        schema:name "'.$datArr["name"].'" ;
        schema:isPartOf '.$ipo.' ;
        schema:startDate "'.$datArr["startDate"].'" ;
        schema:timeRequired "'.$datArr["timeRequired"].'".
      }';
    return $data;
  }
  public function getStartdates($values='') {
    //VALUES (?semesterSeason ?isPartOf) {('WS' cp:wi_ba)}
    $values = 'VALUES (?semesterSeason ?isPartOf) {('.$values.')}';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>
      
      SELECT ?startDate ?semesterSeason
        WHERE { 
          ?id a cp:Module ;
          cp:semesterSeason ?semesterSeason ;
          schema:isPartOf ?isPartOf ;
          schema:startDate ?startDate .
          '.$values.'
        }
      GROUP BY ?startDate ?semesterSeason
      ORDER BY (?startDate) ';
    return $data;
  }
}
?>