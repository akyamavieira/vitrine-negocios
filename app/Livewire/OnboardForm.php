<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\CepService;
use App\Services\CnpjService;
use App\Http\Requests\OnboardFormRequest;
use Exception;

class OnboardForm extends Component
{
    public $user_id;
    public $user_nickname;
    public $user_name;
    public $user_email;
    public $company_name;
    public $cnpj;
    public $size = '';
    public $industry;
    public $about;
    public $cep;
    public $street;
    public $number;
    public $complement;
    public $neighborhood;
    public $city;
    public $social_media;
    public $website;
    public $currentStep = 1;
    public $loading = false;
    public function mount()
    {
        $user = session('userDTO');

        if (!$user) {
            return redirect()->route('login'); // Redireciona para login se não houver sessão
        }

        $this->user_id = $user->id ?? null;
        $this->user_nickname = $user->nickname ?? '';
        $this->user_name = $user->name ?? '';
        $this->user_email = $user->email ?? '';
    }
    public function searchAddress()
    {
        $this->resetErrorBag('cep');
        $this->loading = true; // Inicia o loading

        $data = CepService::buscarEndereco($this->cep);

        if (!$data) {
            $this->addError('cep', 'CEP não encontrado ou inválido.');
        } else {
            $this->street = $data['logradouro'] ?? '';
            $this->neighborhood = $data['bairro'] ?? '';
            $this->city = $data['localidade'] ?? '';
        }

        $this->loading = false; // Finaliza o loading
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function completeOnboarding()
    {
        $this->validateStep();


        $user = User::updateOrCreate(
            ['id' => $this->user_id],
            [
                'nickname' => $this->user_nickname,
                'name' => $this->user_name,
                'email' => $this->user_email,
            ]
        );
        Empresa::create([
            'id' => Str::uuid(),
            'fk_user' => $user->id,
            'company_name' => $this->company_name,
            'cnpj' => $this->cnpj,
            'size' => $this->size,
            'industry' => $this->industry,
            'about' => $this->about,
            'cep' => $this->cep,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'social_media' => $this->social_media,
            'website' => $this->website,
        ]);

        return redirect()->route('index');
    }

    protected function validateStep()
    {
        $formRequest = new OnboardFormRequest();
        $rules = $formRequest->rules();
        $messages = $formRequest->messages();

        // Converte a string de regras do CNPJ em um array
        $cnpjRules = is_array($rules['cnpj']) ? $rules['cnpj'] : explode('|', $rules['cnpj']);

        // Adiciona a função de validação personalizada ao array de regras
        $cnpjRules[] = function ($attribute, $value, $fail) {
            try {
                CnpjService::consultarCnpj($value);
            } catch (Exception $e) {
                $fail($e->getMessage());
            }
        };

        $stepRules = [
            1 => [
                'company_name' => $rules['company_name'],
                'cnpj' => $cnpjRules, // Usa o array de regras corrigido
                'size' => $rules['size'],
                'industry' => $rules['industry'],
                'about' => $rules['about'],
            ],
            2 => [
                'cep' => $rules['cep'],
                'street' => $rules['street'],
                'number' => $rules['number'],
                'complement' => $rules['complement'],
                'neighborhood' => $rules['neighborhood'],
                'city' => $rules['city'],
            ],
            3 => [
                'social_media' => $rules['social_media'],
                'website' => $rules['website'],
            ],
        ];

        $this->validate($stepRules[$this->currentStep], $messages);
    }
    public function render()
    {
        return view('livewire.onboard-form');
    }
}