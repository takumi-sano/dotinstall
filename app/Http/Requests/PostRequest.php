<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // ユーザ管理をして機能を制限するメソッド。使用しない場合はreturn trueとする。
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // バリデーションのルールを定義。
    public function rules()
    {
        // バリデーションのルールを配列で返す。
        return [
            'title' => 'required|min:3',
            'body' => 'required',
        ];
    }

    // エラーメッセージを変更。
    public function messages()
    {
        // エラーメッセージを配列で返す。
        return [
            'title.required' => 'タイトルは必須です。',
            'title.min' => ':min 文字以上入力してください。',
            //設定した数値は:minで取得できる。
            'body.required' => '本文は必須です。',
        ];
    }
}
