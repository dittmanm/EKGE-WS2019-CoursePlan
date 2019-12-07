<?php
class Layout {
		
	public function getWsMenu() {
   	$wi_ba = array(
			"1. Semester" => "?model=cp&controller=wi_ba&season=1S",
      "3. Semester" => "?model=cp&controller=wi_ba&season=3S",
      "5. Semester" => "?model=cp&controller=wi_ba&season=5S"  
		);
   	$wi_ma = array(
			"1. Semester" => "?model=cp&controller=wi_ma&season=1S",
      "3. Semester" => "?model=cp&controller=wi_ma&season=3S",
      "5. Semester" => "?model=cp&controller=wi_ma&season=5S"  
		);
    $bwl_ba = array(
			"1. Semester" => "?model=cp&controller=bwl_ba&season=1S",
      "3. Semester" => "?model=cp&controller=bwl_ba&season=3S",
      "5. Semester" => "?model=cp&controller=bwl_ba&season=5S"  
    );
    $bwl_ma = array(
			"1. Semester" => "?model=cp&controller=bwl_ma&season=1S",
      "3. Semester" => "?model=cp&controller=bwl_ma&season=3S",
      "5. Semester" => "?model=cp&controller=bwl_ma&season=5S"  
    );
    $dp = array(
      "Sommersemester" => "?model=ip&controller=ip&season=WS",
      "Wintersemester" => "?model=ip&controller=ip&season=SS"
    );
    
    $menu = array(
			"WI Bachelor" => $wi_ba,
			"WI Master" => $wi_ma,
      "BWL Bachelor" => $bwl_ba,
      "BWL Master" => $bwl_ma,
      "Dozentenplanung" => $dp
		);
    return $menu;
  }
	
  public function getSsMenu() {
   	$wi_ba = array(
			"2. Semester" => "?model=cp&controller=wi_ba&season=2S",
      "4. Semester" => "?model=cp&controller=wi_ba&season=4S"  
		);
   	$wi_ma = array(
			"2. Semester" => "?model=cp&controller=wi_ma&season=2S",
      "4. Semester" => "?model=cp&controller=wi_ma&season=4S"  
		);
    $bwl_ba = array(
			"2. Semester" => "?model=cp&controller=bwl_ba&season=2S",
      "4. Semester" => "?model=cp&controller=bwl_ba&season=4S"  
    );
    $bwl_ma = array(
			"2. Semester" => "?model=cp&controller=bwl_ma&season=2S",
      "4. Semester" => "?model=cp&controller=bwl_ma&season=4S"  
    );
    $dp = array(
      "Sommersemester" => "?model=ip&controller=ip&season=WS",
      "Wintersemester" => "?model=ip&controller=ip&season=SS"
    );
    
    $menu = array(
			"WI Bachelor" => $wi_ba,
			"WI Master" => $wi_ma,
      "BWL Bachelor" => $bwl_ba,
      "BWL Master" => $bwl_ma,
      "Dozentenplanung" => $dp
		);
    return $menu;
  }
  
  /**
   * Create Menu for all Users
   * @return string
   */
  public function getMenu($season=1) {
		if($season === 1) {
			$menu = $this->getSsMenu();
		} else {
			$menu = $this->getWsMenu();
		}
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
//		if($session === 1) {
//			$menu = array("Logout" => "?model=login&controller=logout");
//		} else {
//			$menu = array("Login" => "?model=login&controller=login");
//		}
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