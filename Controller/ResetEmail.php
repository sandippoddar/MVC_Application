<?php
require_once 'SendEmail.php';
class ResetEmail extends BaseEmail {

  public function sendResetEmail(string $email, string $token) {
    $this->mail->addAddress($email);
    $this->mail->Subject = 'Reset Password Email';
    $this->mail->Body = "click here to reset password -> http://mvctask/resetpassword?token=" . "$token";
    if ($this->mail->send()) {
      return TRUE;
    }
    return FALSE;
  }
}
