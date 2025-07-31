<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouvelle demande d'assistance projet</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .email-header {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .email-body {
            padding: 30px;
        }
        
        .project-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .detail-item {
            display: flex;
            margin-bottom: 12px;
        }
        
        .detail-label {
            font-weight: 600;
            width: 140px;
            color: #495057;
        }
        
        .detail-value {
            flex: 1;
            color: #212529;
        }
        
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        
        .btn-admin {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white !important;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.3);
        }
        
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-new {
            background-color: #e6f7ff;
            color: #1890ff;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Nouvelle demande d'assistance projet</h1>
        </div>
        
        <div class="email-body">
            <p>Bonjour,</p>
            <p>Une nouvelle demande d'assistance pour la rédaction de projet/business plan a été soumise :</p>
            
            <div class="project-details">
                <div class="detail-item">
                    <div class="detail-label">Titre du projet :</div>
                    <div class="detail-value">{{ $project->title }} <span class="badge badge-new">Nouveau</span></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Client :</div>
                    <div class="detail-value">{{ $project->user->client->fist_name }} {{ $project->user->client->last_name }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Budget disponible :</div>
                    <div class="detail-value">{{ number_format($project->budget, 0, ',', ' ') }} F CFA</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Date de soumission :</div>
                    <div class="detail-value">{{ $project->created_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>
            
            <p>Pour consulter les détails complets de cette demande et prendre les mesures nécessaires :</p>
            
            <div class="btn-container">
                <a href="{{ $adminUrl }}" class="btn-admin">Accéder à la demande</a>
            </div>
        </div>
        
        <div class="email-footer">
            <p>Ceci est une notification automatique. Merci de ne pas répondre à cet email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>