@extends('errors::minimal')

@section('title', __('errors.403.err'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'errors.403.err'))
