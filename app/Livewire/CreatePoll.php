<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title; // public properties are visible in the render() regardless of passed arguments
    public $options = ['First'];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption() {
        $this->options[] = '';
    }

    public function removeOption($index) {
        unset($this->options[$index]);  // remove item of $index from the array
        $this->options = array_values($this->options);  // recreate array indexes
    }

    public function createPoll() {
        $poll = Poll::create([
            'title' => $this->title
        ]);

        foreach ($this->options as $optionName) {
            $poll->options()->create(['name' => $optionName]);
        }

        $this->reset(['title', 'options']);
    }

}
