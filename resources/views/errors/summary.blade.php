<div>
    @if(isset($errors))
        @foreach($errors->all() as $error)
            <div class="bg-red-200 h-12 rounded-xl w-2/3 p-3 mr-auto ml-auto mt-3">
                <span>{{ $error }}</span>
            </div>
        @endforeach
    @endif
</div>
