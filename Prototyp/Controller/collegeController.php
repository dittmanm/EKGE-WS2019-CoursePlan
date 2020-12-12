<?php
class College {
  protected $result;
  
  public function checkAction($data) {
    $main = new Main();
    if($data['action'] === 'create') {
      $data['id'] = $main->generateKey($data['name']);
      $main->updateAction($this->insertAction($data));
    } elseif($data['action'] === 'update') {
      $delDat = $main->queryAction($this->filterAction('cp:'.$data['id']));
      foreach($delDat as $datArr) {
        $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
        $main->updateAction($this->deleteAction($datArr));
      }
      $main->updateAction($this->updateAction($data));
    } elseif($data['action'] === 'delete') {
      $delDat = $main->queryAction($this->filterAction('cp:'.$data['id']));
      foreach($delDat as $datArr) {
        $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
        $main->updateAction($this->deleteAction($datArr));
      }
    }
  }

  public function listAction() {
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      SELECT ?id ?name
      WHERE { 
        ?id a schema:Faculty ;
        schema:name ?name .
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

      SELECT ?id ?name
      WHERE { 
        ?id a schema:Faculty ;
        schema:name ?name .
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

      SELECT ?id ?name
      WHERE { 
        ?id a schema:Faculty ;
        schema:name ?name .
        '.$filter.'
      } ORDER BY (?name)';
    return $data;
  }
  
  public function insertAction($datArr) {
    //echo 'insertAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr['id'].' a schema:Faculty ;
        schema:name "'.$datArr['name'].'" .
      }';
      echo $data;
    return $data;
  }
  
  public function updateAction($datArr) {
    //echo 'updateAction';
    $data = 'PREFIX schema: <https://schema.org/>
      PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
      PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
      PREFIX cp: <https://bmake.th-brandenburg.de/cp/>

      INSERT DATA { 
        cp:'.$datArr['id'].' a schema:Faculty ;
        schema:name "'.$datArr['name'].'" .
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
        cp:'.$datArr['id'].' a schema:Faculty ;
        schema:name "'.$datArr['name'].'" .
      }';
    return $data;
  }
}
?>