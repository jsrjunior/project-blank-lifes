@extends('admin.layouts.template')

@section('filters')
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                {{ html()->label(__('E-mail'), 'q[email][contains]') }}
                {{ html()->text('q[email][contains]', request()->input('q.email.contains'))->class('form-control') }}
            </div>
        </div>
    </div>
@stop

@include('admin.layouts.partials.crud.index')