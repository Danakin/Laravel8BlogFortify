<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputCheckbox extends Component
{
    public $name;
    public $published;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "", $published = false)
    {
        //
        $this->name = $name;
        $this->published = $published;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input-checkbox');
    }
}
