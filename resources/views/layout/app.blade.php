<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Hiang Food')</title>

    {{-- Styles (vite or plain css) --}}
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @stack('styles')
</head>
<body>
    {{-- Notifications common --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err) <div>{{ $err }}</div> @endforeach
        </div>
    @endif

    {{-- Header (common) --}}
    @include('partials.header')

    {{-- Main content from child views --}}
    <main>
        @yield('content')
    </main>

    {{-- Modals (push into stack from children) --}}
    @stack('modals')

    {{-- Scripts --}}
    <script>
        // small helper, loaded on every page
    </script>
    @stack('scripts')
</body>
</html>