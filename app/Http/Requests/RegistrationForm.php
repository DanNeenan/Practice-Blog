<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\Welcome;
use Illuminat\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationForm extends FormRequest
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
        return [
        'name' => 'required',
        'username' => 'required|min:6|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
    ];
    }

    public function persist ()
    {
       //create and save the user
     $user = User::create([
        // $this->only(['name', 'email', 'password'])

        'name' => $this->get('name'),
        'username' => $this->get('username'),
        'email' => $this->get('email'),
        'password' => bcrypt($this->get('password'))
    ]);
       //sign them in
     auth()->login($user);
      //  send a welcome email
     \Mail::to($user)->send(new Welcome($user));
    }
}
