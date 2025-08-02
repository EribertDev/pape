<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Contrat PAPE</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 1.5cm;
            color: #000;
            background: white;
        }
        
        .page-container {
            position: relative;
            width: 100%;
            min-height: 29.7cm;
            box-sizing: border-box;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header h1 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
        }
        
        .header p {
            margin: 5px 0;
        }
        
        .contact-info {
            text-align: center;
            margin: 10px 0;
        }
        
        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent 10%, #000 10%, #000 90%, transparent 90%);
            margin: 20px 0;
        }
        
        .contract-number {
            text-align: right;
            font-weight: bold;
            margin-bottom: 30px;
        }
        
        .parties {
            margin-bottom: 30px;
        }
        
        .party {
            margin-bottom: 15px;
        }
        
        .party-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 80px;
            padding: 0 20px;
        }
        
        .signature {
            width: 45%;
            border-top: 1px solid #000;
            padding-top: 5px;
            text-align: center;
        }
        
        .logo-container {
            position: absolute;
            top: 20px;
            right: 0;
            display: flex;
            gap: 5px;
        }
        
        .logo {
            width: 0.974in;
            height: 0.841in;
            background-color: #f0f0f0;
            border: 1px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8pt;
            color: #666;
        }
        
        .article-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        
        .article-content {
            margin-left: 20px;
            margin-bottom: 10px;
        }
        
        .footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10pt;
            padding-top: 10px;
            border-top: 1px solid #000;
        }
        
        .footer p {
            margin: 2px 0;
        }
        
        .list-number {
            display: inline-block;
            width: 20px;
            vertical-align: top;
        }
        
        .list-content {
            display: inline-block;
            width: calc(100% - 25px);
        }
        
        .formula-table {
            width: 100%;
            margin: 10px 0;
            border-collapse: collapse;
        }
        
        .formula-table td {
            padding: 5px;
            border: 1px solid #000;
        }
        
        .formula-table th {
            padding: 5px;
            border: 1px solid #000;
            background-color: #f0f0f0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Logos placeholder -->
     
      
        <div class="header">
        <div class="logo-container">
            <div class="logo"><img src="{{ $imageSrc }}" alt="logo"></div>
        </div>
            <h1>RÉPUBLIQUE DU BÉNIN</h1>
            <h1>CABINET D'EXPERTISES STATISTIQUE INFORMATIQUE ET ÉPIDÉMIOLOGIQUE</h1>
            <p>PRESTATIONS INTELLECTUELLES, MATÉRIELS ET MOBILIERS DE BUREAUX</p>
            <div class="contact-info">
                TEL : (+229) 01 62 43 59 29 / 01 98 73 63 50 Site internet 
                <a href="http://www.cesiebenin.com">www.cesiebenin.com</a>
            </div>
             <div class="logo-container">
            <div class="logo"><img src="{{ $imageSrc }}" alt="logo"></div>
        </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="contract-number">
            N° <span id="contractId">  {{ $contract_id }} </span>/CESIE/SG/DERP/SERF/SA du {{ now()->format('d/m/Y') }}
        </div>
        
        <div class="parties">
            <p>Entre les soussignés :</p>
            
            <div class="party">
                <div class="party-title">
                    Cabinet d'Expertises Statistique Informatique et Épidémiologique (CESIE),
                </div>
                <p>
                    dont le siège est à Abomey-Calavi (Rép. Du Bénin), représenté par son Directeur Général 
                    Monsieur GUEVIGBE Dossou Sylvanos, ci-après dénommé « <strong>CESIE BENIN</strong> » ;
                </p>
            </div>
            
            <div class="party">
                <div class="party-title">
                    Et l'étudiant(e) :
                </div>
                <p>
                    Prénoms et nom :{{ $student }}<br>
                    Université : {{ $university }}<br>
                    Niveau : {{ $level }}<br>
                    Durée du stage :{{ $duration }} mois
                </p>
                 @isset($binome) <!-- Condition pour le binôme -->
                <p>En binôme avec :</p>
                <p><strong>Nom :</strong> {{ $binome }}</p>
                @endisset
                <p>Ci-après dénommé « <strong>Stagiaire</strong> »</p>
            </div>
            
            <p>D'autre part,</p>
        </div>
        
        <div class="article-title">Il est convenu ce qui suit :</div>
        
        <div class="article-title">Article 1 : Objet du contrat</div>
        <div class="article-content">
            <p>Le présent contrat a pour objet :</p>
            <p>
                <span class="list-number">1.</span>
                <span class="list-content">La mise en relation et l'obtention d'un stage académique pour le Stagiaire auprès d'une structure d'accueil partenaire ;</span>
            </p>
            <p>
                <span class="list-number">2.</span>
                <span class="list-content">L'assistance obligatoire du Stagiaire par CESIE BENIN dans la rédaction, la correction et la mise en forme de son mémoire ou de sa thèse.</span>
            </p>
        </div>
        
        <div class="article-title">Article 2 : Gratuité de la mise en stage</div>
        <div class="article-content">
            <p>La recherche et la mise en stage académique sont offertes gratuitement par CESIE BENIN.</p>
        </div>
        
        <div class="article-title">Article 3 : Assistance obligatoire</div>
        <div class="article-content">
            <p>La mise en stage étant indissociable du service d'accompagnement, le Stagiaire s'engage à souscrire à l'assistance de CESIE BENIN dans la rédaction de son mémoire ou thèse selon la formule adaptée à son niveau. Pour la formule standard, l'assistance est facturée comme suit :</p>
            
            <table class="formula-table">
                <tr>
                    <th>Niveau</th>
                    <th>Prix</th>
                </tr>
                <tr>
                    <td>Licence</td>
                    <td>35.000 FCFA</td>
                </tr>
                <tr>
                    <td>Master</td>
                    <td>45.000 FCFA</td>
                </tr>
                <tr>
                    <td>Doctorat</td>
                    <td>75.000 FCFA</td>
                </tr>
            </table>
            
            <p>Pour la formule VIP, la facture est celle standard affectée d'une pondération de 1,5.</p>
        </div>
        
        <div class="article-title">Article 4 : Modalités de paiement</div>
        <div class="article-content">
            <p>Le paiement des frais d'assistance est effectué en deux (02) versements via la plateforme PAPE au moment du téléchargement de la première et de la deuxième partie du document.</p>
        </div>
        
        <div class="article-title">Article 5 : Obligations de CESIE BENIN</div>
        <div class="article-content">
            <p>CESIE BENIN s'engage à :</p>
            <p>
                <span class="list-number">1.</span>
                <span class="list-content">Trouver une structure d'accueil de stage correspondant au profil académique du Stagiaire ;</span>
            </p>
            <p>
                <span class="list-number">2.</span>
                <span class="list-content">Fournir une assistance pour la rédaction du mémoire ou thèse ;</span>
            </p>
            <p>
                <span class="list-number">3.</span>
                <span class="list-content">Respecter la confidentialité des données académiques et personnelles du Stagiaire.</span>
            </p>
        </div>
        
        <div class="article-title">Article 6 : Obligations du Stagiaire</div>
        <div class="article-content">
            <p>Le Stagiaire s'engage à :</p>
            <p>
                <span class="list-number">1.</span>
                <span class="list-content">Respecter le présent contrat, notamment l'obligation d'assistance académique ;</span>
            </p>
            <p>
                <span class="list-number">2.</span>
                <span class="list-content">Régler les frais d'assistance via la plateforme PAPE conformément à l'Article 4 ;</span>
            </p>
            <p>
                <span class="list-number">3.</span>
                <span class="list-content">Fournir à CESIE BENIN, les informations nécessaires pour la réussite du stage et de l'assistance dans la rédaction ;</span>
            </p>
            <p>
                <span class="list-number">4.</span>
                <span class="list-content">Respecter le règlement intérieur de la structure d'accueil de même que les responsables hiérarchiques.</span>
            </p>
        </div>
        
        <div class="article-title">Article 7 : Durée du contrat</div>
        <div class="article-content">
            <p>Le présent contrat prend effet à compter de sa signature et couvre la période de mise en stage et d'assistance jusqu'à la soutenance du mémoire ou de la thèse.</p>
            <p>Après la soutenance, toute demande de service est facturée à nouveau.</p>
        </div>
        
        <div class="article-title">Article 8 : Résiliation</div>
        <div class="article-content">
            <p>En cas de non-respect des obligations du Stagiaire (notamment le paiement), CESIE BENIN se réserve le droit de résilier le présent contrat sans remboursement des sommes déjà versées.</p>
        </div>
        
        <div class="article-title">Article 9 : Règlement des litiges</div>
        <div class="article-content">
            <p>Tout litige relatif à l'interprétation ou l'exécution du présent contrat sera réglé à l'amiable.</p>
            <p>À défaut du règlement à l'amiable, compétence est attribuée aux juridictions territorialement compétentes.</p>
        </div>
        
        <div class="signature-area">
            <div class="signature">
                <p>Fait à Abomey-Calavi, le {{ now()->format('d/m/Y') }}</p>
                <p>Signature du DG CESIE BENIN</p>
            </div>
            <div class="signature">
                <p>&nbsp;</p>
                <p>Signature du Stagiaire</p>
            </div>
        </div>
        
        <div class="footer">
            <p>Siège Social : Abomey-Calavi -- République du Bénin</p>
            <p>Tél : (+229) 01 62 43 59 29 / 01 98 73 63 50. E-mail : contact@cesiebenin.com</p>
        </div>
    </div>
    
 
</body>
</html>