<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Profile;
use App\Models\Term;
use App\Models\User;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use ActivationTrait;
    use CaptchaTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data, 
            [
                'uuid' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:6', 'max:30'],
                'password_confirmation' => ['required', 'same:password'],
            ],
            [
                'uuid.required' => trans('auth.userNameRequired'),
                'uuid.unique' => trans('auth.userNameTaken'),
                'email.required' => trans('auth.emailRequired'),
                'email.email' => trans('auth.emailInvalid'),
                'email.unique' => trans('auth.emailUnique'),
                'password.required' => trans('auth.passwordRequired'),
                'password.min' => trans('auth.PasswordMin'),
                'password.max' => trans('auth.PasswordMax'),
                'password_confirmation.same' => trans('auth.passwordConfirm'),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $ipAddress = new CaptureIpTrait();

        $role = Role::where('slug', '=', 'user')->first();
        $activated = true;

        $user = User::create([
            'uuid'              => $data['uuid'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'token'             => substr(md5(rand(0, 9) . $data['email'] . time()), 0, 32),
            'signup_ip_address' => $ipAddress->getClientIp(),
            'activated'         => $activated,
        ]);

        $user->attachRole($role);

        $term = new Term();
        $user->term()->save($term);
        $user->save();

        return $user;
    }
}
