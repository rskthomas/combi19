<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class OptionsBar extends Component
{
    public $item;
    public $tipo;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $item, string $tipo)
    {
        $this->item = $item;
        $this->tipo = $tipo;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.options-bar');
    }
}
