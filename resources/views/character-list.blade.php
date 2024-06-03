@extends('layouts.app')

@section('content')
<div id="app">
    @if(isset($characters))
        <character-list :initial-characters='@json($characters)' :initial-next-page='@json($nextPage)'></character-list>
    @endif
</div>
@endsection