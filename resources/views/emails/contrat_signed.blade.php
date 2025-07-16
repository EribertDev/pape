<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contrat signé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f6f6;
            padding: 20px;
            color: #333;
        }
        .email-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .content {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            margin-top: 25px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">📄 Nouveau contrat signé</div>

        <div class="content">
            Bonjour,<br><br>

            Le client <strong>{{ $clientName }}</strong> vient de signer un contrat.<br><br>

            <strong>Détails du contrat :</strong><br>
           - Université: {{ $university }}  
            - Domaine: {{ $domaine }}  
            - Niveau: {{ $level }}  
            - Durée: {{ $duration }} mois  
            - Commune: {{ $commune }}  
            - Structure: {{ $structure }}  
            - Binôme: {{ $binome ?? 'Aucun' }}  

            <br>Vous pouvez télécharger le contrat signé en pièce jointe et approuver le contrat si vous le souhaitez.<br><br>
        </div>

        <div class="footer">
            — Système de gestion CESIE Bénin
        </div>
    </div>
</body>
</html>
