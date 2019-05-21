@extends('layouts.app')

@section('content')
<home-component
    :posts="{{ $posts }}">
</home-component>
@endsection
