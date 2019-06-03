@extends('errors::minimal')

@section('title', __('errors.503.err'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'errors.503.err'))
@section('additional', __('errors.503.brb'))
