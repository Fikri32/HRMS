<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Yajra\Datatables\Datatables;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }
    public function indexData()
    {
        $data = Employee::select('*');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($data){
                $btn = '<a href="javascript:void(0)" data-id="'.$data->id.'" id="edit" class="edit btn btn-primary btn-sm mr-2">Edit</a>';
                $btn = $btn.'<a href="javascript:void(0)" data-id="'.$data->id.'" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function create()
    {
        $data = Department::all();
        return view('employee.form',compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $input['photo'] = time().'.'.$request->photo->getClientOriginalExtension();

        $request->photo->move(public_path('img'), $input['photo']);


        $data = Employee::create($input);

        return response()->json([
            'fail'=>true,
            'employee'=>$data,

        ],200);
        // dd($data);
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_method','_token');
        $employee = Employee::where('id',$id)->update($data);
        return response()->json([
            'fail' => true
        ],200);
    }

    public function delete($id)
    {
        $employee = Employee::destroy($id);
        return $employee;
    }
}
