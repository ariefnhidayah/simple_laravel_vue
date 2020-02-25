@extends('layouts.app')
@section('title', 'Home')
@section('content')
    @guest
    <notlogin-component></notlogin-component>
    @else
    <biodata-component></biodata-component>
@endguest
@endsection
