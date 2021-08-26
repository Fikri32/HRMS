<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Yajra\Datatables\Datatables;

class DepartmentControllers extends Controller
{
    public function index()
    {
        return view('departments.index');
    }
    public function indexData()
    {
        $data = Department::select(['id','name','created_at','updated_at']);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){

                    $btn = '<a href="javascript:void(0)" data-id="'.$data->id.'" id="edit" class="edit btn btn-primary btn-sm mr-2">Edit</a>';
                    $btn = $btn.'<a href="javascript:void(0)" data-id="'.$data->id.'" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create()
    {
        return view('departments.form');
    }
    public function store(Request $request)
    {
        $dept = Department::create($request->all());
        return response()->json([
            'fail'=>true,
        ],200);
    }

    public function edit($id)
    {
        $dept = Department::find($id);
        // dd($dept);
        return $dept;
    }

    public function update($id,Request $request)
    {
        $data = $request->except('_method','_token');
        $dept = Department::where('id',$id)->update($data);
        return response()->json([
            'fail'=>true,
        ],200);
    }

    public function delete($id)
    {
        $delete = Department::destroy($id);
        return $delete;
    }
}
