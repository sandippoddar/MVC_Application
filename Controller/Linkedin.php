<?php
require_once __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;

/**
 * This class represents to Implemnt Linkedin Login Feature.
 */
class Linkedin {
  public function LinkedInApi() {
    require __DIR__ . '/config.php';
    $client = new Client();
    if (isset($_GET['code'])) {
      $code = $_GET['code'];
      $acc_url = "https://www.linkedin.com/oauth/v2/accessToken";
      try {
        $response = $client->request('POST', $acc_url, [
          'form_params' => [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri
          ]
        ]);
        $arr = json_decode($response->getBody(), true);
        $id_token = $arr['id_token'];

        try {
          $ex_arr = explode('.', $id_token);
          $payload_encrypted = $ex_arr[1];
          $payload = json_decode(base64_decode($payload_encrypted),true);
          echo json_last_error_msg();
          require_once './Model/LoginSignup.php';
          $queryOb = new LoginSignup();
          if (!$queryOb->isEmailInDb($payload['email'])) {
            $dummyImgPath = './View/IMAGES/profile.webp';
            $imageData = file_get_contents($dummyImgPath); 
            $encodedImage = base64_encode($imageData);
            $queryOb->linkedinInsert($payload['name'], $payload['email'], $imageData);
            $_SESSION['flag'] = 1;
            $_SESSION['userEmail'] = $payload['name'];
            header("location: /Dashboard");
            exit();
          }
          else {
            $_SESSION['flag'] = 1;
            $_SESSION['userEmail'] = $payload['name'];
            header("location: /Dashboard");
            exit();
          }
        }
        catch (Exception $e) {
          echo $e->getMessage();
        }
      } 
      catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }
}
