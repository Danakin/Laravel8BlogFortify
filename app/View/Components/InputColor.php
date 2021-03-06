<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputColor extends Component
{
    public $name;
    public $value;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "", $value = "", $type = "color")
    {
        //
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input-color');
    }
}
