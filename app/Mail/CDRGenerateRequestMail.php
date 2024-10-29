<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CDRGenerateRequestMail extends Mailable
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
        $requestData = $this->data['requestData'];
        $crimeInfo = $this->data['crimeInfo'];

        // Generate PDF from view in-memory
        $pdf = PDF::loadView('emails.cdr-generate-request', ['data' => $data, 'requestData' => $requestData, 'crimeInfo' => $crimeInfo])->setPaper('A4', 'landscape'); // , $this->data

        return $this->from('info@cisams.com')
            ->subject('CDR Report Request')
            ->view('emails.cdr-generate-request', compact('data', 'requestData', 'crimeInfo'))
            ->attachData($pdf->output(), 'document.pdf', [
                'mime' => 'application/pdf',
            ]); // Attach PDF without storing it;
    }
}
