<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
<article class="py-8 max-w-screen-md">
    <h2 class="mb-1 text-3xl tracking-tight font-bold text-white-900 hover:underline">{{ $post['title'] }}</h2>
    <div>
        <a href="#" class="text-base text-white-500">{{ $post->author->name }}</a> | {{ $post->created_at->diffForHumans() }}
    </div>
    <p class="my-4 font-light">{{ $post['body'] }}</p>
    </p>
    <a href="/admin/posts" class="font-medium text-blue-500 hover:underline">&laquo; Back</a>
</article>
</x-layout>
