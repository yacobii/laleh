<div>
    @if($errors->any())
        <ul class="list-disc list-inside text-red-500 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
