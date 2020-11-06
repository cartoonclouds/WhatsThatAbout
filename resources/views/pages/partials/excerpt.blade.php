<h1>
    <a href="{{ $page->url }}">{{ $page->title }}</a>
</h1>

<label>Release Year</label>
<p>{{ $page->release_year }}</p>

<label>Creator</label>
<p>{{ $page->creator->name }}</p>

<label>Synopsis</label>
<p>
    {{ $page->synopsis }}
</p>
