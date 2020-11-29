<?php

namespace App\Http\Requests;

use App\Models\Theme;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreThemeRequest extends FormRequest
{

    protected $errorBag = 'theme';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->theme ?
            $this->user()->can('update', $this->theme) :
            $this->user()->can('create', Theme::class);
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
                Rule::unique('themes', 'name')->ignore($this->theme),
            ],
            'definition' => ''
        ];
    }


    /**
     * Save the Theme.
     *
     * @param \App\Models\Theme $theme
     * @return \App\Models\Theme|false
     */
    public function persist(Theme $theme)
    {
        $theme->fill($this->validated());

        if ($theme->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $theme;
        }

        return false;
    }
}
