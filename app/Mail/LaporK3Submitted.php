<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LaporK3;

class LaporK3Submitted extends Mailable
{
    use Queueable, SerializesModels;

    public $laporK3;
    public $downloadLink;

    public function __construct(LaporK3 $laporK3, $downloadLink)
    {
        $this->laporK3 = $laporK3;
        $this->downloadLink = $downloadLink;
    }

    public function build()
    {
        return $this->subject('Konfirmasi Pengiriman Laporan K3')
                    ->view('template.lapor-k3-submitted')
                    ->with([
                        'laporK3' => $this->laporK3,
                        'downloadLink' => $this->downloadLink, 
                    ]);
    }
}
