@extends('components.layout')
@section('title', 'Ingredients')

@section('content')

<h1>Edit recipe "{{ $recipe->name }}"</h1>

@include('components.alert.success_message')


<form action="{{ route('recipe.edit', ['id' => $recipe->id]) }}" method="post" class="row g-3">
    

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @csrf
    <div class="form-group">
        <label class="form-label">Recipe name:</label>
        <input type="text" name="name" value="{{ old('name', $recipe->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Recipe name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Description:</label>
        <input type="text" name="description" value="{{ old('description', $recipe->description) }}" class="form-control @error('description') is-invalid @enderror" placeholder="Description">
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>
   
    <div class="form-group">
        <input type="checkbox" name="is_active" class="form-check-input" value="1" @if (old('is_active', $recipe->is_active)) checked @endif>
        <label class="form-check-label">is_active?</label>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection