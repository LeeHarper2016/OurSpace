<div>
    @if(isset($errors))
        @foreach($errors as $error)
            <div class="bg-red-200 h-12 rounded-xl w-2/3 p-3 mr-auto ml-auto mt-3">
                <span>{{ $error->message }}</span>
            </div>
        @endforeach
    @endif
</div>
