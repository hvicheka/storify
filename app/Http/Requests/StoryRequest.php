<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoryRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $storyId = $this->route('story.id');
        return [
            'title' => [
                'required',
                'min:10',
                'max:50',
                function($attributes,$value,$fail){
                    if($value == "Dummy Title"){
                        $fail($attributes . " is not valid");
                    }
                },
                
                Rule::unique('stories')->ignore($storyId)
            ],
            'body' => ['required','min:300'],
            'type' => 'required',
            'status' => 'required',
        ];
    }

    function withValidator($v){
        $v->sometimes('body','max:1000',function($input){
            return 'short' == $input->type;
        });
    }

    public function messages(){
        return [
            //'title.required' => 'Please Enter Title',
            'required' => 'Please enter :attribute',
            'type.required' => 'Please select type',
            'status.required' => 'Please select status'
        ];
    }
}
