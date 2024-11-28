<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        
        $this->data = $data;
    }


    public function build()
    {
       
        return $this->subject($this->data['subject'])->view('emails.formEmail');
        if ($this->data['subject'] == 'Registration Successful') {
            return $this->subject($this->data['subject'])->view('emails.registerEmail');
        } else {
            return $this->subject($this->data['subject'])->view('emails.formEmail');
        }
    }
}