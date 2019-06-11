@extends('app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h2>{{ __('group.manage.title') }}</h2>
            <p>{{ __('group.manage.info') }}</p>
            <manage-form csrf="{{ csrf_token() }}"></manage-form>
        </div>
    </div>
@endsection
