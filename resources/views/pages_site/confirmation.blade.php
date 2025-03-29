<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    <h1>Opération terminée avec succès</h1>

    @if ($operation == 'ajout')
        <p>L'ajout a été effectué avec succès.</p>
    @elseif ($operation == 'modification')
        <p>La modification a été effectuée avec succès.</p>
    @elseif ($operation == 'suppression')
        <p>La suppression a été effectuée avec succès.</p>
    @endif

    <p><a href="{{ route('home') }}">Retour à l'accueil</a></p>
</body>
</html>

