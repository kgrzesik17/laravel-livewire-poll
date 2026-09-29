<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title; // public properties are visible in the render() regardless of passed arguments
    public $options = ['First'];

    // validation
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255' // for every item inside the array
    ];

    // create custom error messages
    protected $messages = [
        'options.*' => "The option can't be empty"
    ];

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

    // dynamic validation (event handler)
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function createPoll() {
        $this->validate();  // if it fails, nothing after is ran

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

        $this->dispatch('pollCreated');  // fire an event (globally)
    }

}
