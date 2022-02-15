@extends('layouts.base')

@section('body')
    @include('layouts.sidebar')
@isset($slot)
    {{$slot}}
@endisset
@endsection