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
        Poll::create([
            'title' => $this->title
        ])->options()->createMany(  // access options via relationship
            collect($this->options)  // turn it into collection
                ->map(fn($option) => ['name' => $option ])  // convert every option into array (array of arrays)
                ->all()
        );

        // foreach ($this->options as $optionName) {
        //     $poll->options()->create(['name' => $optionName]);
        // }

        $this->reset(['title', 'options']);
    }

}
