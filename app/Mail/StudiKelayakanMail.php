<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\StudiKelayakan;

class StudiKelayakanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studiKelayakan;
    public $downloadLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(StudiKelayakan $studiKelayakan, $downloadLink)
    {
        $this->studiKelayakan = $studiKelayakan;
        $this->downloadLink = $downloadLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Studi Kelayakan BPMSPH')
                    ->view('template.surat_studi_kelayakan')
                    ->with([
                        'studiKelayakan' => $this->studiKelayakan,
                        'downloadLink' => $this->downloadLink,
                    ]);
    }
}
