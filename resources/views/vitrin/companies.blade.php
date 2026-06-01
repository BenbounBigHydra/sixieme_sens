@extends('layout')

@section('content')
    <companies-vitrine :initial-data="{{ $initialData ?? 'null' }}"></companies-vitrine>
@endsection
