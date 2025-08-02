<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre projet a été approuvé</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        .email-header {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            padding: 30px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .email-header::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        
        .email-header::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        
        .email-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }
        
        .email-header p {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
            max-width: 80%;
            margin: 0 auto;
        }
        
        .email-body {
            padding: 40px 30px;
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
        
        .project-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #00b09b;
        }
        
        .project-title {
            font-size: 20px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 15px;
        }
        
        .detail-item {
            display: flex;
            margin-bottom: 10px;
        }
        
        .detail-label {
            font-weight: 600;
            width: 160px;
            color: #495057;
        }
        
        .detail-value {
            flex: 1;
            color: #212529;
        }
        
        .deadline-notice {
            background: #fff8e6;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin: 25px 0;
            display: flex;
            align-items: center;
        }
        
        .deadline-notice i {
            font-size: 24px;
            color: #ffc107;
            margin-right: 15px;
        }
        
        .deadline-notice strong {
            color: #d39e00;
        }
        
        .payment-section {
            background: #e6f7ff;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
            border: 1px solid #b3e0ff;
        }
        
        .amount-highlight {
            font-size: 32px;
            font-weight: 700;
            color: #0d6efd;
            margin: 15px 0;
            text-shadow: 0 2px 4px rgba(13, 110, 253, 0.1);
        }
        
        .btn-payment {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #00b09b, #96c93d);
            color: white !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 176, 155, 0.3);
            border: none;
            margin: 20px 0;
        }
        
        .btn-payment:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 176, 155, 0.4);
        }
        
        .steps {
            display: flex;
            justify-content: space-between;
            margin: 40px 0 30px;
            position: relative;
        }
        
        .steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            width: 25%;
        }
        
        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .step.active .step-icon {
            background: #00b09b;
            transform: scale(1.1);
        }
        
        .step-text {
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
        
        .support-info {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        
        .support-info p {
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .contact-info {
            display: inline-block;
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 500;
        }
        
        .email-footer {
            background: #f8f9fa;
            padding: 25px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }
        
        .footer-links {
            margin-top: 15px;
        }
        
        .footer-links a {
            color: #0d6efd;
            text-decoration: none;
            margin: 0 10px;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .email-header {
                padding: 25px 15px;
            }
            
            .email-header h1 {
                font-size: 22px;
            }
            
            .email-body {
                padding: 30px 20px;
            }
            
            .detail-item {
                flex-direction: column;
                margin-bottom: 15px;
            }
            
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
            
            .steps {
                flex-wrap: wrap;
            }
            
            .step {
                width: 50%;
                margin-bottom: 25px;
            }
            
            .steps::before {
                display: none;
            }
            
            .btn-payment {
                padding: 14px 30px;
                font-size: 16px;
                width: 100%;
            }
            
            .amount-highlight {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Votre projet a été approuvé !</h1>
            <p>Félicitations, vous pouvez maintenant procéder au paiement pour démarrer la rédaction</p>
        </div>
        
        <div class="email-body">
            <div class="confirmation-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </div>
            
            <p>Bonjour,</p>
            <p>Nous sommes ravis de vous informer que votre projet <strong>"{{ $project->title }}"</strong> a été examiné et approuvé par notre équipe d'experts.</p>
            
            <div class="project-card">
                <div class="project-title">Détails de votre projet</div>
                
                <div class="detail-item">
                    <div class="detail-label">Référence :</div>
                    <div class="detail-value">#{{ $project->id }}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Date de soumission :</div>
                    <div class="detail-value">{{ $project->created_at->format('d/m/Y à H:i') }}</div>
                </div>
                
              
            </div>
            
            <div class="deadline-notice">
                <i class="fas fa-clock"></i>
                <div>
                    <p>Pour garantir votre place dans notre planning, veuillez effectuer le paiement avant le <strong>{{ $deadlineDate }}</strong>. Après cette date, votre projet pourrait être reporté.</p>
                </div>
            </div>
            
            <div class="payment-section">
                <h3>Montant à payer</h3>
                <div class="amount-highlight">100 000 F CFA</div>
                <p>Frais de service pour la rédaction professionnelle de votre projet</p>
                
                <a href="" class="btn-payment">
                    <i class="fas fa-lock me-2"></i> Payer maintenant
                </a>
                
                <p class="text-muted">Paiement sécurisé - Support technique disponible 24h/24</p>
            </div>
            
            <div class="steps">
                <div class="step active">
                    <div class="step-icon">1</div>
                    <div class="step-text">Validation</div>
                </div>
                <div class="step">
                    <div class="step-icon">2</div>
                    <div class="step-text">Paiement</div>
                </div>
                <div class="step">
                    <div class="step-icon">3</div>
                    <div class="step-text">Rédaction</div>
                </div>
                <div class="step">
                    <div class="step-icon">4</div>
                    <div class="step-text">Livraison</div>
                </div>
            </div>
            
            <div class="support-info">
                <p>Des questions sur le processus ou besoin d'assistance ?</p>
                <div class="contact-info">
                    <i class="fas fa-envelope me-2"></i> serviceclient@cesiebenin.com
                    <i class="fas fa-phone ms-3 me-2"></i> +229 01 62 43 59 29
                </div>
            </div>
        </div>
        
        <div class="email-footer">
            <p>Ceci est une notification automatique. Merci de ne pas répondre à cet email.</p>
            <div class="footer-links">
                <a href="#">Conditions d'utilisation</a> | 
                <a href="#">Politique de confidentialité</a> | 
                <a href="#">Centre d'aide</a>
            </div>
            <p class="mt-3">&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>