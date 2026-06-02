@extends('layout-cobrand')

@section('content')
    <home-cobrand :initial-data="{{ $initialData ?? 'null' }}"></home-cobrand>
@endsection
