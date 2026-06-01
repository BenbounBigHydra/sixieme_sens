@extends('layout')

@section('content')
    <label-vitrine :initial-data="{{ $initialData ?? 'null' }}"></label-vitrine>
@endsection
