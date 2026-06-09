@extends('layout-cobrand', ['hideFooter' => true])

@section('content')
    <closed-cobrand :initial-data="{{ $initialData ?? 'null' }}"></closed-cobrand>
@endsection

