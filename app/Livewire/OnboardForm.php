<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\User;


class OnboardForm extends Component
{
    public $user_id;
    public $user_nickname;
    public $user_name;
    public $user_email;
    public $company_name;
    public $cnpj;
    public $size;
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

    public function mount()
    {
        $user = session('userDTO');
        $this->user_id = $user->id;
        $this->user_nickname = $user->nickname;
        $this->user_name = $user->name;
        $this->user_email = $user->email;
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
        $rules = [
            1 => [
                'company_name' => 'required|string|max:255',
                'cnpj' => 'required|string|max:18',
                'size' => 'required|string|max:255',
                'industry' => 'required|string|max:255',
                'about' => 'required|string|max:1000',
            ],
            2 => [
                'cep' => 'required|string|max:9',
                'street' => 'required|string|max:255',
                'number' => 'required|string|max:10',
                'complement' => 'nullable|string|max:255',
                'neighborhood' => 'required|string|max:255',
                'city' => 'required|string|max:255',
            ],
            3 => [
                'social_media' => 'nullable|string|max:255',
                'website' => 'nullable|url|max:255',
            ],
        ];

        $this->validate($rules[$this->currentStep]);
    }

    public function render()
    {
        return view('livewire.onboard-form');
    }
}