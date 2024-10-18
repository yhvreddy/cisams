<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class WhatsAppRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }


    public function build()
    {
        // Generate PDF from view in-memory
        $pdf = PDF::loadView('emails.whatsapp-generate-request'); // , $this->data

        return $this->from('info@cisams.com')
            ->subject('WhatsApp Report Request')
            ->view('emails.whatsapp-generate-request')
            ->attachData($pdf->output(), 'document.pdf', [
                'mime' => 'application/pdf',
            ]); // Attach PDF without storing it;
    }
}
