@extends('components.layout')
@section('title', 'Ingredients')

@section('content')

<h1>Edit ingredient "{{ $ingredient->name }}"</h1>

@include('components.alert.success_message')



<form action="{{ route('ingredient.edit', ['id' => $ingredient->id]) }}" method="post" class="row g-3">
    

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
        <label class="form-label">Ingredient name:</label>
        <input type="text" name="name" value="{{ old('name', $ingredient->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Ingredient name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div><br>
        @enderror
    </div>

   
    <div class="form-group">
        <input type="checkbox" name="is_active" class="form-check-input" value="1" @if (old('is_active', $ingredient->is_active)) checked @endif>
        <label class="form-check-label">is_active?</label>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection