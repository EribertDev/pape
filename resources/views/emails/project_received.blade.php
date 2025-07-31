<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de votre demande d'assistance projet</title>
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
            background: linear-gradient(135deg, #00b09b, #96c93d);
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
        
        .confirmation-icon {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .confirmation-icon svg {
            width: 80px;
            height: 80px;
            fill: #28a745;
        }
        
        .project-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .summary-item {
            margin-bottom: 10px;
        }
        
        .summary-label {
            font-weight: 600;
            color: #495057;
        }
        
        .payment-info {
            background: #e6f7ff;
            border-left: 4px solid #1890ff;
            padding: 15px;
            border-radius: 4px;
            margin: 25px 0;
        }
        
        .amount-highlight {
            font-size: 24px;
            font-weight: 700;
            color: #1890ff;
            text-align: center;
            margin: 15px 0;
        }
        
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        
        .btn-payment {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: white !important;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-payment:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 176, 155, 0.3);
        }
        
        .support-info {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }
        
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }
        
        .steps {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            text-align: center;
        }
        
        .step {
            flex: 1;
            padding: 15px;
            position: relative;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            background: #1890ff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: 600;
        }
        
        .step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 15px;
            right: -10px;
            width: 20px;
            height: 2px;
            background: #dee2e6;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Confirmation de votre demande</h1>
        </div>
        
        <div class="email-body">
            <div class="confirmation-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </div>
            
            <p>Bonjour,</p>
            <p>Nous avons bien reçu votre demande d'assistance pour la rédaction de votre projet/business plan. Notre équipe va examiner votre demande et vous contactera dans les plus brefs délais.</p>
            
            <div class="project-summary">
                <div class="summary-item">
                    <span class="summary-label">Titre du projet :</span> {{ $project->title }}
                </div>
                <div class="summary-item">
                    <span class="summary-label">Problématique :</span> {{ $project->problem }}
                </div>
                <div class="summary-item">
                    <span class="summary-label">Budget disponible :</span> {{ number_format($project->budget, 0, ',', ' ') }} F CFA
                </div>
                <div class="summary-item">
                    <span class="summary-label">Date de soumission :</span> {{ $project->created_at->format('d/m/Y à H:i') }}
                </div>
            </div>
            
            <div class="payment-info">
                <p><strong>Montant à payer pour le service :</strong></p>
                <div class="amount-highlight">100 000 F CFA</div>
                <p>Veuillez effectuer le paiement pour démarrer le processus de rédaction de votre projet.</p>
            </div>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div>Paiement</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div>Analyse</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div>Rédaction</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div>Livraison</div>
                </div>
            </div>
            
            <div class="btn-container">
                <a href="{{ $paymentUrl }}" class="btn-payment">Payer maintenant</a>
            </div>
            
            <div class="support-info">
                <p>Pour toute question, contactez notre équipe support :<br>
                <strong>serviceclient@cesiebenin.com</strong> ou <strong>+229 01 62 43 59 29</strong></p>
            </div>
        </div>
        
        <div class="email-footer">
            <p>Ceci est une confirmation automatique. Merci de ne pas répondre à cet email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>