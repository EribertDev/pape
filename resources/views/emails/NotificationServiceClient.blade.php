<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Nouvelle Commande</title>
</head>
<body>
    <h1>Notification : Nouvelle Commande Reçue</h1>

    <p>Bonjour,</p>
    <p>Une nouvelle commande a été passée sur la plateforme la part de Mr/Mme  <span style="font-weight: bold;">{{ $client }} / {{ $prenom }}</span>  joignable par mail au <span style="font-weight: bold;">{{ $email }}  </span> et par téléphone au
         <span style="font-weight: bold;">{{ $telephone }}</span> </p>

    

    <p>Veuillez prendre en charge cette commande dans les plus brefs délais.</p>

    <p>Cordialement,</p>
    <p><em>L'équipe CESIE Benin</em></p>
    <img src="https://syrram.cesiebenin.com/clients/assets/images/icon/logo-syrram.png" style="width: 70px;height: 60px" alt="">

</body>
</html>






