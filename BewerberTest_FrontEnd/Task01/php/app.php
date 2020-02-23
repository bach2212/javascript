<?php
/**
 * 1. Add a SQL Statement to the function getUserFromDb which selects everything from the user table with an email.
 * 2. Build the response with a status code and a message.
 * 3. check if the necessary parameters are set in the GET request. Call the getUser function and echo the data in the right format
 * The output should contain status 200, the id and the email if the user exists, if the user does not exists, status 404 and a meaningful message
 *
 * HINT: Do not forget to extend from the PDO class
 */

class App extends PDO {

  public function __construct() {}

  /* if you have other database parameters then you can edit them */
  public function getUserFromDb($email) {
    $server   = 'mysql:dbname=bewerber;host=localhost';
    $user     = 'root';
    $password = 'root';
    $pdo = new PDO($server, $user, $password);

    /* 1. TODO */
    $stmt = $pdo->prepare("SELECT * from user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetchAll();
    return $result[0];
  }

  public function getUser($email) {
    $response = [];
    $result = $this->getUserFromDb($email);
    /* 2. TODO */
    if (sizeof($result) > 0) {
      $response["status"] = 200;
      $response["message"] = $result["id"] . " => " . $result["email"];
    }
    else {
      $response["status"] = 404;
      $response["message"] = "User not found";
    }

    return $response;
  }
}

$a = new App();

/* 3. TODO */
if (isset($_GET['method']) && $_GET['method'] === "getUser") {
  if (isset($_GET['email'])) {
    $response = $a->getUser($_GET['email']);
    echo json_encode($response);
  }
}
