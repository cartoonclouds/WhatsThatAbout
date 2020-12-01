<?php

namespace App\Http\Requests;

use App\Models\Scene;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSceneRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->scene ?
            $this->user()->can('update', $this->scene) :
            $this->user()->can('create', Scene::class);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'           => [
                'required',
                'string',
                Rule::unique('scenes', 'title')->ignore($this->scene),
            ],
            'start_time'      => 'required',
            'finish_time'     => 'required',
            'runs_throughout' => 'required|in:' . true . ',' . false,
            'details'         => 'required',
            'page_id'         => 'required|exists:pages,id',
            'genre_id'        => 'required|exists:genres,id',
            'theme_id'        => 'required|exists:themes,id',
        ];
    }


    /**
     * Save the Scene.
     *
     * @param  \App\Models\Scene $scene
     * @return \App\Models\Scene|false
     */
    public function persist(Scene $scene)
    {
        if (!$scene->exists) {
            // If the post doesn't exist, we'll assign the
            // post as created by the current user.
            $scene->user_id = $this->user()->id;
        }

        $scene->fill($this->validated());

        if ($scene->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $scene;
        }

        return false;
    }
}
