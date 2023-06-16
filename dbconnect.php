
<?php 
// class Database {
//     private $host = 'localhost';
//     private $username = 'root';
//     private $password = '';
//     private $dbname = 'test';
//     private $dbConn;

//     public function __construct() {
//         $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
//         $options = array(
//             PDO::ATTR_PERSISTENT => true,
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         );

//         try {
//             $this->dbConn = new PDO($dsn, $this->username, $this->password, $options);
//         } catch (PDOException $e) {
//             die('Connection failed: ' . $e->getMessage());
//         }
//     }

//     public function getConnection() {
//         return $this->dbConn;
//     }

//      function getRecords( $tableName , $parama)  {
//         $query = $this->dbConn->prepare("SELECT * FROM membertable WHERE parentid = :parentId");
//         $query->bindParam(':'. $parama['field'], $parama['value']);
//         $query->execute();

//         $records = $query->fetchAll(PDO::FETCH_ASSOC);
//         return $records; 
        
//      }
// }



class TreeBuilder {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function inddex() {
        $data = $this->getrecords();
       
        return $this->listReords($data);
    }

    private function getrecords ($parent = 0) {
        $query = "SELECT  id, name , parentid FROM membertable  WHERE parentid = :parent_id";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':parent_id', $parent);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function listReords($items) {
        $html = '<ul>';
        foreach ($items as $item) {
            $html .= '<li>' . $item['name'];
            $chilDtaa = $this->getrecords($item['id']);

            if (!empty($chilDtaa)) {
                $html .= $this->listReords($chilDtaa);
            }

            $html .= '</li>';
        }

        $html .= '</ul>';

        return   $html;
    }
}

// PDO database connection
$dbHost = 'localhost';
$dbName = 'test';
$dbUser = 'root';
$dbPass = '';

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $treeBuilder = new TreeBuilder($db);
    $htmlTree = $treeBuilder->buildTree();

    echo $htmlTree;
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>