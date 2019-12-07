<?php
class Content {
  protected $path = 'Templates';
  protected $template = 'default';
  protected $search = '0';

  public function loadTemplate($path,$template){
    $file = $path . DIRECTORY_SEPARATOR . $template . '.php';
    $exists = file_exists($file);
    if ($exists){
      ob_start();
      include $file;
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
    }
    else {
      return 'Could not find template. [content]';
    }
  }
  
  /**
   * Methode zum anzeigen des Contents.
   * @return String Content der Applikation.
   */
  public function display($request){
    if ($request['controller'] && $request['model']) {
      $path = 'Templates/'.$request['model'];
      $template = $request['controller'];
    } else {
      $path = 'Templates';
      $template = 'default';
    }
    return $this->loadTemplate($path,$template);
  }
}
?>