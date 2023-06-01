<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->model = (new Admin())->query();
        $arrRole = UserRoleEnum::getRole();
        View::share('roles', $arrRole);
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $employee = $this->model
            ->where('name', 'like', '%'.$search."%")
            ->orwhere('phone', 'like', '%'.$search."%")
            ->orwhere('email', 'like', '%'.$search."%")
            ->paginate();
        $employee->appends(['q' => $search]);
        return view('admin.employee.index', [
            'employees' => $employee,
            'search' => $search,
        ]);
    }
    public function create()
    {

        return view('admin.employee.create', [
//            'roles' => $role
        ]);
    }

    public function store(StoreRequest $request)
    {
        $path = '';
        if ($request->file('avatar')) {
            $path = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
        }
        $object = new Admin();
        $object->fill($request->validated());
        $object['avatar'] = $path;
        $object['password'] = Hash::make($request->password);
        $object->save();
        return redirect()->route('admin.employee.index');
    }


    public function edit($employee)
    {
        $employee=Admin::find($employee);
        return view('admin.employee.edit', [
            'employee' => $employee,
        ]);
    }

    public function update(UpdateRequest $request, $admin)
    {
        $object = Admin::query()->find($admin);
        $object->fill($request->validated());
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
            $object['avatar'] = $path;
        }
        $object['password'] = Hash::make($request->password);
        $object->save();
        return redirect()->route('admin.employee.index')->with('success', 'Sửa thành công');
    }

    public function destroy(Admin $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employee.index');
    }

    public function resetPassword(Admin $employee)
    {
        $employee['password'] = Hash::make(123456);
        $employee->save();
    }

    public function editPassword()
    {
        return view('admin.employee.changePassword');
    }

    public function changePassword(Request $request, $employee)
    {
        if(!Hash::check($request->old_password, auth()->user()->password)){
                return redirect()->route('admin.employee.editPassword')->with("error", "Mật khẩu cũ không đúng!");
        }

        #Update the new Password
        Admin::find(auth()->guard('admin')->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('admin.employee.editPassword')->with("success", "Đổi mật khẩu thành công!");
    }
}
