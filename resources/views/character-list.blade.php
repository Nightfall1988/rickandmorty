@extends('layouts.app')

@section('content')
<div>
    <div id="app">
        @if(isset($characters))
            <character-list :characters="{{ $characters }}"></character-list>
        @endif
    </div>
</div>
@endsection