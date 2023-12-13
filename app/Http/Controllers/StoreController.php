<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Term;
use App\Models\Bank;
use App\Models\User;
use Auth;
use App\Traits\CaptureIpTrait;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class StoreController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
        
        $roles = Role::all();

        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('usersmanagement.create-user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'uuid' => 'required|max:255|unique:users',
                'company' => 'required|max:255',
                'zipcode' => 'required|postal_code:JP|max:255',
                'address1' => 'required|max:255',
                'phone' => 'required|min:10',
                'email' => 'required|email|max:255|unique:users',
                'name' => 'required|max:255',
                'role' => 'required',
                'bank_name' => 'required|max:255',
                'bank_branch' => 'required|max:255',
                'bank_kind' => 'required|max:255',
                'bank_number' => 'required|max:255',
                'bank_holder' => 'required|max:255',
                'deadline' => 'required',
                'password' => 'required|min:6|max:30',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'uuid.required' => trans('auth.userNameRequired'),
                'uuid.unique' => trans('auth.userNameTaken'),
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
                'role.required' => trans('auth.roleRequired'),
                'bank_name.required' => trans('auth.BankNameRequired'),
                'bank_branch.required' => trans('auth.BankBranchRequired'),
                'bank_kind.required' => trans('auth.BankKindRequired'),
                'bank_number.required' => trans('auth.BankNumberRequired'),
                'bank_holder.required' => trans('auth.BankHolderRequired'),
                'deadline.required' => trans('auth.DeadlineRequired'),
                'password.required' => trans('auth.passwordRequired'),
                'password.min' => trans('auth.PasswordMin'),
                'password.max' => trans('auth.PasswordMax'),
                'password_confirmation.required' => trans('auth.passwordConfirmRequired'),
                'password_confirmation.same' => trans('auth.passwordConfirm'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $term = new Term();

        $term_input = $request->only('deadline', 'comment');

        $bank = new Bank();

        $bank_input = [
            'name' => $request->input('bank_name'),
            'branch' => $request->input('bank_branch'),
            'kind' => $request->input('bank_kind'),
            'number' => $request->input('bank_number'),
            'holder' => $request->input('bank_holder'),
        ];

        $user = User::create([
            'uuid' => $request->input('uuid'),
            'company' => $request->input('company'),
            'zipcode' => $request->input('zipcode'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'token' => substr(md5(rand(0, 9) . $request->input('email') . time()), 0, 32),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated' => 1,
        ]);

        $term->fill($term_input);
        $user->term()->save($term);

        $bank->fill($bank_input);
        $user->bank()->save($bank);

        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('stores')->with('success', trans('usersmanagement.alerts.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('usersmanagement.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        foreach ($user->roles as $userRole) {
            $currentRole = $userRole;
        }

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
        ];

        return view('usersmanagement.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $ipAddress = new CaptureIpTrait();
        
        if( $request->input('action') !== '' ) {
            $requestAction = $request->input('action');
            if( $requestAction === 'update' ) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'uuid' => 'required|max:255|unique:users,uuid,'.$user->id,
                        'company' => 'required|max:255',
                        'zipcode' => 'required|postal_code:JP|max:255',
                        'address1' => 'required|max:255',
                        'phone' => 'required|min:10',
                        'email' => 'required|email|max:255|unique:users,email,'.$user->id,
                        'name' => 'required|max:255',
                    ],
                    [
                        'uuid.required' => trans('auth.userNameRequired'),
                        'uuid.unique' => trans('auth.userNameTaken'),
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

                $user->uuid = $request->input('uuid');
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
                        'bank_name' => 'required|max:255',
                        'bank_branch' => 'required|max:255',
                        'bank_kind' => 'required|max:255',
                        'bank_number' => 'required|max:255',
                        'bank_holder' => 'required|max:255',
                    ],
                    [
                        'bank_name.required' => trans('auth.BankNameRequired'),
                        'bank_branch.required' => trans('auth.BankBranchRequired'),
                        'bank_kind.required' => trans('auth.BankKindRequired'),
                        'bank_number.required' => trans('auth.BankNumberRequired'),
                        'bank_holder.required' => trans('auth.BankHolderRequired'),
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $bank_input = [
                    'name' => $request->input('bank_name'),
                    'branch' => $request->input('bank_branch'),
                    'kind' => $request->input('bank_kind'),
                    'number' => $request->input('bank_number'),
                    'holder' => $request->input('bank_holder'),
                ];

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
                        'password' => ['required', 'min:6', 'max:30'],
                        'password_confirmation' => ['required', 'same:password'],
                    ],
                    [
                        'password.required' => trans('auth.newPasswordRequired'),
                        'password.min' => trans('auth.PasswordMin'),
                        'password.max' => trans('auth.PasswordMax'),
                        'password_confirmation.required' => trans('auth.passwordConfirmRequired'),
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();
        $ipAddress = new CaptureIpTrait();

        if ($user->id !== $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();
            $user->forceDelete();

            return redirect('stores')->with('success', trans('usersmanagement.alerts.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.alerts.deleteSelfError'));
    }

    /**
     * Method to search the users.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('user-search');
        $searchRules = [
            'user-search' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user-search.required' => '検索キーワードを入力してください。',
            'user-search.string'   => '検索キーワードに無効な文字が含まれています。',
            'user-search.max'      => '検索キーワードの文字数が多すぎます。255文字まで許可されています。',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
                            ->orWhere('company', 'like', $searchTerm.'%')
                            ->orWhere('address', 'like', $searchTerm.'%')
                            ->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
