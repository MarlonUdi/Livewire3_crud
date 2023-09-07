<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Livewire 3 CRUD' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        {{ $slot }} {{-- Este slot comporta só um componente, por isso podemos fazer os componentes em outro local e depois só resgata-los usando o cod a baixo--}}
        {{-- @livewire('post-component') --}}
    </body>
</html>
