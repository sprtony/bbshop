<?php

namespace App\Livewire;

use App\Mail\ContactMessageSended;
use App\Models\ContactMessage;
use App\Models\PostalCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FormContact extends Component
{
    public $captcha = 0;

    public array $contactMessage = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'whatsapp' => '',
        'street' => '',
        'postal_code' => '',
        'department' => '',
        'city' => '',
        'state' => '',
        'message' => '',
    ];

    protected $rules = [
        'contactMessage.name' => 'required',
        'contactMessage.email' => 'required|email',
        'contactMessage.phone' => 'required|digits:10',
        'contactMessage.whatsapp' => 'required|digits:10',
        'contactMessage.street' => 'required',
        'contactMessage.postal_code' => 'required',
        'contactMessage.message' => 'required',
    ];

    protected $validationAttributes = [
        'contactMessage.name' => 'Nombre Completo',
        'contactMessage.email' => 'Correo eléctronico',
        'contactMessage.phone' => 'Teléfono',
        'contactMessage.whatsapp' => 'Whatsapp',
        'contactMessage.street' => 'Dirección',
        'contactMessage.postal_code' => 'Código postal',
        'contactMessage.message' => 'Comentarios y/o sugerencias',
    ];

    public function updatedContactMessagePostalCode($value)
    {
        $this->validateOnly('contactMessage.postal_code');
        $code = PostalCode::where('postal_code', $value)->first();

        if (is_null($code)) {
            return $this->addError('contactMessage.postal_code', 'El codigo postal es invalido');
        }

        $this->contactMessage['state'] = $code->state;
        $this->contactMessage['city'] = $code->city;
    }

    public function store()
    {
        $this->validate();
        $contactMessage = ContactMessage::create($this->contactMessage);

        Mail::send(new ContactMessageSended($contactMessage));

        $this->reset('contactMessage');

        $this->dispatch('swal', title: 'Mensaje enviado', message: 'Nos pondremos en contacto contigo pronto', type: 'success');
    }

    public function updatedCaptcha($token)
    {
        //si no hay captcha
        if (! setting('general.captcha_private') && ! setting('general.captcha_public')) {
            $this->store();

            return;
        }

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret='.setting('general.captcha_private').'&response='.$token);
        $this->captcha = $response->json()['score'];
        if ($this->captcha > 0.3) {
            $this->store();
        } else {
            $this->dispatch('swal', title: 'Error', message: 'Score: '.$this->captcha, type: 'error');
        }
    }
}
