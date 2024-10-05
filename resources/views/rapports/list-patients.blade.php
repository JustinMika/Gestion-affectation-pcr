<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple Tailwind CSS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset("cdn/css/app.css") }}" rel="stylesheet">
</head>
<body>
    <div>
    </div>
    <h3 class="text-center text-red-600 underline font-bold text-2xl" style="text-align: center;text-decoration-line: underline;font-weight: 700;font-size: 1.5re">FICHE DE MALADE</h3>
    <table class="w-full mb-8 border-collapse mt-5" style="width: 100%;margin-bottom: 2rem; border-collapse: collapse;margin-top: 1.25rem">
        <thead>
            <tr>
                <th class="px-4 py-2 bg-gray-100 border" style="background-color:#f3f4f6;border-width: 1px;">ID</th>
                <th class="px-4 py-2 bg-gray-100 border" style="background-color:#f3f4f6;border-width: 1px;">Nom</th>
                <th class="px-4 py-2 bg-gray-100 border" style="background-color:#f3f4f6;border-width: 1px;">Email</th>
            </tr>
        </thead>
        <tbody>
            @if(count($patient))
            @foreach ($patient as $u)
            <tr>
                <td class="px-4 py-2 border">{{ $u->id ?? '' }}</td>
                <td class="px-4 py-2 border">{{ $u->name ?? ''}}</td>
                <td class="px-4 py-2 border">{{ $u->email ?? ''}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
