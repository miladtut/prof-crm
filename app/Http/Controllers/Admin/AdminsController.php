<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataTable = new AdminDataTable($request->all());
        return $dataTable->render('pages.admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Admin::create($validated);
            flash('success')->success();
        } catch (\Exception $exception) {
            flash('error')->error();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('pages.admin.admins.edit', ['data' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $validated = $request->validated();
        try {
            $admin->update($validated);
            flash('admin Updated Successfully')->success();
        } catch (\Exception $exception) {
            flash('Error')->error();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Admin $admin)
    {
        try {
            if (Admin::where('super_admin', 1)->count() > 1) {
                $admin->delete();
                flash('admin Deleted Successfully')->success();
            } else {
                flash('You can not delete last super admin')->error();
            }
        } catch (\Exception $exception) {
            flash('Error')->error();
        }
        return back();
    }

}
