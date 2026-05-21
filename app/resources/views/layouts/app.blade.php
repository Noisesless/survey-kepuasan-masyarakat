<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">

    <nav class="fixed bottom-4 left-1/2 -translate-x-1/2 bg-white shadow-lg rounded-full px-6 py-3 flex gap-6 z-[100]">
        <a href="/" class="text-blue-600">Home</a>
        @auth
            <a href="/dashboard" class="text-gray-600">Admin</a>
            <form action="/logout" method="POST">@csrf<button type="submit">Logout</button></form>
        @else
            <a href="/login" class="text-gray-600">Login</a>
        @endauth
    </nav>

    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)" x-show="show" class="p-8">
        {{ $slot }}
    </div>

    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full">Top</button>

</body>
</html>
