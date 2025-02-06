<?php

namespace App\Livewire;

use Livewire\Component;

class OnboardSocialStep extends Component
{
    public $social_media;
    public $website;

    public function render()
    {
        return view('livewire.onboard-social-step');
    }
}