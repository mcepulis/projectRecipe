@extends('components.layout')
@section('title', 'Ingredients')

@section('content')

<h1>Recipe list</h1>

@include('components.alert.success_message')

<div class="row">
    <div class="col"> <a href="{{ url('admin/recipe/create') }}" class="btn btn-primary">Create</a> </div>
</div>

<table class="table">
    <tr>
        <th scope="col" width="100">No.</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Photo</th>
        <th scope="col">Is Active?</th>
        <th scope="col" width="100">Edit</th>
        <th scope="col" width="100">Delete</th>
    </tr>
    @foreach($recipes as $recipe)
    <tr>
        <th scope="row">{{ $recipe->id }}</th>
        <td class="list-group-flush" >
            <a href="{{ url('recipe', ['id' => $recipe->id]) }}" class="list-group-item list-group-item-action">{{ $recipe->name }}</a>
        </td>
        <td class="list-group-flush" >
            <a href="{{ url('recipe', ['id' => $recipe->id]) }}" class="list-group-item list-group-item-action">{{ $recipe->description }}</a>
        </td>

        <td>
            @if ($recipe->image) 
        <img src="{{ asset('storage/'.$recipe->image) }}" width="150">
            @endif
        </td>

        <td>{{ $recipe->is_active }}</td>
        <td>
            <a href="{{ route('recipe.edit', ['id' => $recipe->id]) }}" class="btn btn-primary">Edit</a>
        </td>
       
        <td>
            <form action="{{ route('recipe.delete', ['id' => $recipe->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
