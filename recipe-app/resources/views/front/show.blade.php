@section('title', 'Recipe')

@extends('components.min_layout')

@section('content')

<div class="container">
    <div class="row">

        <div class="col text-center">
            <img class="img-fluid rounded" src="{{ asset('storage/' . $recipe->image) }}">
        </div>

        <div class="col">
            <div class="card h-100" >
                <div class="card-body">
                    <h1 class="card-title">{{$recipe->name}}</h1>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{ $recipe->category->name }}</h6>
                    <div>
                        <li class="list-group-item">Ingredients:
                            <ol class="list-group list-group-numbered">
                            @if($recipe->ingredients)
                            @foreach($recipe->ingredients as $ingredient)
                                <li class="list-group-item list-group-item-secondary">{{ $ingredient->name }} </li>
                            @endforeach
                            @endif
                            </ol>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="row">
    <div class="col">
        <div class="card">
            Description: {{$recipe->description}}</div>
        </div>
    </div>
</div>
@endsection
