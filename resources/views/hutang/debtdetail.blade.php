@extends('template.main')
@section('content')
    @livewire('hutang.debt-detail', ['userid' => $userid])
@endsection