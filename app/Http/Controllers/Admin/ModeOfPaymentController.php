<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInstitutionRequest;
use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Models\Institution;
use App\Models\ModeOfPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModeOfPaymentController extends Controller
{

    public function index()
    {
        //abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = ModeOfPayment::all();

        return view('admin.mode_of_payment.index', compact('institutions'));
    }

    public function create()
    {
        //abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mode_of_payment.create');
    }

    public function store(Request $request)
    {
        $institution = ModeOfPayment::create($request->all());

        return redirect()->route('admin.mode-of-payment.index')->with('success', 'Payment Details created successfully.');
    }

    public function edit(ModeOfPayment $modeOfPayment)
    {


        //abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mode_of_payment.edit', compact('modeOfPayment'));
    }

    public function update(Request $request, ModeOfPayment $modeOfPayment)
    {
        $modeOfPayment->update($request->all());


        return redirect()->route('admin.mode-of-payment.index')->with('success', 'Payment Details updated successfully.');
    }

    public function show(Institution $institution)
    {
        //abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mode_of_payment.show', compact('institution'));
    }

    public function destroy(ModeOfPayment $modeOfPayment)
    {

        //abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modeOfPayment->delete();

        return back();
    }

}
