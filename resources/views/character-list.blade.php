@extends('layouts.app')

@section('content')
<div id="app">
    @if(isset($characters))
        <character-list :initial-characters="{{ json_encode($characters) }}"></character-list>
    @endif
</div>
@endsection
