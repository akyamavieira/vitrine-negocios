<?php

namespace App\Livewire;

use Livewire\Component;

class OnboardAddressStep extends Component
{
    public $cep;
    public $street;
    public $number;
    public $complement;
    public $neighborhood;
    public $city;

    public function render()
    {
        return view('livewire.onboard-address-step');
    }
}