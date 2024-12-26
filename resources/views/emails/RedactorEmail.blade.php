<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Nouvelle Commande</title>
</head>
<body>
    <h1>Notification : Vous avez été assigné(e) à une nouvelle commande </h1>

  


<h3>Vous avez été ajouté à une nouvelle commande de rédaction. Voici les informations :</h3>


<ul>
    <li><strong>ID de la commande :</strong> {{ $commande->id }}</li>
    <li><strong>Sujet  :</strong> {{ $commande->subject }}</li>
    <li><strong>Université </strong> {{ $commande->universite }}</li>
    <li><strong>Pays</strong> {{ $commande->pays }}</li>
    <li><strong>Année académique :</strong> {{ $commande->annee_academique }}</li>
    <li><strong>Niveau :</strong> {{ $commande->niveau }}</li>
    <li><strong>Nombre de page max :</strong> {{ $commande->max_pages }}</li>
    <li><strong>Deadlines  :</strong> {{ $commande->deadline }}</li>
    
</ul>

<h3>Voilà ci joint les informations du client pour d'éventuelles prise de contact </h3>

    <ul>
        <li><strong>Nom et prénom   :</strong> {{ $clientInfo->first_name }} {{ $clientInfo->last_name }}</li>
        <li><strong>Numéro </strong> {{ $clientInfo->phone_number }}</li>
      
        

    </ul>





<p>Nous vous remercions pour votre collaboration !</p>

<p>Cordialement, <br/> L'équipe SyRRaM</p>
    <p>Veuillez prendre en charge cette commande dans les plus brefs délais.</p>

    <p>Cordialement,</p>
    <p><em>L'équipe CESIE Benin</em></p>
    <img src="https://syrram.cesiebenin.com/clients/assets/images/icon/logo-syrram.png" style="width: 70px;height: 60px" alt="">

</body>
</html>
