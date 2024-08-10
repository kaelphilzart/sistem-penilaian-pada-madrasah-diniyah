<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AkunWaliMail extends Mailable
{
    use Queueable, SerializesModels;

    public $NISN;
    public $email;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nisn, $email, $password)
    {
        $this->nisn = $nisn;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.pesan-akun')
                    ->subject('Akun Wali Murid Baru')
                    ->with([
                        'nisn' => $this->nisn,
                        'email' => $this->email,
                        'password' => $this->password,
                    ]);
    }
}
