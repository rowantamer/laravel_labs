<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            'title' => ['required','min:3','unique:posts,title,'.$this->post],
            'description' => ['required','min:10'],
            'post_creator' => ['required', 'exists:users,id'],
            'image' => ['image','mimes:jpg,png','max:2048']
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'title.unique' => 'Title must be unique',
            'description.required' => 'Description is required',
            'description.min' => 'Description must be at least 10 characters',
            'post_creator.required' => 'Post Creator is required',
        ];
    }
}
