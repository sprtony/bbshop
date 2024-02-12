<?php

namespace Quimaira\Catalog\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\{Http, Mail};

use Quimaira\Catalog\Models\Quote;
use Quimaira\Catalog\Mail\QuoteSended;


use App\Models\PostalCode;

class Cotizador extends Component
{
    public $captcha = 0;
    public $product_name = '';

    public array $quote = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'solution' => '',
        'postal_code' => '',
        'state' => '',
        'city' => '',
        'message' => '',
    ];

    protected $rules = [
        'quote.name' => 'required',
        'quote.email' => 'required|email',
        'quote.phone' => 'required|digits:10',
        'quote.solution' => 'required',
        'quote.postal_code' => 'required|digits:5',
    ];

    protected $validationAttributes = [
        'quote.name' => 'Nombre completo',
        'quote.email' => 'Correo eléctronico',
        'quote.phone' => 'Teléfono',
        'quote.solution' => 'Solución que le interesa',
        'quote.postal_code' => 'Código postal',
        'quote.message' => 'Comentarios',
    ];


    public function mount($product_name)
    {
        $this->product_name = $product_name;
        $this->quote['solution'] = $product_name;
    }

    public function render()
    {
        return view('catalog::livewire.cotizador');
    }

    public function updatedQuotePostalCode($value)
    {
        $this->validateOnly('quote.postal_code');
        $code = PostalCode::where('postal_code', $value)->first();

        if (is_null($code)) {
            return $this->addError('quote.postal_code', 'El codigo postal es invalido');
        }

        $this->quote['state'] = $code->state;
        $this->quote['city'] = $code->city;
    }

    public function store()
    {
        $this->validate();
        $quote = Quote::create($this->quote);

        Mail::send(new QuoteSended($quote));

        $this->reset('quote');
        $this->quote['solution'] = $this->product_name;

        $this->dispatch('swal', title: 'Cotización enviada', message: 'Nos pondremos en contacto contigo pronto', type: 'success');
    }

    public function updatedCaptcha($token)
    {
        //si no hay captcha
        if (!setting('general.captcha_private') && !setting('general.captcha_public')) {
            $this->store();
            return;
        }

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . setting('general.captcha_private') . '&response=' . $token);
        $this->captcha = $response->json()['score'];
        if ($this->captcha > 0.3) {
            $this->store();
        } else {
            $this->dispatch('swal', title: 'Error', message: 'Score: ' . $this->captcha, type: 'error');
        }
    }
}
