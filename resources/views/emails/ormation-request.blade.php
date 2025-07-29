<!DOCTYPE html>
<html>
<head>
    <title>Demande de Formation</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; }
        .header { background-color: #2eca7f; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; color: #1a2d62; }
        .footer { text-align: center; padding: 10px; color: #777; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nouvelle demande de formation</h2>
        </div>
        
        <div class="content">
            <div class="section">
                <h3>Informations Personnelles</h3>
                <p><span class="label">Nom:</span> {{ $data['lastName'] }}</p>
                <p><span class="label">Prénom:</span> {{ $data['firstName'] }}</p>
                <p><span class="label">Email:</span> {{ $data['email'] }}</p>
                <p><span class="label">Téléphone:</span> {{ $data['phone'] }}</p>
            </div>
            
            <div class="section">
                <h3>Détails de la Formation</h3>
                <p><span class="label">Type:</span> {{ $data['formationType'] }}</p>
                <p><span class="label">Thème:</span> {{ $data['formationTheme'] }}</p>
                <p><span class="label">Participants:</span> {{ $data['participants'] }}</p>
                <p><span class="label">Durée:</span> {{ $data['duration'] }} jours</p>
                <p><span class="label">Dates préférées:</span> {{ $data['datePreference'] ?? 'Non spécifié' }}</p>
            </div>
            
            <div class="section">
                <h3>Objectifs</h3>
                <p>{{ $data['objectives'] }}</p>
            </div>
            
            @if(!empty($data['additionalInfo']))
            <div class="section">
                <h3>Informations Complémentaires</h3>
                <p>{{ $data['additionalInfo'] }}</p>
            </div>
            @endif
        </div>
        
        <div class="footer">
            <p>Demande envoyée le {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</body>
</html>