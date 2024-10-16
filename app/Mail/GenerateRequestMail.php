<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GenerateRequestMail extends Mailable
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
        $pdf = PDF::loadView('emails.generate-request'); // , $this->data

        return $this->from('info@cisams.com')
            ->subject('Application Report Request')
            ->view('emails.generate-request')
            ->attachData($pdf->output(), 'document.pdf', [
                'mime' => 'application/pdf',
            ]); // Attach PDF without storing it;
    }
}
