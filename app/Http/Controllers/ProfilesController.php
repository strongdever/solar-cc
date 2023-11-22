<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserAccount;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserProfile;
use App\Models\Term;
use App\Models\Bank;
use App\Models\User;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Validator;

class ProfilesController extends Controller
{
    protected $idMultiKey = '618423'; //int
    protected $seperationKey = '****';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param $uuid
     * @return mixed
     */
    public function getUserByUuid($uuid)
    {
        return User::with('term')->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return Response
     */
    public function show($uuid)
    {
        try {
            $user = $this->getUserByUuid($uuid);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $data = [
            'user' => $user,
        ];

        return view('profiles.show')->with($data);
    }

    /**
     * /profiles/username/edit.
     *
     * @param $uuid
     * @return mixed
     */
    public function edit($uuid)
    {
        try {
            $user = $this->getUserByUuid($uuid);
        } catch (ModelNotFoundException $exception) {
            return view('pages.status')
                ->with('error', trans('profile.notYourProfile'))
                ->with('error_title', trans('profile.notYourProfileTitle'));
        }

        $data = [
            'user' => $user,

        ];

        return view('profiles.edit')->with($data);
    }

    /**
     * Update a user's profile.
     *
     * @param  \App\Http\Requests\UpdateUserProfile  $request
     * @param $uuid
     * @return mixed
     *
     * @throws Laracasts\Validation\FormValidationException
     */
    public function update(Request $request, $uuid)
    {
        $user = $this->getUserByUuid($uuid);
        
        $ipAddress = new CaptureIpTrait();
        
        if( $request->input('action') !== '' ) {
            $requestAction = $request->input('action');
            if( $requestAction === 'update' ) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'company' => 'required|max:255',
                        'zipcode' => 'required|postal_code:JP|max:255',
                        'address1' => 'required|max:255',
                        'phone' => 'required|min:10',
                        'email' => 'required|email|max:255|unique:users,email,'.$user->id,
                        'name' => 'required|max:255',
                    ],
                    [
                        'company.required' => trans('auth.CompanyRequired'),
                        'zipcode.required' => trans('auth.ZipcodeRequired'),
                        'zipcode.postal_code' => trans('auth.ZipcodeInvalid'),
                        'address1.required' => trans('auth.Address1Required'),
                        'phone.required' => trans('auth.PhoneRequired'),
                        'phone.min' => trans('auth.PhoneInvalid'),
                        'email.required' => trans('auth.emailRequired'),
                        'email.email' => trans('auth.emailInvalid'),
                        'email.unique' => trans('auth.emailUnique'),
                        'name.required' => trans('auth.NameRequired'),
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $user->company = $request->input('company');
                $user->zipcode = $request->input('zipcode');
                $user->address1 = $request->input('address1');
                $user->address2 = $request->input('address2');
                $user->phone = $request->input('phone');
                $user->email = $request->input('email');
                $user->name = $request->input('name');
                $user->updated_ip_address = $ipAddress->getClientIp();
                $user->activated = 1;
                $user->save();

                return back()->with('success', trans('profile.alert.updateSuccess'));

            } else if ( $requestAction === 'term' ) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'deadline' => 'required',
                    ],
                    [
                        'deadline.required' => trans('auth.DeadlineRequired'),
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $term_input = $request->only('deadline', 'comment');

                if ($user->term === null) {
                    $term = new Term();
                    $term->fill($term_input);
                    $user->term()->save($term);
                } else {
                    $user->term->fill($term_input)->save();
                }

                return back()->with('success', trans('profile.alert.updateSuccess'));

            } else if ( $requestAction === 'bank' ) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:255',
                        'branch' => 'required|max:255',
                        'kind' => 'required|max:255',
                        'number' => 'required|max:255',
                        'holder' => 'required|max:255',
                    ],
                    [
                        'name.required' => trans('auth.BankNameRequired'),
                        'branch.required' => trans('auth.BankBranchRequired'),
                        'kind.required' => trans('auth.BankKindRequired'),
                        'number.required' => trans('auth.BankNumberRequired'),
                        'holder.required' => trans('auth.BankHolderRequired'),
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $bank_input = $request->only('name', 'branch', 'kind', 'number', 'holder');

                if ($user->bank === null) {
                    $bank = new Bank();
                    $bank->fill($bank_input);
                    $user->bank()->save($bank);
                } else {
                    $user->bank->fill($bank_input)->save();
                }

                return back()->with('success', trans('profile.alert.updateSuccess'));

            } else if ( $requestAction === 'password' ) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'old_password' => ['required', new MatchOldPassword],
                        'password' => ['required', 'min:6', 'max:30'],
                        'password_confirmation' => ['required', 'same:password'],
                    ],
                    [
                        'old_password.required' => trans('auth.passwordRequired'),
                        'password.required' => trans('auth.newPasswordRequired'),
                        'password.min' => trans('auth.PasswordMin'),
                        'password.max' => trans('auth.PasswordMax'),
                        'password_confirmation.same' => trans('auth.passwordConfirm'),
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $user->password = Hash::make($request->input('password'));
                $user->save();

                return back()->with('success', trans('profile.alert.updateSuccess'));
            }

        }
        return back();
    }

    /**
     * Send GoodBye Email Function via Notify.
     *
     * @param  array  $user
     * @param  string  $token
     * @return void
     */
    public static function sendGoodbyEmail(User $user, $token)
    {
        $user->notify(new SendGoodbyeEmail($token));
    }

    /**
     * Get User Restore ID Multiplication Key.
     *
     * @return string
     */
    public function getIdMultiKey()
    {
        return $this->idMultiKey;
    }

    /**
     * Get User Restore Seperation Key.
     *
     * @return string
     */
    public function getSeperationKey()
    {
        return $this->seperationKey;
    }
}
