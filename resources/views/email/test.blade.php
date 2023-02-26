<x-mail::message>
# Hi {{$user->name}}
<h2><b>Welcome Duha, This is the first mail you have sent!</b></h2>


<x-mail::button :url="''">
Read more
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
