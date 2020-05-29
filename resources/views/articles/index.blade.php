@extends('layout')

@section ('content')


<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>All articles</h2>
			</div>

			<ul class="style1">
				@forelse ($articles as $article)
					<li class="first">
						<!-- <h3><a href=' $article->path() '>{{ $article->title }}</a></h3> -->
						<h3><a href='{{ route("articles.show", $article->id) }}'>{{ $article->title }}</a></h3>
						<!-- <h3><a href='/articles/{{ $article->id }}'>{{ $article->title }}</a></h3> -->
						<span>{{ $article->excerpt }}</span>

                        <p>{{ $article->body }}</p>
					</li>
				@empty
					<p>No relevent articles yet!</p>
				@endforelse
			</ul>

		</div>
	</div>
</div>

@endsection