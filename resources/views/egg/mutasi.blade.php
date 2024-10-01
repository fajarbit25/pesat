@extends('template.main')
@section('content')
    @livewire('egg.egg-chart', ['id' => $id])
@endsection