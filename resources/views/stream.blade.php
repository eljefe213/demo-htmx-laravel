<x-app-layout>
    <div class="bg-white flex flex-col gap-6 p-6 lg:flex-row">
        <div class="lg:w-2/3">
            <!-- Player -->
            <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/gerh8ywmuyM" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="lg:w-1/3">
            <!-- Formulaire et liste de commentaires -->
            <form method="post" action="{{ route('comments.store') }}" hx-post="{{ route('comments.store') }}">
                @csrf
                <input name="text" required autofocus class="w-full" placeholder="Tapez votre commentaire et appuyez sur Entrée" />
            </form>
            <div id="comments" hx-get="{{ route('comments.index') }}" hx-trigger="every 1s" hx-swap="afterbegin" class="mt-2 flex flex-col gap-2">
                @fragment('comments')
                @foreach ($comments as $comment)
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    {{ $comment->text }}
                </div>
                @endforeach
                @endfragment
            </div>
        </div>
    </div>
</x-app-layout>