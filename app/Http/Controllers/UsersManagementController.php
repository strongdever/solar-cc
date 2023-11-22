<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class UsersManagementController extends Controller
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
        $paginationEnabled = config('usersmanagement.enablePagination');
        if ($paginationEnabled) {
            $users = User::paginate(config('usersmanagement.paginateListSize'));
        } else {
            $users = User::all();
        }
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
                'email'                         => 'required|email|max:255|unique:users',
                'password'                      => 'required|min:8|max:20|confirmed',
                'password_confirmation'         => 'required|same:password',
                'name'                          => 'required|max:255|unique:users',
                'name_kanji'                    => 'required|max:255',
                'name_frigana'                  => 'required|max:255',
                'role'                          => 'required',
                'company_kanji'                 => 'required|max:255',
                'company_frigana'               => 'required|max:255',
                'company_zipcode'               => 'required|postal_code:JP|max:255',
                'company_prefecture'            => 'required|max:255',
                'company_address'               => 'required|max:255',
            ],
            [
                'email.required'                => trans('auth.emailRequired'),
                'email.email'                   => trans('auth.emailInvalid'),
                'email.unique'                  => trans('auth.emailUnique'),
                'password.required'             => trans('auth.passwordRequired'),
                'password.min'                  => trans('auth.passwordMin'),
                'password.max'                  => trans('auth.passwordMax'),
                'password.confirmed'            => trans('auth.passwordConfirm'),
                'password_confirmation.required'    => trans('auth.passwordConfirmRequired'),
                'password_confirmation.same'    => trans('auth.passwordSame'),
                'name.unique'                   => trans('auth.userNameTaken'),
                'name.required'                 => trans('auth.userNameRequired'),
                'name_kanji.required'           => trans('auth.kNameRequired'),
                'name_frigana.required'         => trans('auth.fNameRequired'),
                'role.required'                 => trans('auth.roleRequired'),
                'company_kanji.required'        => trans('auth.kCompanyRequired'),
                'company_frigana.required'      => trans('auth.fCompanyRequired'),
                'company_zipcode.required'      => trans('auth.zipcodeRequired'),
                'company_zipcode.postal_code'   => trans('auth.zipcodeInvalid'),
                'company_prefecture.required'   => trans('auth.prefectureRequired'),
                'company_address.required'      => trans('auth.addressRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();

        $profile_input = $request->only('company_kanji', 'company_frigana', 'company_zipcode', 'company_prefecture', 'company_address', 'company_bio');

        $user = User::create([
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
            'name'             => strip_tags($request->input('name')),
            'name_kanji'       => strip_tags($request->input('name_kanji')),
            'name_frigana'     => strip_tags($request->input('name_frigana')),
            'token'            => substr(md5(rand(0, 9) . $request->input('email') . time()), 0, 32),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
        ]);

        $profile->fill($profile_input);
        $user->profile()->save($profile);

        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('usersmanagement.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
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
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $emailCheck = ($request->input('email') !== '') && ($request->input('email') !== $user->email);
        $ipAddress = new CaptureIpTrait();

        if ($emailCheck) {
            $validator = Validator::make(
                $request->all(),
                [
                    'email'                         => 'required|email|max:255|unique:users',
                    'name'                          => 'required|max:255|unique:users',
                    'name_kanji'                    => 'required|max:255',
                    'name_frigana'                  => 'required|max:255',
                    'role'                          => 'required',
                    'company_kanji'                 => 'required|max:255',
                    'company_frigana'               => 'required|max:255',
                    'company_zipcode'               => 'required|postal_code:JP|max:255',
                    'company_prefecture'            => 'required|max:255',
                    'company_address'               => 'required|max:255',
                    'password'                      => $request->input('password') !== null ? 'present|min:8|max:20|confirmed' : '',
                ],
                [
                    'email.required'                => trans('auth.emailRequired'),
                    'email.email'                   => trans('auth.emailInvalid'),
                    'email.unique'                  => trans('auth.emailUnique'),
                    'password.required'             => trans('auth.passwordRequired'),
                    'password.min'                  => trans('auth.passwordMin'),
                    'password.max'                  => trans('auth.passwordMax'),
                    'password.confirmed'            => trans('auth.passwordConfirm'),
                    'name.unique'                   => trans('auth.userNameTaken'),
                    'name.required'                 => trans('auth.userNameRequired'),
                    'name_kanji.required'           => trans('auth.kNameRequired'),
                    'name_frigana.required'         => trans('auth.fNameRequired'),
                    'role.required'                 => trans('auth.roleRequired'),
                    'company_kanji.required'        => trans('auth.kCompanyRequired'),
                    'company_frigana.required'      => trans('auth.fCompanyRequired'),
                    'company_zipcode.required'      => trans('auth.zipcodeRequired'),
                    'company_zipcode.postal_code'   => trans('auth.zipcodeInvalid'),
                    'company_prefecture.required'   => trans('auth.prefectureRequired'),
                    'company_address.required'      => trans('auth.addressRequired'),
                ]
            );
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'name'                          => 'required|max:255|unique:users,name,'.$user->id,
                    'name_kanji'                    => 'required|max:255',
                    'name_frigana'                  => 'required|max:255',
                    'role'                          => 'required',
                    'company_kanji'                 => 'required|max:255',
                    'company_frigana'               => 'required|max:255',
                    'company_zipcode'               => 'required|postal_code:JP|max:255',
                    'company_prefecture'            => 'required|max:255',
                    'company_address'               => 'required|max:255',
                    'password'                      => $request->input('password') !== null ? 'nullable|min:8|max:20|confirmed' : '',
                ],
                [
                    'email.required'                => trans('auth.emailRequired'),
                    'email.email'                   => trans('auth.emailInvalid'),
                    'email.unique'                  => trans('auth.emailUnique'),
                    'password.required'             => trans('auth.passwordRequired'),
                    'password.min'                  => trans('auth.passwordMin'),
                    'password.max'                  => trans('auth.passwordMax'),
                    'password.confirmed'            => trans('auth.passwordConfirm'),
                    'name.unique'                   => trans('auth.userNameTaken'),
                    'name.required'                 => trans('auth.userNameRequired'),
                    'name_kanji.required'           => trans('auth.kNameRequired'),
                    'name_frigana.required'         => trans('auth.fNameRequired'),
                    'role.required'                 => trans('auth.roleRequired'),
                    'company_kanji.required'        => trans('auth.kCompanyRequired'),
                    'company_frigana.required'      => trans('auth.fCompanyRequired'),
                    'company_zipcode.required'      => trans('auth.zipcodeRequired'),
                    'company_zipcode.postal_code'   => trans('auth.zipcodeInvalid'),
                    'company_prefecture.required'   => trans('auth.prefectureRequired'),
                    'company_address.required'      => trans('auth.addressRequired'),
                ]
            );
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $profile_input = $request->only('company_kanji', 'company_frigana', 'company_zipcode', 'company_prefecture', 'company_address', 'company_bio');

        if ($user->profile === null) {
            $profile = new Profile();
            $profile->fill($profile_input);
            $user->profile()->save($profile);
        } else {
            $user->profile->fill($profile_input)->save();
        }

        $user->name = strip_tags($request->input('name'));
        $user->name_kanji = strip_tags($request->input('name_kanji'));
        $user->name_frigana = strip_tags($request->input('name_frigana'));

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') !== null) {
            $user->password = Hash::make($request->input('password'));
        }

        $userRole = $request->input('role');
        if ($userRole !== null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->activated = 1;

        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();
        $ipAddress = new CaptureIpTrait();

        if ($user->id !== $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();
            $user->delete();

            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    /**
     * Method to search the users.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');
        $searchRules = [
            'user_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user_search_box.required' => 'Search term is required',
            'user_search_box.string'   => 'Search term has invalid characters',
            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
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
