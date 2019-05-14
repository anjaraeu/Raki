@extends('app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h2>{{ __('welcome.title') }}</h2>
            <p>{{ __('welcome.synopsis') }}</p>

            <form action="/upload" class="dropzone" id="anjaradrop">
                {{ csrf_field() }}
            </form>

            <br>

            <form action="/publish" method="POST" class="ui form">
                {{ csrf_field() }}
                <div class="field">
                    <label for="name">{{ __('welcome.groupname._') }}</label>
                    <input type="text" placeholder="{{ __('welcome.groupname.placeholder') }}" name="name">
                </div>
                <div class="field">
                    <label for="expiry">{{ __('welcome.expiry._') }}</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="expiry">
                        <i class="dropdown icon"></i>
                        <div class="default text">{{ __('welcome.expiry.placeholder') }}</div>
                        <div class="menu">
                            <div class="item" data-value="86400">{{ __('welcome.expiry.day') }}</div>
                            <div class="item" data-value="604800">{{ __('welcome.expiry.week') }}</div>
                            <div class="item" data-value="2635200">{{ __('welcome.expiry.month') }}</div>
                            <div class="item" data-value="31557600">{{ __('welcome.expiry.year') }}</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <input type="submit" class="ui blue button" value="{{ __('welcome.submit') }}">
                </div>
            </form>
        </div>
    </div>
@endsection
