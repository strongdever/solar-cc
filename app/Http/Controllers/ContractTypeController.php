<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContractType;
use Auth;
use Validator;
use View;

class ContractTypeController extends Controller
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
        $contract_types = ContractType::paginate(20);

        return view('contract_types.index', compact('contract_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contract_types.create');
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
                'name'                          => 'required|max:255|unique:contract_types',
            ],
            [
                'name.required'                 => trans('contract_type.messages.nameRequired'),
                'name.unique'                   => trans('contract_type.messages.nameUnique'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $contract_type = new ContractType();
        $contract_type->name = $request->input('name');
        $contract_type->comment = $request->input('comment');
        $contract_type->save();

        return redirect('contract_types')->with('success', trans('contract_type.alerts.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract_type = ContractType::findOrFail($id);

        return view('contract_types.show', compact('contract_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract_type = ContractType::findOrFail($id);

        return view('contract_types.edit', compact('contract_type'));
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
        $validator = Validator::make(
            $request->all(),
            [
                'name'                          => 'required|max:255|unique:contract_types,name,' . $id,
            ],
            [
                'name.required'                 => trans('category.messages.nameRequired'),
                'name.unique'                   => trans('category.messages.nameUnique'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $contract_type = ContractType::findOrFail($id);
        $contract_type->name = $request->input('name');
        $contract_type->comment = $request->input('comment');
        $contract_type->save();

        return back()->with('success', trans('contract_type.alerts.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract_type = ContractType::findOrFail($id);
        $contract_type->delete();

        return redirect('contract_types')->with('success', trans('contract_type.alerts.deleteSuccess'));
    }
}
