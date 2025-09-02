<?php
namespace App\Mail;

use App\Models\Curriculo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurriculoComprovanteMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Curriculo $curriculo) {}

    public function build()
    {
        return $this->subject('Comprovante de envio de currículo')
            ->view('emails.curriculo_comprovante');
    }
}