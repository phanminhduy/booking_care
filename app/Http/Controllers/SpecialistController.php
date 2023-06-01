<?php

namespace App\Http\Controllers;

use App\Http\Requests\Specialist\StoreRequest;
use App\Http\Requests\Specialist\UpdateRequest;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function __construct()
    {
        $this->model = (new Specialist())->query();
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $specialists = $this->model
            ->where('name','like','%'.$search.'%')
            ->paginate();
        $specialists->appends(['q'=>$search]);
        return view('admin.specialist.index',[
            'specialists' => $specialists,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('admin.specialist.create');
    }

    public function store(StoreRequest $request)
    {
        $object = new Specialist();
        $object->fill($request->validated());
        $object->save();
        return redirect()->route('admin.specialist.index');
    }


    public function edit(Specialist $specialist)
    {
        return view('admin.specialist.edit', [
            'specialist'=>$specialist,
        ]);
    }

    public function update(UpdateRequest $request, Specialist $specialist)
    {
        $specialist->update(
            $request->validated()
        );
        return redirect()->route('admin.specialist.index');
    }

    public function destroy(Specialist $specialist)
    {
        $specialist->delete();
        return redirect()->route('admin.specialist.index');
    }
}
