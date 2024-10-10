<!DOCTYPE html>
<html>
<head>
    <title>Commande Approuvée</title>
</head>
<body>
<h1>Votre commande a été approuvée !</h1>
<p>Bonjour {{ $client->last_name }},</p>
<p>Nous venons de confirmer votre </p>
<p><span>Sujet : </span> <span>{{$commande->subject}} </span> </p>
<p>Veilleur payer les frais de prise de contacte dans votre dashboard </p>
<p>Rendez sur votre dashboard pour effectuer les payements.</p>
<p>Merci de nous faire confiance </p>
<img src="https://cesiebenin.com/storage/leaflet_file/logo-syrram.png" style="width: 70px;height: 60px" alt="">
</body>
</html>
