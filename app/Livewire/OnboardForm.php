<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class OnboardForm extends Component
{
    public $user;
    public $company_name;
    public $cnpj;
    public $size;
    public $industry;
    public $about;


    public function boot()
    {
        $this->user = session('userDTO');

    }

    public function completeOnboarding()
    {
        // Combine os dados do formulário com os dados do usuário
        $userData = [
            'id' => $this->user['id'],
            'nickname' => $this->user['nickname'],
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'company_name' => $this->company_name,
            'cnpj' => $this->cnpj,
            'size' => $this->size,
            'industry' => $this->industry,
            'about' => $this->about,
        ];
        return redirect()->route('index');
    }

    public function render()
    {
        return view('livewire.onboard-form', ['user' => $this->user]);
    }
}