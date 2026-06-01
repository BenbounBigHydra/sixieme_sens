@extends('layout-cobrand')

@section('content')
    <infos-cobrand :initial-data="{{ $initialData ?? 'null' }}"></infos-cobrand>
@endsection
