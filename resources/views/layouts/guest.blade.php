<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Login') - {{ config('app.name', 'Buku') }}</title>

    <!-- Favicon Buku dengan Emoji -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%238b5a2b'>📚</text></svg>">
    
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90' fill='%238b5a2b'>📚</text></svg>">
    
    <!-- Alternate Favicon dengan SVG Buku -->
    <link rel="alternate icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%238b5a2b'%3E%3Cpath d='M21 4H7c-1.105 0-2 .895-2 2v12c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V6c0-1.105-.895-2-2-2zm0 14H7V6h14v12zM3 18c-.552 0-1-.448-1-1V7c0-.552.448-1 1-1s1 .448 1 1v10c0 .552-.448 1-1 1z'/%3E%3C/svg%3E">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/modern-dashboard.css') }}">

    <!-- Additional Book Theme CSS -->
    <style>
        /* Book theme customizations */
        :root {
            --book-brown: #8b5a2b;
            --book-light: #fef7e9;
            --book-dark: #4a3b2c;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f0e7d8;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--book-brown);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #6b431e;
        }
        
        /* Book icon animation */
        @keyframes bookBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .book-icon {
            animation: bookBounce 2s ease-in-out infinite;
            display: inline-block;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>