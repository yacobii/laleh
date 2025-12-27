<x-mail::message>


<p>{{ $data['name'] }}</p>
<p>{{ $data['mobile'] }}</p>
<p >{{ $data['message'] }}</p>
<p>{{ $data['email'] }}</p>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
