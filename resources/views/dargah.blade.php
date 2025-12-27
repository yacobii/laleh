<x-layouts.app>


    <div class="grid place-items-center h-dvh">

        <form action="{{ route('parsian') }}" method="post">
            @csrf
            <button type="submit">send</button>
        </form>

    </div>

</x-layouts.app>
