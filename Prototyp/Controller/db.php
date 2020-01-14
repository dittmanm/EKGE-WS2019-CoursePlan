<?php
class Database {
    protected $mysqli;
    
    public function openDatabase() {
        $this->mysqli = new mysqli("localhost","martin","honda","mdittmann");
        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
    
    public function dbCreate($table) {
        $val = $this->mysqli->query("SELECT * FROM $table");
        if($val == FALSE) {echo "Doesn't exist.";}
        switch ($table) {
          case 'books':
            if ($this->mysqli->query("CREATE TABLE IF NOT EXISTS $table (id INT(11) AUTO_INCREMENT,title VARCHAR(100),subtitle VARCHAR(100),isbn VARCHAR(100),number INT,publisher VARCHAR(100),description TEXT,ausgeliehen INT(11), PRIMARY KEY (`id`))") === FALSE) { echo "Table ".$table." was not created."; }
          break; case 'schoolbooks':
            if ($this->mysqli->query("CREATE TABLE IF NOT EXISTS $table (id INT(11) AUTO_INCREMENT,title VARCHAR(100),subtitle VARCHAR(100),isbn VARCHAR(100),number INT,publisher VARCHAR(100),class VARCHAR(100),subject VARCHAR(100),ausgeliehen INT(11), PRIMARY KEY (`id`))") === FALSE) { echo "Table ".$table." was not created."; }
          break; case 'users':
            if ($this->mysqli->query("CREATE TABLE IF NOT EXISTS $table (id INT(11) AUTO_INCREMENT,lastname VARCHAR(100),firstname VARCHAR(100),schoolpart VARCHAR(100),position VARCHAR(100),email VARCHAR(255), PRIMARY KEY (`id`))") === FALSE) { echo "Table ".$table." was not created."; }
          break; case 'beusers':
            if ($this->mysqli->query("CREATE TABLE IF NOT EXISTS $table (id INT(11) AUTO_INCREMENT,lastname VARCHAR(100),firstname VARCHAR(100),username VARCHAR(100),passwort VARCHAR(255),schoolpart VARCHAR(100),position VARCHAR(100),email VARCHAR(255), PRIMARY KEY (`id`))") === FALSE) { echo "Table ".$table." was not created."; }
          break; case 'lendings':
            if ($this->mysqli->query("CREATE TABLE IF NOT EXISTS $table (id INT(11) AUTO_INCREMENT,sbook_id INT(11),book_id INT(11),user_id INT(11),startdate VARCHAR(100),enddate VARCHAR(100),status VARCHAR(100),number INT(11), PRIMARY KEY (`id`))") === FALSE) { echo "Table ".$table." was not created."; }
          break; default:
            echo 'Table failed';
          break;
        }
    }
    public function dbSelect($table) {
        $query = "SELECT * FROM $table";
        $result = $this->mysqli->query($query);
        if (!$result) {
            return array();
        }
        $data = array();
        while ($row = $result->fetch_assoc()) {
              $data[]=$row;
        }
        return $data;
    }
    public function dbSelectWhere($table,$where) {
        $query = "SELECT * FROM $table WHERE $where";
        $result = $this->mysqli->query($query);
        if (!$result) {
            return array();
        }
        $data = array();
        while ($row = $result->fetch_assoc()) {
              $data[]=$row;
        }
        return $data;
    }
    public function dbInsert($table,$fielddata) {
        $fieldarray = array();
        $valuearray = array();
        foreach ($fielddata as $key => $value) {
          $fieldarray[] = $key;
          $valuearray[] = '"'.$value.'"';
        }
        $query = 'INSERT INTO '.$table.' ('.implode(',',$fieldarray).') VALUES ('.implode(',',$valuearray).')';
        $result = $this->mysqli->query($query);
        if (!$result) {
          $result =  'DBInsert Function was failed.';
        }
        return $result;
    }
    public function dbUpdate($table,$fielddata,$id) {
        $fieldarray = array();
        foreach ($fielddata as $key => $value) {
          $fieldarray[] = $key.'="'.$value.'"';
        }
        $query = 'UPDATE '.$table.' SET '.implode(',',$fieldarray).' WHERE id='.$id;
        $result = $this->mysqli->query($query);
        if (!$result) {
            $result =  'DBUpdate Function was failed. ';
        }
        return $result;
    }
    public function dbDelete($table,$id) {
        //Datensatz löschen
        $query = "DELETE FROM $table WHERE id=$id";
        $result = $this->mysqli->query($query);
        if (!$result) {
            $result =  'DBDelete Function was failed. ';
        }
        return $result;
    }
    public function dbDrop($table) {
        //Tabelle löschen
        $query = "DROP TABLE $table";
        $result = $this->mysqli->query($query);
        if (!$result) {
            $result =  'DBDrop Function was failed. ';;
        }
        return $result;
    }
}
?>