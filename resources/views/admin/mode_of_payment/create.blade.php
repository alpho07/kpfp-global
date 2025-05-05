@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add Payment details
    </div>

    <div class="card-body">
        <form action="{{ route("admin.mode-of-payment.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            
             <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="name">Payment Required*</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Yes">Yes</option>
                     <option value="No">No</option>
                </select>
                @if($errors->has('status'))
                    <em class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.name_helper') }}
                </p>
            </div>
            
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Mobile Provider*</label>
                <select name="mobile_name" id="mobile_name" class="form-control" required>
                    <option value="MPESA">MPESA</option>
                </select>
                @if($errors->has('mobile_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('mobile_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.name_helper') }}
                </p>
            </div>

            
            <div class="form-group {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
                <label for="mobile_number">Number/Paybill Account*</label>
                <input type="number" id="mobile_paybill_no" name="mobile_paybill_no" required class="form-control " value="{{ old('mobile_paybill_no', isset($institution) ? $institution->mobile_paybill_no : '') }}">
                @if($errors->has('mobile_paybill_no'))
                    <em class="invalid-feedback">
                        {{ $errors->first('mobile_paybill_no') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.description_helper') }}
                </p>
            </div>


            <div class="form-group {{ $errors->has('bank_name') ? 'has-error' : '' }}">
                <label for="bank_name">Bank name*</label>
                <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{ old('bank_name', isset($institution) ? $institution->bank_name : '') }}">
                @if($errors->has('bank_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('bank_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.description_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('bank_branch') ? 'has-error' : '' }}">
                <label for="bank_branch">Bank Branch</label>
                <input type="text" id="bank_branch" name="bank_branch" class="form-control" value="{{ old('bank_branch', isset($institution) ? $institution->bank_branch : '') }}">
                @if($errors->has('bank_branch'))
                    <em class="invalid-feedback">
                        {{ $errors->first('bank_branch') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.description_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('account_name') ? 'has-error' : '' }}">
                <label for="account_name">Account Name*</label>
                <input type="text" id="account_name" name="account_name" class="form-control" value="{{ old('account_name', isset($institution) ? $institution->account_name : '') }}">
                @if($errors->has('account_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('account_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.description_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('account_number') ? 'has-error' : '' }}">
                <label for="account_number">Account Number*</label>
                <input type="text" id="account_number" name="account_number" class="form-control " value="{{ old('account_number', isset($institution) ? $institution->account_number : '') }}">
                @if($errors->has('account_number'))
                    <em class="invalid-feedback">
                        {{ $errors->first('account_number') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.description_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                <label for="amount">Amount*</label>
                <input type="number" id="amount" name="amount" required class="form-control " value="{{ old('amount', isset($institution) ? $institution->amount : '') }}">
                @if($errors->has('amount'))
                    <em class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.institution.fields.description_helper') }}
                </p>
            </div>


            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection


