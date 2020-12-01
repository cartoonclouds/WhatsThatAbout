<?php

namespace App\Http\Requests;

use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGenreRequest extends FormRequest
{

    protected $errorBag = 'genre';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->genre ?
            $this->user()->can('update', $this->genre) :
            $this->user()->can('create', Genre::class);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => [
                'required',
                'string',
                Rule::unique('genres', 'name')->ignore($this->genre),
            ],
            'definition' => '',
        ];
    }


    /**
     * Save the Genre.
     *
     * @param \App\Models\Genre $genre
     * @return \App\Models\Genre|false
     */
    public function persist(Genre $genre)
    {
        $genre->fill($this->validated());

        if ($genre->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $genre;
        }

        return false;
    }
}
