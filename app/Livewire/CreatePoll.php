<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePoll extends Component
{
    public $title; // public properties are visible in the render() regardless of passed arguments

    public function render()
    {
        return view('livewire.create-poll');
    }
}
