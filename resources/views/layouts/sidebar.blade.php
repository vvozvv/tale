<div class="sidebar">
    <h3 class="sidebar__title">Актуальные новости</h3>
    @foreach($categories as $cat)
        <a href="{{ route('tag') }}" class="sidebar__link">
            <span class="sidebar__count">{{ $cat->articles->count() }}</span>
            <p class="sidebar__name">{{ $cat->name }}</p>
        </a>
    @endforeach
</div>
