@extends('client.index')

@section('content')

    @each('components.tag' , $tags , 'tag')

@endsection