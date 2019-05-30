@extends('app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
        <manage-form :lang="lang" csrf="{{ csrf_token() }}"></manage-form>
        </div>
    </div>
@endsection
