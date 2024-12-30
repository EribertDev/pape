<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande traitée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 20px;
        }
        h1 {
            color: #333333;
            text-align: center;
        }
        p {
            line-height: 1.5;
            color: #555555;
        }
        .details {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 6px;
            margin-top: 15px;
        }
        .details ul {
            list-style-type: none;
            padding: 0;
        }
        .details ul li {
            margin: 5px 0;
            color: #333333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85em;
            color: #777777;
        }
    </style>
</head>
</head>
<body>
    <div class="email-container">
        <h1>Votre commande a été traitée avec succès</h1>
        <p>Bonjour {{ $user->fist_name }} {{ $user->last_name }},</p>

        <p>Nous sommes heureux de vous informer que le document relatif à votre  commande du {{ $commande->created_at->format('d/m/Y') }}</li>  portant sur le sujet " <strong>{{ $commande->subject }}</strong> "   est disponible sur la plateforme PAPE.</p>

        <div class="details">

        
            @if(strtolower($ff->description) === 'protocole')
                <p>Le document positionné est le protocole et vous ne paierez que la moitié du montant total via la plateforme  pour le télécharger </p>
                @else
                <p>Le document positionné est le travail complet et vous devrez finir de solder via la plateforme pour pouvoir le télécharger.</p>
            @endif
       
        
            </div>

               

        <p>Si vous avez des questions ou des préoccupations concernant votre commande, n'hésitez pas à nous contacter. Merci pour votre confiance en notre service !</p>

        <div class="footer">
            <p>Cordialement, <br/> L'équipe SyRRaM</p>
          
        
            <p>Cordialement,</p>
            <p><em>L'équipe CESIE Benin</em></p>
            <img src="https://syrram.cesiebenin.com/clients/assets/images/icon/logo-syrram.png" style="width: 70px;height: 60px" alt="">
        </div>
    </div>
</body>
</html>
