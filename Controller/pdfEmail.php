<?php
require_once 'SendEmail.php';
class pdfEmail extends SendEmail {

  public function sendPdf(string $email,string $fileVersion) {
    $this->mail->addAddress($email);
    $this->mail->Subject = 'Good morning Friend.';
    $this->mail->Body = "Thank you For Shopping";
    $this->mail->addAttachment(__DIR__.'/../Uploads/Invoice'.$fileVersion.'.pdf');
    if ($this->mail->send()) {
      return TRUE;
    }
    return FALSE;
  }
}
