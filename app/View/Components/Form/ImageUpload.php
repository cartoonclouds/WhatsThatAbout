<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public string $name;
    public string $source;
    public string $label;
    public string $helpText;

    /**
     * @var \Illuminate\Contracts\Support\MessageBag|null
     */
    public ?MessageBag $fieldErrors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $source, string $label, string $helpText, MessageBag $fieldErrors = null)
    {
        $this->name = $name;
        $this->source = $source;
        $this->label = $label;
        $this->helpText = $helpText;

        $this->fieldErrors = $fieldErrors ?? new \Illuminate\Support\MessageBag;
    }

    public function isInvalid()
    {
        return $this->fieldErrors->has($this->name);
    }

    public function classList()
    {
        return implode(' ', array_filter([
            'form-control',
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
        return view('components.form.image-upload');
    }
}
