<?php
//require_once 'dbconnect.php';
class RecordLister 
{

    private $conn;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'test';

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }


    public function index() {
        $data = $this->getrecords();
        return $this->listReords($data);
    }

    private function getrecords ($parent = 0) {
        $query = "SELECT  id, name , parentid FROM membertable  WHERE parentid = :parent_id";
        $statement = $this->conn->prepare($query);
        $statement->bindValue(':parent_id', $parent);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function listReords($items) {
        $html = '<ul>';
        foreach ($items as $item) {
            $html .= '<li id ="mem_'.$item['id'].'" >' . $item['name'];
            $chilDtaa = $this->getrecords($item['id']);

            if (!empty($chilDtaa)) {
                $html .= $this->listReords($chilDtaa);
            }
            $html .= '</li>';
        }

        $html .= '</ul>';

        return   $html;
    }
    public function listOfParents(){
        $query = "SELECT  id, name  FROM membertable";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMender($param) {
        return $this->insertdMember( $param );

    }

    private function insertdMember($param)  {

        $parent = $param['parent'];
        $name   = $param['mem_name'];
    
        $query = $this->conn->prepare("INSERT INTO membertable (parentid, name) VALUES (:parent, :name)");
        $query->bindValue(':parent', $parent);
        $query->bindValue(':name', $name);
        if ($query->execute() ){
            $insertid = $this->conn->lastInsertId();
            $html = '<li id ="mem_'.$insertid.'" >' . $name.'</li>';
            return  $html;
       
        }
        
    }


}

$recordLister = new RecordLister();

if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])  &&  $_POST['action'] === 'add_men' ){
    echo $recordLister->addMender($_POST);
}










