<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInstitutionRequest;
use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Models\Institution;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutionsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = Institution::all();
        $inactiveInstitutions = Institution::onlyTrashed()->get();

        return view('admin.institutions.index', compact('institutions','inactiveInstitutions'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutions.create');
    }

    public function store(StoreInstitutionRequest $request)
    {
        $institution = Institution::create($request->all());

        if ($request->input('logo', false)) {
            $institution->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        return redirect()->route('admin.institutions.index');
    }

    public function edit(Institution $institution)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutions.edit', compact('institution'));
    }

    public function update(UpdateInstitutionRequest $request, Institution $institution)
    {
        $institution->update($request->all());

        if ($request->input('logo', false)) {
            if (!$institution->logo || $request->input('logo') !== $institution->logo->file_name) {
                $institution->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($institution->logo) {
            $institution->logo->delete();
        }

        return redirect()->route('admin.institutions.index');
    }

    public function show(Institution $institution)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutions.show', compact('institution'));
    }

    public function destroy(Institution $institution)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institution->delete();

        return back();
    }

    public function restore($id)
    {
        $institution = Institution::withTrashed()->find($id);


        if ($institution) {
            $institution->restore();
            return redirect()->route('admin.institutions.index')->with('success', 'Course restored successfully!');
        }
        return redirect()->route('admin.institutions.index')->with('error', 'Course not found!');
    }

    public function massDestroy(MassDestroyInstitutionRequest $request)
    {
        Institution::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
