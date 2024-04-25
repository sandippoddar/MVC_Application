<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Creds/DotEnvHandler.php';

/**
 * This class represents to Connect with the Database.
 */
class Connection extends DotEnvHandler {

  /**
   * @var string.
   * 
   *  Use here to store Server name.
   */
  private $servername;

  /**
   * @var string.
   * 
   *  Store Username to connect with database.
   */
  private $username;

  /**
   * @var string.
   * 
   *  Store Password of User.
   */
  private $password;

  /**
   * @var string.
   * 
   *  Store Database name.
   */
  private $dbname;

  /**
   * @var \PDO $conn
   * 
   * Conn variable use here to know if the database is Connected or not and 
   * it return true or false.
   */
  protected $conn;

  /**
   * This constructor is use here to initialize Instance member $conn with 
   * Object of PDO class.
   */
  public function __construct() {
    try {
        $this->dotEnv();
        $this->servername = $_ENV['severname'];
        $this->username = $_ENV['userName'];
        $this->password = $_ENV['password'];
        $this->dbname = $_ENV['dbName'];
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
  }

  /**
   * This function use here to close Connection with Database.
   * 
   * @return NULL
   */
  public function closeConnection() {
    return $this->conn = NULL;
  }
} 
