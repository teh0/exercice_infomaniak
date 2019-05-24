<nav class="menu-backoffice">
    <a class="menu-link" href="{{ route('home') }}">
        <img src="{{ asset('img/svg/left_arrow.svg') }}" alt="flèche retour accueil">
        <span>Revenir à l'accueil</span>
    </a>
<a href="{{ route('backoffice', 'users') }}" class="menu-link menu-backoffice-link @if($page === 'users') isSelected @endif">
        <img src="{{ asset('img/svg/user.svg') }}" alt="">
        <span>Gérer les utilisateur</span>
    </a>
    <a href="{{ route('backoffice', 'books') }}" class="menu-link menu-backoffice-link @if($page === 'books') isSelected @endif">
        <img src="{{ asset('img/svg/book.svg') }}" alt="">
        <span>Gérer les livres</span>
    </a>
    <a href="{{ route('createBook') }}" class="menu-link menu-backoffice-link">
        <img src="{{ asset('img/svg/add_book.svg') }}" alt="">
        <span>Ajouter un livre</span>
    </a>
</nav>