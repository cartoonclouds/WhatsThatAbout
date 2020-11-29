<?php

namespace App\Http\Requests;

use App\Models\Format;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFormatRequest extends FormRequest
{

    protected $errorBag = 'format';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->format ?
            $this->user()->can('update', $this->format) :
            $this->user()->can('create', Format::class);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('formats', 'name')->ignore($this->format),
            ],
            'definition' => ''
        ];
    }


    /**
     * Save the Format.
     *
     * @param \App\Models\Format $format
     * @return \App\Models\Format|false
     */
    public function persist(Format $format)
    {
        $format->fill($this->validated());

        if ($format->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $format;
        }

        return false;
    }
}
