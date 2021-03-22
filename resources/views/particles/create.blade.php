<div class="p-5">
    <form action="{{ route('particles.store', ['space' => $space->id]) }}" method="POST" class="space-y-3 mr-auto ml-auto">
        @csrf
        <textarea rows="5" name="body" class="block border border-black w-3/4 p-2.5"></textarea>
        <button type="submit" class="p-3 w-20 bg-indigo-300 rounded-lg">Post</button>
    </form>
</div>
