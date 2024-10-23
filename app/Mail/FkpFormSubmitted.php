<?php

namespace App\Mail;

use App\Models\FkpForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FkpFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $fkpForm;

    public function __construct(FkpForm $fkpForm)
    {
        $this->fkpForm = $fkpForm;
    }

    public function build()
    {
        return $this->view('template.form_fkp_submitted')
                    ->subject('Form FKP - ' . $this->fkpForm->subject)
                    ->attach(storage_path('app/temp/fkp_form_' . $this->fkpForm->id . '.pdf'));
    }
}