<?php
require_once __DIR__ . '/../Model/connection.php';

class LoginSignup extends Connection {
  public function __construct() {
    Connection::__construct();
  }

  /**
   * Function to insert records when new User registered.
   * 
   * @param string $userName
   *  Stores Username of new User.
   * @param string $email
   *  Stores Email Id of new User.
   * @param string $password
   *  Stores Password in hash format.
   * 
   * @return void
   */
  public function insert(string $userName, string $email, string $password, string $type) {
    $sql = $this->conn->prepare("INSERT INTO User (UserName, Email, User_type, Password) VALUES(:userName, :email, :type, :password)");
    $sql->execute(array(':userName' => $userName, ':email' => $email, ':type' => $type, ':password' => $password));
  }

  /**
   * Function to check if Username or Email is already in the Database or not.
   * 
   * @param string $userName
   *  Store Username of the User.
   * @param string $email
   *  Store Email Id of User.
   * 
   * @return string|bool
   */
  public function Duplicate (string $userName, string $email) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :email OR UserName = :userName");
    $sql->execute(array(':email' => $email, 'userName'=> $userName));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return 'Username or Email has already Taken!!';
    }
    return False;
  }

  /**
   * Function to Check if the Email ID is already in the Database or not.It is 
   * using in Reset Password feature to send Reset Password Link.
   * 
   * @param string $userEmail
   *  Stores Email ID of the User.
   * 
   * @return bool
   */
  public function isEmailInDb (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :userEmail");
    $sql->execute([':userEmail' => $userEmail]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Function to Login user by checking the Email ID or Username is Already
   * stored in the Database or not.
   * 
   * @param string $userEmail
   *  Stores the Data as per the User enter Username or Email.
   * 
   * @return array|bool
   */
  public function LoginSelect (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :Email OR UserName = :username");
    $sql->execute(array(':Email' => $userEmail, ':username'=> $userEmail));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return [$result['Password'],$result['User_type']];
    }
    return FALSE;
  }
  public function addPost (string $productName, string $details, string $image) {
    $sql = $this->conn->prepare("INSERT INTO Product (Product_name, caption, image) VALUES(:productName, :details, :image)");
    $sql->execute(array(':productName' => $productName, ':details' => $details, ':image' => $image));
  }

  public function fetchProduct () {
    $sql = $this->conn->prepare("SELECT * FROM Product");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

}
