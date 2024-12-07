<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */
    
    private $label,$type,$id;

    public function __construct($label = null, $type = 'text', $id = null)
    {
        $this->label = $label;
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input', [
            'label' => $this->label,
            'type' => $this->type,
            'id' => $this->id
        ]);
    }
}
