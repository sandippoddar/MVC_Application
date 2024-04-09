<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Creds/DotEnvHandler.php';
use PHPMailer\PHPMailer\PHPMailer;

class BaseEmail extends DotEnvHandler {
  protected $mail;

  public function __construct() {
    $this->dotEnv();
    $this->mail = new PHPMailer(TRUE);
    $this->configureMail();
  }

  protected function configureMail() {
    $this->mail->isSMTP();
    $this->mail->Host = 'smtp.gmail.com';
    $this->mail->SMTPAuth = TRUE;
    $this->mail->Username = $_ENV['emailUser'];
    $this->mail->Password = $_ENV['emailPass'];
    $this->mail->SMTPSecure = 'ssl';
    $this->mail->Port = 465;
    $this->mail->setFrom('sandip.poddar@innoraft.com');
    $this->mail->isHTML(TRUE);
  }
}