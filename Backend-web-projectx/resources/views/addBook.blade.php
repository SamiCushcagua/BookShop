@extends('layouts.app')

@section('content')

@csrf

@if(auth()->user()->admin)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">   
                    <h1>Add Book</h1>
                </div>
                <div class="card-body">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
   
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="title">Title*</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="author">Author*</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="form-group">
                            <label for="description">Description*</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price*</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock*</label>
                            <input type="number" class="form-control" id="stock" name="stock">
                        </div>  
                        <div class="form-group">    
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" id="isbn" name="isbn">
                        </div>
                        <div class="form-group">
                            <label for="publisher">Publisher</label>
                            <input type="text" class="form-control" id="publisher" name="publisher">
                        </div>
                        <div class="form-group">
                            <label for="publication_year">Publication Year</label>
                            <input type="number" class="form-control" id="publication_year" name="publication_year">
                        </div>
                        <div class="form-group">
                            <label for="condition">Condition</label>    
                            <select class="form-control" id="condition" name="condition">
                                <option value="">  </option>
                                <option value="New">New</option>
                                <option value="Used">Used</option>
                             
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="cover_image" name="cover_image" accept="image/*">
                        <small>Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                    </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="">  </option>
                                <option value="category1">Category 1</option>
                                <option value="category2">Category 2</option>
                                <option value="category3">Category 3</option>
                                <option value="category4">Category 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="language">Language</label>
                            <select class="form-control" id="language" name="language">
                                <option value="">  </option>
                                <option value="English">English</option>
                                <option value="Spanish">Spanish</option>  
                                <option value="French">French</option>
                            </select>
                        </div>
                        <div class="form-group">
    <label for="is_available">Is Available</label>
    <select class="form-control" id="is_available" name="is_available">
        <option value="1" {{ old('is_available') == '1' ? 'selected' : '' }}>Disponible</option>
        <option value="0" {{ old('is_available') == '0' ? 'selected' : '' }}>No disponible</option>
    </select>
</div>
                        <button type="submit" class="btn btn-primary">Add Book</button> 

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endif





@endsection