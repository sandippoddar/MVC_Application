<?php
require_once __DIR__ . '/../Model/Connection.php';

class LoginSignup extends Connection {
  public function __construct() {
    parent::__construct();
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
  public function Insert(string $userName, string $email, string $password, string $image) {
    $sql = $this->conn->prepare("INSERT INTO User (UserName, Email, Password, Profileimg) VALUES(:userName, :email, :password, :image)");
    $sql->execute(array(':userName' => $userName, ':email' => $email, ':password' => $password, ':image' => $image));
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
   *  This function returns String when Username or Email is in Database and
   *  returns False when Username or Email is not in the Database.
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
   *  This function return TRUE if Email ID is in the Database or return FALSE
   *  if Email ID is not in the Database.
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
   * @return int|bool
   *  This Function return Password of the User which Email or Username is in the
   *  Database or return False if User's Email or Username is not in Database.
   */
  public function LoginSelect (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :Email OR UserName = :username");
    $sql->execute(array(':Email' => $userEmail, ':username'=> $userEmail));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($result != []) {
      return $result['Password'];
    }
    return FALSE;
  }

  /**
   * Function to Fetch User profile details from User Table.
   * 
   * @param string $userEmail
   *  Stores the Data as per the User enter Username or Email.
   * 
   * @return array
   *  Array containing user details for the given User Email. 
   */
  public function fetchUserProfile (string $userEmail) {
    $sql = $this->conn->prepare("SELECT * FROM User WHERE Email = :Email OR UserName = :username");
    $sql->execute(array(':Email' => $userEmail, ':username'=> $userEmail));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * Function to Add new post to Post Table.
   * 
   * @param string $user
   *  Stores Username of the User.
   * @param string $caption
   *  Stores Caption of a post.
   * @param string $image
   *  Stores image using Blob datatype.
   * 
   * @return void
   */
  public function addPost (string $user, string $caption, string $image) {
    $sql = $this->conn->prepare("INSERT INTO POST (User, Caption, Image) VALUES(:userName, :caption, :image)");
    $sql->execute(array(':userName' => $user, ':caption' => $caption, ':image' => $image));
  }

  /**
   * Function to fetch all post from Post Table in Descending order.
   * 
   * @return array
   */
  public function fetchUser () {
    $sql = $this->conn->prepare("SELECT * FROM POST ORDER BY TIME DESC LIMIT 2");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * Function to implement Load more feature.
   * 
   * @param int $countLoad
   *  Stores the Offset Value.
   * 
   * @return array
   */
  public function loadProfile (int $countLoad) {
    $sql = $this->conn->prepare("SELECT * FROM POST ORDER BY TIME DESC LIMIT 2 OFFSET $countLoad");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /**
   * Function to edit 
   */
  public function editUser (string $userName, string $image, string $oldName) {
    if ($image === '') {
      $sql = $this->conn->prepare("UPDATE User JOIN POST ON User.UserName = POST.User JOIN LIKES ON User.UserName = LIKES.USER SET User.UserName = :userName, POST.User = :userName, LIKES.USER = :userName WHERE User.UserName = :oldName AND POST.User = :oldName AND LIKES.USER = :oldName");
      $sql->execute(array(':userName' => $userName, ':oldName' => $oldName));
    }
    else {
      $sql = $this->conn->prepare("UPDATE User JOIN POST ON User.UserName = POST.User JOIN LIKES ON User.UserName = LIKES.USER SET User.UserName = :userName, POST.User = :userName, LIKES.USER = :userName, User.Profileimg = :image WHERE User.UserName = :oldName AND POST.User = :oldName AND LIKES.USER = :oldName");
      $sql->execute(array(':userName' => $userName, ':image' => $image, ':oldName' => $oldName));
    }
    
  }

  public function isliked (string $user, int $postId) {
    $sql = $this->conn->prepare("SELECT * FROM LIKES WHERE USER = :user AND POST_ID = :id");
    $sql->execute([':user' => $user, ':id' => $postId]);
    if ($sql->rowCount() > 0) {
      return TRUE;
    }
    return FALSE;
  }

  public function insertLikeTable (string $user, int $postId) {
    $sql = $this->conn->prepare("INSERT INTO LIKES(USER, POST_ID) VALUES(:user, :id)");
    $sql->execute([':user' => $user, ':id' => $postId]);
  }

  public function incrementLike (int $postid) {
    $sql = $this->conn->prepare("UPDATE POST SET `LIKE` = (COALESCE(`LIKE`, 0) + 1) WHERE POST_ID = $postid");
    $sql->execute();
  }

  public function getLike (int $postid) {
    $sql = $this->conn->prepare("SELECT `LIKE` FROM POST WHERE POST_ID = $postid");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($sql->rowCount() > 0) {
      return $result;
    }
  }

  public function linkedinInsert (string $user, string $email, string $image) {
    $sql = $this->conn->prepare("INSERT INTO User (UserName, Email, Profileimg) VALUES(:userName, :email, :image)");
    $sql->execute(array(':userName' => $user, ':email' => $email, ':image' => $image));
  }

  public function insertCommentTable (string $user, int $postId, string $comment) {
    $sql = $this->conn->prepare("INSERT INTO COMMENTS(USER, POST_ID, COMMENT) VALUES(:user, :id, :comment)");
    $sql->execute([':user' => $user, ':id' => $postId, ':comment' => $comment]);
  }

  public function fetchComment (int $postId) {
    $sql = $this->conn->prepare("SELECT * FROM COMMENTS WHERE POST_ID = :id ORDER BY COMMENT_ID DESC");
    $sql->execute([':id' => $postId]);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function incrementComment (int $postid) {
    $sql = $this->conn->prepare("UPDATE POST SET COMMENT = (COALESCE(COMMENT, 0) + 1) WHERE POST_ID = $postid");
    $sql->execute();
  }

  public function getComment (int $postid) {
    $sql = $this->conn->prepare("SELECT COMMENT FROM POST WHERE POST_ID = $postid");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if ($sql->rowCount() > 0) {
      return $result;
    }
  }
  
} 