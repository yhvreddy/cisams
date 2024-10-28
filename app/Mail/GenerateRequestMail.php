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

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
        $data = $this->data;
        $requestData = $data['requestData'];
        $logo = url('/assets/emails/logo.jpg');
        // Generate PDF from view in-memory
        $pdf = PDF::loadView('emails.generate-request', ['data' => $data, 'requestData' => $requestData, 'logo' => $logo]); // , $this->data

        return $this->from('info@cisams.com')
            ->subject('Application Report Request')
            ->view('emails.generate-request', compact('data', 'requestData', 'logo'))
            ->attachData($pdf->output(), 'document.pdf', [
                'mime' => 'application/pdf',
            ]); // Attach PDF without storing it;
    }
}
