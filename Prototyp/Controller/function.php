<?php
class Main {
  protected $prevUrl = 'http://localhost:3030/Test_4_Unip/';
  
  public function index() {
    global $request;
    print_r($request);
    if ($request['action'] === 'create') {
      $data = $this->newAction($request['model'],$request);
    } elseif ($request['action'] === 'update') {
      $data = $this->updateAction($request['id'],$request['model']);
    } elseif ($request['action'] === 'delete') {
      $data = $this->deleteAction($request['id'],$request['model']);
    } elseif ($request['controller'] === 'edit') {
      $data = $this->detailAction($request['id'],$request['model']);
    } else {
      $data = $this->listAction($request['model']);
    }
    return $data;
  }
  
  /** Search for Session **/
  public function checkSession() {
    global $request;
    if(isset($request['session'])) {
      if($request['session'] === 'WS') {
        $_SESSION['name'] = 'WS';
      } elseif($request['session'] === 'SS') {
        $_SESSION['name'] = 'SS';
      } else { session_unset(); }
    }
  }
	
  /**
   * Check the created Session
   * WS => 1
   * SS => 2
   * 0 => nichts ausgewählt
   */
  public function getSession() {
    if(isset($_SESSION['name'])) {
      if($_SESSION['name'] === 'WS') { $result = 1; }
      elseif($_SESSION['name'] === 'SS') { $result = 2; }
      else { $result = 0; }
    } else { $result = 0; }
		return $result;
  }
  
  public function newAction ($table) {
    $fielddata = $this->getFielddata($table);
    $db = new Database();
    $db->openDatabase();
    $result = $db->dbInsert($table,$fielddata);
    if ($result) {$result = '<p class="success">Das Anlegen war erfolgreich.<br />';}
    else {$result = '<p class="error">Das Anlegen war NICHT erfolgreich.<br />';}
    return $result;
  }
  
  public function detailAction ($id,$table) {
    $where = 'id = '.$id;
    $db = new Database();
    $db->openDatabase();
    $data = $db->dbSelectWhere($table,$where);
    return $data;
  }
  
  public function queryAction ($data) {
    $url = $this->prevUrl.'query';
    $options = array('http' => array(
      'header'  => ['Content-type: application/sparql-query'],['Accept: application/json'],
      'method'  => 'POST',
      'content' => $data
    ));
    //print_r($options);
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */ }
    $xml = simplexml_load_string($result);
    $jsonEn = json_encode($xml);
    $jsonDe= json_decode($jsonEn,TRUE);
    $result1 = $jsonDe['results'];
    foreach ($result1['result'] as $key2 => $val2) {
      if (isset($val2['binding'])) {
        $resArr = $this->readBinding($val2);
      } else {
        $resArr = $this->readAttributes($val2);
      }
      $finalArr[] = $resArr;
    }
    return $finalArr;
  }
  
  public function readBinding($a) {
    foreach ($a['binding'] as $key3 => $val3) {
      foreach ($val3 as $key4 => $val4) {
        $val = '';
        if (is_array($val4)) {
          foreach ($val4 as $key5 => $val5) { $key = $val5; }
        } else { $val = $val4; }
        $resultArr[$key] = $val;
      }
    }
    return $resultArr;
  }
  
  public function readAttributes($a) {
    foreach ($a as $key3 => $val3) {
      foreach ($val3 as $key4 => $val4) {
        $val = '';
        if (is_array($val4)) {
          foreach ($val4 as $key5 => $val5) { $key = $val5; }
        } else { $val = $val4; }
        $resultArr[$key] = $val;
      }
    }
    return $resultArr;
  }
  
  //http://localhost:3030/MyDataset/update
  public function updateAction ($data) {
    $url = $this->prevUrl.'update';
    $options = array('http' => array(
      'header'  => ['Content-type: application/sparql-update'],['Accept: application/json'],
      'method'  => 'POST',
      'content' => $data
    ));
    //print_r($options);
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
  }
  
  //http://localhost:3030/MyDataset/sparql
  public function deleteAction ($id,$table) {
    $db = new Database();
    $db->openDatabase();
    $result = $db->dbDelete($table,$id);
    if ($result) {$result = '<p class="success">Das Löschen war erfolgreich.</p>';}
    else {$result = '<p class="error">Das Löschen war NICHT erfolgreich.</p>';}
    return $result;
  }
  
  public function getFielddata($table,$request) {
    switch ($table) {
    case 'ip': //instructorPerson
      $fielddata=array(
          "ip"=>$request['ip'],
          "familyName"=>$request['familyName'],
          "givenName"=>$request['givenName'],
          "honorificPrefix"=>$request['honorificPrefix'],
          "email"=>$request['email'],
          "contructualHours"=>$request['contructualHours'],
          "reductingHours"=>$request['reductingHours']
      );
    break;
    case 'cp': //coursPlan
      $fielddata = array(
        "id" => $request["id"], 
        "semesterSeason" => $request["semesterSeason"],
        "name" => $request["name"],
        "startDate" => $request["startDate"],
        "timeRequired" => $request["timeRequired"],
        "isPartOf" => $request["isPartOf"]
      );
    break;
    case 'sp': //studyProgram
      $fielddata = array(
        "id" => $request["id"], 
        "name" => $request["name"],
        "educationalCredentialAwarded" => $request["educationalCredentialAwarded"],
        "timeRequired" => $request["timeRequired"],
        "provider" => $request["provider"]
      );
    break;
    default :
      echo 'No Table found. [function]';
    break;
    }
    return $fielddata;
  }
}
?>