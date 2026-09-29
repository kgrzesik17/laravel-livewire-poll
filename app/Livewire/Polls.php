<?php

namespace App\Livewire;

use App\Models\Option;
use Livewire\Component;

class Polls extends Component
{
    protected $listeners = [
        // re-render if a new poll is created
        'pollCreated' => 'render'
    ];

    public function render()
    {
        // fetch all the polls with all their options
        $polls = \App\Models\Poll::with('options.votes')->latest()->get();

        return view('livewire.polls', ['polls' => $polls]);
    }

    public function vote(Option $option) {
        $option->votes()->create();
    }
}
