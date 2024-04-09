<?php
require_once 'SendEmail.php';
class OtpEmail extends BaseEmail {

  public function sendOtp(string $email, int $otp) {
    $this->mail->addAddress($email);
    $this->mail->Subject = 'OTP for Email Validation.';
    $this->mail->Body = "Email Validation OTP is -> " . "$otp";
    if ($this->mail->send()) {
      return TRUE;
    }
    return FALSE;
  }
}
