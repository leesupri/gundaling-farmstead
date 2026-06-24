<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Gundaling Farmstead | Farm-to-Table Restaurant in Berastagi' }}</title>
    <meta name="description" content="{{ $description ?? 'Experience true farm-to-table dining at Gundaling Farmstead, Berastagi. Open kitchen, wood-fire pizza, artisan cheese & Karo cuisine. Est. 2005.' }}">

    <link rel="alternate" hreflang="en" href="https://gundalingfarmstead.com{{ request()->getPathInfo() }}"/>
    <link rel="alternate" hreflang="id" href="https://gundalingfarmstead.com/id{{ request()->getPathInfo() }}"/>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @hasSection('schema')
        <script type="application/ld+json">@yield('schema')</script>
    @endif
</head>
<body class="font-sans bg-earth-50 text-earth-900 antialiased">

    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.whatsapp-float')

    @include('partials.scroll-top')

</body>
</html>
