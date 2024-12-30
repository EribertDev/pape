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
<p>Commande acceptée
    Votre demande de rédaction de mémoire ou thèse exprimée le .... Portant sur.......est acceptée.
   . Merci</p>
<img src="https://syrram.cesiebenin.com/clients/assets/images/icon/logo-syrram.png" style="width: 70px;height: 60px" alt="">
</body>
</html>
