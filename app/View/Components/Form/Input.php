<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $value;
    public string $placeholder;
    public string $label;
    public string $helpText;
    public string $errorBag;

    /**
     * @var \Illuminate\Contracts\Support\MessageBag|null
     */
    public ?MessageBag $fieldErrors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $value, string $label, string $helpText = '', string $placeholder = '', string $errorBag = '', MessageBag $fieldErrors = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->label = $label;
        $this->helpText = $helpText;
        $this->errorBag = $errorBag;

        $this->fieldErrors = $fieldErrors ?? new \Illuminate\Support\MessageBag;
    }

    public function uuid()
    {
        return spl_object_id($this);
    }

    public function isInvalid()
    {
        return $this->fieldErrors->has($this->name);
    }

    public function classList()
    {
        return implode(' ', array_filter([
            'form-control form-control-lg',
            ($this->isInvalid() ? 'is-invalid' : false),
        ]));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
