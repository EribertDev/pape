<!DOCTYPE html>
<html>
<head>
    <title>Protocole Prêt</title>
    <title>Commande traitée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

    .footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.85em;
        color: #777777;
    }
</style>
</head>
<body>
    <h1>Bonjour M/Mme  {{ $client }} ,</h1>
    <p>Le {{ $service }} pour le thème <strong>{{ $theme }}</strong> est maintenant prêt.</p>
    <p>Vous pouvez procéder au payement sur la plateforme PAPE  pour pouvoir le télécharger </p>
    <br>
    <div class="footer">
           
        <p>Cordialement,</p>
        <p><em>L'équipe CESIE Benin</em></p>
        <img src="https://syrram.cesiebenin.com/clients/assets/images/icon/logo-syrram.png" style="width: 70px;height: 60px" alt="">
    </div>
</body>
</html>