<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Collectes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Jersey+20&display=swap" rel="stylesheet">
</head>
<body class="bg-[#fffbf1] font-inter">
    <div id="app">
        <collections-admin :initial-data="{{ $initialData }}"></collections-admin>
    </div>
</body>
</html>
