@extends('app')

@section('head')
<meta http-equiv="refresh" content="5">
@endsection

@section('content')
<div class="ui container first">
    <div class="ui segment">
        <div class="ui middle aligned center aligned centered grid">
            <div class="center aligned column">
                <img src="/images/loading.gif" alt="Loading glyph provided by loading.io">
                <p>{{ __('group.download.wait') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
