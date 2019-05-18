@extends('templates.app')

@section('app_container')
<div data-page="collection" class="app-container">
    <h1>Collection de tous les livres</h1>
<!-- @foreach($categories as $category)
    {{ var_dump($category->books()) }}
@endforeach -->
</div>
@endsection