<?php

namespace App\Http\Requests;

use App\Models\Segment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSegmentRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->segment ?
            $this->user()->can('update', $this->segment) :
            $this->user()->can('create', Segment::class);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('segments', 'title')->ignore($this->segment),
            ],
            'start_time' => 'required',
            'finish_time' => 'required',
            'runs_throughout' => 'in:1',
            'details' => 'required|string',
            'page_id' => 'required|exists:pages,id',
            'genre_id' => 'required|exists:genres,id',
            'theme_id' => 'required|exists:themes,id',
        ];
    }


    /**
     * Save the Segment.
     *
     * @param \App\Models\Segment $segment
     * @return \App\Models\Segment|false
     */
    public function persist(Segment $segment)
    {
        if (!$segment->exists) {
            // If the post doesn't exist, we'll assign the
            // post as created by the current user.
            $segment->user_id = $this->user()->id;
        }

        $segment->fill($this->validated());

        if ($segment->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $segment;
        }

        return false;
    }

}
