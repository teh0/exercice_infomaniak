<nav class="menu-backoffice">
<a class="home-link" href="{{ route('home') }}">
        <img src="{{ asset('img/svg/left_arrow.svg') }}" alt="flèche retour accueil">
        <span>Revenir à l'accueil</span>
    </a>
    <a href="" class="menu-backoffice-link @if($page === 'users') isSelected @endif">
        <img src="{{ asset('img/') }}" alt="">
        <span>Gérer les utilisateur</span>
    </a>
    <a href="" class="menu-backoffice-link @if($page === 'books') isSelected @endif">
        <img src="{{ asset('img/') }}" alt="">
        <span> Gérer les livres</span>
    </a>
</nav>