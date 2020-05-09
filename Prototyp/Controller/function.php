<?php
class Main {
  protected $prevUrl = 'http://fbw-sgmwi.th-brandenburg.de:3030/CoursPlan2/';
  
  function __construct() {
    global $request;
    if (isset($request['action'])) {
      if($request['action'] === 'login') {
          $request['output'] = $this->manageLoginSession($request['username'], $request['password']);
      } elseif ($request['action'] === 'logout') {
          $request['output'] = $this->manageLoginSession('', '');
      }
    }
  }

  public function generateKey($name, $length = 10) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $namArr = (str_word_count($name, 5));
    $key = '';
    foreach ($namArr as $value) {
      $word = $word . substr($value, 0, 1);
    }
    if (strlen($word) < $length) {
      $length = $length - strlen($word);
      $key = $key . substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    } else {
      $key = $word;
    }
    return $key;
  }
  
  /**
	 * Create Login
	 */
	public function manageLoginSession($username, $password) {
    global $request;
    $un = 'CoursePlan';
    $pw = '20adMin20';
		if ($username === $un && $password === $pw) {
      $request['s_login'] = 1;
      $_SESSION['s_username'] = $username;
			$this->checkSession('s_login');
			$result = 'Login erfolgreich.';
		} elseif ($username === $un && $password !== $pw) {
			$result = 'Login fehlgeschlagen. Bitte Passwort überprüfen.';
		} elseif ($username !== $un && $password === $pw) {
			$result = 'Login fehlgeschlagen. Bitte Benutzername überprüfen.';
		} else {
      $request['s_login'] = 0;
      $_SESSION['s_username'] = null;
			$this->checkSession('s_login');
			$result = 'Logout erfolgreich.';
    }
		return $result;
	}

  /**
   * Search for Session
   * create a Session
   * delete a Session
   */
  public function checkSession($s_name) {
    global $request;
    $result = 0;
    switch ($s_name) {
      case 's_season':
        if ( isset($request['s_season']) ) {
          $result = $request['s_season'];
          $_SESSION['s_season'] = $request['s_season'];
        } break;
        case 's_year':
          if ( isset($request['s_year']) ) {
            $result = $request['s_year'];
            $_SESSION['s_year'] = $request['s_year'];
          } break;
        case 's_login':
          if ( isset($request['s_login']) ) {
            $result = $request['s_login'];
            $_SESSION['s_login'] = $request['s_login'];
          } break;
      default: session_unset();
    }
  }
	
  /**
   * Check the created Session
   * season: WS => 1 | SS => 2
   * year: kann ausgeählt werden um die vergangenen Jahre(Semester) auszuwerten
   * login: logout => 0 | login => 1
   */
  public function getSession($s_name) {
    $result = 0;
    switch ($s_name) {
      case 's_season':
        if(isset($_SESSION['s_season'])) {
          if($_SESSION['s_season'] === 'WS') { $result = 1; }
          elseif($_SESSION['s_season'] === 'SS') { $result = 2; }
        } break;
      case 's_year':
        if(isset($_SESSION['s_year'])) { $result = $_SESSION['s_year']; }
      break;
      case 's_login':
        if(isset($_SESSION['s_login'])) { $result = $_SESSION['s_login']; }
      break;
      default: $result = 0;
    }
		return $result;
  }
  
  public function queryAction ($data) {
    //echo 'queryAction';
    $url = $this->prevUrl.'query';
    $options = array('http' => array(
      'header'  => ['Content-type: application/sparql-query'],['Accept: application/json'],
      'method'  => 'POST',
      'content' => $data
    ));
    //print_r($options);
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) 
      { echo '<p class=""error>Es ist beim Aufruf des Fuseki Servers ein Fehler aufgetreten. (Class:main)</p>'; }
    $xml = simplexml_load_string($result);
    //print_r($xml);
    $jsonEn = json_encode($xml);
    $jsonDe= json_decode($jsonEn,TRUE);
    $result1 = $jsonDe['results'];
    //print_r($result1);
    if (!empty($result1)) {
      foreach ($result1['result'] as $key2 => $val2) {
        if (isset($val2['binding'])) {
          $resArr = $this->readBinding($val2);
        } else {
          $resArr = $this->readAttributes($val2);
        }
        $finalArr[] = $resArr;
      }
    } else {
      $finalArr = 0;
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
  
  //http://.../FUSEKI-DATASET/update
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
  
  //http://.../FUSEKI-DATASET/sparql
  public function sparqlAction ($data) {
    //print_r($data);
    $url = $this->prevUrl.'sparql';
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
  
  public function getFielddata($table,$request) {
    switch ($table) {
    case 'ip': //instructorPerson
      $fielddata=array(
          "ip"=>$request['ip'],
          "familyName"=>$request['familyName'],
          "givenName"=>$request['givenName'],
          "honorificPrefix"=>$request['honorificPrefix'],
          "email"=>$request['email'],
          "contractualHours"=>$request['contractualHours'],
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