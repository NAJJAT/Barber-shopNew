<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactFormEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission')
        ->from($this->details['email'])
        ->to('visitor-series@aegzmfl2.mailosaur.net') // replace with your email address

                    ->view('user.emails.contact');
    }

    
        //create method 
        public function create(array $data)
        {
            return Contact::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
            ]);
        }
      
}
