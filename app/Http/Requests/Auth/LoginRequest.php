<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Role;
use App\Models\Operator;
    
class LoginRequest extends FormRequest
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
            'username' => 'required|string',
            'password' => 'required|string',
            // 'role' => 'required|string',
            // 'blocked' => 'required|boolean'
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('username', 'password');

        $user = User::select('id','blocked_at')->where('username', $credentials['username'])->first();
        
        if($user){

            $roles = Role::where('user_id',$user->id)->get()->pluck('item_name')->toArray();

            if(!is_null($user->blocked_at) || !in_array('conseiller', $roles)) {
                throw ValidationException::withMessages([
                    'email' => __('auth.blockedmsg'),
                ]);
            }else{
                if (! Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], true)) {
                    RateLimiter::hit($this->throttleKey());

                    throw ValidationException::withMessages([
                        'email' => __('auth.failed'),
                    ]);
                }

                RateLimiter::clear($this->throttleKey());
            }
        }else{
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
        
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }

    protected function getCredentials(Request $request)
    {
        return $request->only('username', 'password_hash');
    }

   
}
