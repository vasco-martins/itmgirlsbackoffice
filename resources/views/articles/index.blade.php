@extends('layouts.app')

@section('content')
    <h2 class="mb-4">{{ __('Artigos') }}</h2>

    @livewire('article.index')
@endsection

