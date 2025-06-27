@extends('layouts.main-layout')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    @livewire('user-profile')
    @livewire('edit-password')
  </div>
</div>

@endsection