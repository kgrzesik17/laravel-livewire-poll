<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePoll extends Component
{
    public $title; // public properties are visible in the render() regardless of passed arguments
    public $options = ['init'];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption() {
        $this->options[] = '';
    }
}
