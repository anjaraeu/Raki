@extends('app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h2>{{ __('welcome.title') }}</h2>
            <p>{{ __('welcome.synopsis') }}</p>

            @if ($errors->any())
            <div class="ui error message">
                <div class="header">{{ __('welcome.error._') }}</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <p><strong>{{ __('welcome.error.kept') }}</strong></p>
            </div>
            @endif

            {{-- <form action="/upload" class="dropzone" id="anjaradrop">
                {{ csrf_field() }}
            </form> --}}

            <div id="anjaradrop" class="dropzone"></div>

            <br>

            <submit-form :appurl="env.MIX_APP_URL" :maxexp="env.MIX_MAX_EXPIRATION"></submit-form>
        </div>
    </div>
@endsection
