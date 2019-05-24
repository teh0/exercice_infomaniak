@extends('templates.app')

@section('app_container')
<div data-page="book-edit" class="app-container">
    <div class="book-edit-overlay overlay"></div>
    {{-- Delete button --}}
    <a class="button-book-delete" href="" onclick="event.preventDefault(); document.getElementById('form-delete-book').submit();">
        <img src="{{ asset('img/svg/garbage.svg') }}" alt="">
        <span>Supprimer le livre</span>
    </a>
    <form id="form-delete-book" action="{{ route('deleteBook', $book->id) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    
    {{-- Edit Form --}}
    <form enctype="multipart/form-data" action="{{ route('updateBook', $book->id )}}" method="POST" class="form-borrowell">
        @csrf
        <div class="form-header">
            <p><span class="sharp">#</span>&nbsp;Modifier le livre</p>
        </div>
        <!-- Book title -->
        <div class="block-form">
            @error('book_title')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="book_title">Titre</label>
            <input id="book_title" type="text" value="{{ $book->title }}" placeholder="Titre" class="form-control @error('book_title') invalid @enderror" name="book_title" value="{{ old('book_title') }}" required autofocus>
        </div>

        <!-- Book author -->
        <div class="block-form">
            @error('book_author')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="book_author">Auteur</label>
            <input id="book_author" type="text" value="{{ $book->authors }}" placeholder="Auteur" class="form-control @error('book_author') invalid @enderror" name="book_author" value="{{ old('book_author') }}" required>
        </div>

        <!-- Book description -->
        <div class="block-form">
            @error('book_description')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="book_description">Description</label>
            <textarea id="book_description" placeholder="Description" class="form-control @error('book_description') invalid @enderror" name="book_description" value="{{ old('book_description') }}" required>
                    {{ urlDecode($book->description) }}
            </textarea>
        </div>

        <!-- Book pageCount -->
        <div class="block-form">
            @error('book_pageCount')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="book_pageCount">Nombre de page</label>
            <input type="text" value="{{ $book->pageCount }}" id="book_pageCount" placeholder="Nombre de page" class="form-control @error('book_pageCount') invalid @enderror" name="book_pageCount" value="{{ old('book_pageCount') }}" required>
        </div>

        <!-- Book lang -->
        <div class="block-form">
            @error('book_lang')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="book_lang">Nombre de page</label>
            <input type="text" value="{{ $book->lang }}" id="book_lang" placeholder="Langue" class="form-control @error('book_lang') invalid @enderror" name="book_lang" value="{{ old('book_lang') }}" required>
        </div>

        <!-- Book category -->
        <div class="block-form">
            @error('book_category')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="book_category">Nombre de page</label>
            <select type="text" id="book_category" class="form-control @error('book_pageCount') invalid @enderror" name="book_category" value="{{ old('book_category') }}" required>
                <option {{ $book->category->slug =="php" ? "selected" : "" }} value="php">PHP</option>
                <option {{ $book->category->slug =="javascript" ? "selected" : "" }} value="javascript">Javascript</option>
                <option {{ $book->category->slug =="html" ? "selected" : "" }} value="html">HTML</option>
                <option {{ $book->category->slug =="css" ? "selected" : "" }} value="css">CSS</option>
                <option {{ $book->category->slug =="python" ? "selected" : "" }} value="python">Python</option>
                <option {{ $book->category->slug =="nodejs" ? "selected" : "" }} value="nodejs">NodeJs</option>
            </select>
        </div>
        <!-- Book Thumbnail -->
        <div class="block-form block-thumbnail">
            @error('book_large_thumbnail')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="book_large_thumbnail">Cliquer pour modifier l'image pour la couverture
                    <img src="{{ $book->small_thumbnail }}" alt="">
            </label>
            <input type="file" name="book_large_thumbnail" id="book_large_thumbnail">
        </div>
        <!-- Button submit -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection