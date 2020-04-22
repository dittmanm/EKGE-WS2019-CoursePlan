<?php
class Layout {

	public function getNormalMenu($s_season) {
    global $request;
    //studyprograms
    include_once("function.php");
    include_once("spController.php");
    include_once("mpController.php");
    $main = new Main();
    $stp = new StudyProgram();
    $mp = new ModulPlan();
    $sps = $main->queryAction($stp->getStudyPrograms());
    if ($s_season === 1) {$sseason = 'WS';}
     else {$sseason = 'SS';}
    foreach($sps as $datArr) {
      //startdates
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $datArr['id']);
      $sd = $main->queryAction($mp->getStartdates('"'.$sseason.'" '.$datArr['id']));
      unset($resArr);
      foreach ($sd as $subArr) {
        $sp = str_replace('cp:', '', $datArr['id']);
        $season = substr($subArr['startDate'], 0, 1).substr($subArr['startDate'], 2, 1);
        $resArr[$subArr['startDate']] = "?model=cp&controller=cp&sp=".$sp."&season=".$season;
      }
      $menu[$datArr['name']] = $resArr;
    }
    $settings = array(
      "Dozentenplanung" => "?model=ip&controller=ip",
      "Modulplanung" => "?model=mp&controller=mp&sp=wi_ba"
    );
    $menu['Einstellungen'] = $settings;
    return $menu;
  }

	public function getWsMenu() {
   	$wi_ba = array(
			"1. Semester" => "?model=cp&controller=cp&sp=wi_ba&season=1S",
      "3. Semester" => "?model=cp&controller=cp&sp=wi_ba&season=3S",
      "5. Semester" => "?model=cp&controller=cp&sp=wi_ba&season=5S"  
		);
   	$wi_ma = array(
			"1. Semester" => "?model=cp&controller=cp&sp=wi_ma&season=1S",
      "3. Semester" => "?model=cp&controller=cp&sp=wi_ma&season=3S"
		);
    $bwl_ba = array(
			"1. Semester" => "?model=cp&controller=cp&sp=bwl_ba&season=1S",
      "3. Semester" => "?model=cp&controller=cp&sp=bwl_ba&season=3S",
      "5. Semester" => "?model=cp&controller=cp&sp=bwl_ba&season=5S"  
    );
    $bwl_ma = array(
			"1. Semester" => "?model=cp&controller=cp&sp=bwl_ma&season=1S",
      "3. Semester" => "?model=cp&controller=cp&sp=bwl_ma&season=3S"  
    );
    $dp = array(
      "Dozentenplanung" => "?model=ip&controller=ip",
      "Modulplanung" => "?model=mp&controller=mp&sp=wi_ba"
    );
    
    $menu = array(
			"WI Bachelor" => $wi_ba,
			"WI Master" => $wi_ma,
      "BWL Bachelor" => $bwl_ba,
      "BWL Master" => $bwl_ma,
      "Einstellungen" => $dp
		);
    return $menu;
  }
	
  public function getSsMenu() {
   	$wi_ba = array(
			"2. Semester" => "?model=cp&controller=cp&sp=wi_ba&season=2S",
      "4. Semester" => "?model=cp&controller=cp&sp=wi_ba&season=4S"  
		);
   	$wi_ma = array(
			"2. Semester" => "?model=cp&controller=cp&sp=wi_ma&season=2S" 
		);
    $bwl_ba = array(
			"2. Semester" => "?model=cp&controller=cp&sp=bwl_ba&season=2S",
      "4. Semester" => "?model=cp&controller=cp&sp=bwl_ba&season=4S"  
    );
    $bwl_ma = array(
			"2. Semester" => "?model=cp&controller=cp&sp=bwl_ma&season=2S"  
    );
    $dp = array(
      "Dozentenplanung" => "?model=ip&controller=ip",
      "Modulplanung" => "?model=mp&controller=mp&sp=wi_ba"
    );
    
    $menu = array(
			"WI Bachelor" => $wi_ba,
			"WI Master" => $wi_ma,
      "BWL Bachelor" => $bwl_ba,
      "BWL Master" => $bwl_ma,
      "Einstellungen" => $dp
		);
    return $menu;
  }
  
  /**
   * Create Menu for all Users
   * WS => 1
   * SS => 2
   * 0 => Automatische Auswahl durch Monat
   * @return string
   */
  public function getMenu($s_season) {
    // if($s_season === 1) {$this->getWsMenu();} 
    //elseif($s_season === 2) {$this->getSsMenu();
    $menu = $this->getNormalMenu($s_season);
		$data = '';
    $data.= '<ul class="menu">';
    foreach ($menu as $key => $attribute) {
      $data.= '<li>'.$key.'<ul class="submenu">';
      foreach ($attribute as $val => $value) {
        $data.= '<li><a href="'.$value.'">'.$val.'</a></li>';
      }
      $data.='</ul></li>';
    }
    $data.= '</ul>';
    return $data;
  }
  /**
   * Create Menu for Login
   * @return string
   */
  public function getLoginMenu($session=0) {
    $menu = array("Einstellungen" => "?model=settings&controller=settings");
		$data = '';
		$data.= '<ul class="login-menu">';
    foreach ($menu as $key => $value) {
        $data.= '<li><a href="'.$value.'">'.$key.'</a></li>';
    }
    $data.= '</ul>';
    
		return $data;
  }
  /**
   * Get Logo to display in the content
   * @return string
   */
  public function getLogo() {
    $data = '<img src="images/THB_Logo.svg">';
    return $data;
  }
  /**
   * Get fav.ico to display in the head
   * @return string
   */
  public function getIcon() {
    $data = '<img src="images/logo.ico">';
    return $data;
  }
  /**
   * Title Information
   * @return string
   */
  public function getHeaderInfo() {
    $data = "Course Planung";
    return $data;
  }
  /**
   * Firtst Headline
   * @return string
   */
  public function getName() {
    $data = "Lehrplanung";
    return $data;
  }
}
?>