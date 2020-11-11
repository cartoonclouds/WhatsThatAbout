<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePageRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->page ?
            $this->user()->can('update', $this->page) :
            $this->user()->can('create', Page::class);
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
                Rule::unique('pages', 'title')->ignore($this->page),
            ],
            'synopsis' => 'required|string',
            'release_year' => 'required',
            'runtime' => 'required',
            'references' => '',
        ];
    }


    /**
     * Save the Page.
     *
     * @param \App\Models\Page $page
     * @return \App\Models\Page|false
     */
    public function persist(Page $page)
    {
        if (!$page->exists) {
            // If the post doesn't exist, we'll assign the
            // post as created by the current user.
            $page->user_id = $this->user()->id;
        }

        $page->fill($this->validated());

        //@todo Handle file uploads

        if ($page->save()) {
            // Perform other tasks, maybe fire an event, dispatch a job.
            return $page;
        }

        return false;
    }

}
