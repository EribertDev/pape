<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Contrat de Stage Académique</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 16px; font-weight: bold; }
        .header p { margin: 3px 0; font-size: 12px; }
        .content { margin: 20px; }
        .info { margin-bottom: 20px; }
        .info p { margin: 5px 0; }
        .signature { margin-top: 50px; }
        .signature p { margin: 5px 0; }
        .footer { margin-top: 100px; text-align: center; font-size: 10px; }
        .two-columns { display: flex; justify-content: space-between; }
        .column { width: 45%; }
        .text-center { text-align: center; }
        .text-underline { text-decoration: underline; }
        .mt-40 { margin-top: 40px;
        margin-bottom: 30px }
        .mb-0 { margin-bottom: 0; }
        .mt-0 { margin-top: 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPUBLIQUE DU BENIN</h1>
        <h2>CABINET D’EXPERTISES STATISTIQUE INFORMATIQUE ET EPIDEMIOLOGIQUE</h2>
        <p>PRESTATIONS INTELLECTUELLES, MATERIELS ET MOBILIERS DE BUREAUX</p>
        <p>TEL: (+229) 62 43 59 29/98 73 63 50 Site internet: www.cesiebenin.com</p>
    </div>

    <div class="text-center">
        <h3>N° ______ CESIE/SG/SA    Abomey-Calavi le {{ now()->format('d/m/Y') }}</h3>
    </div>

    <div class="content">
        
        
        <p><strong>Objet :</strong> Contrat de Stage Académique</p>
        
        <div class="info">
            <p>Entre le Cabinet d'Expertises Statistique Informatique et Epidémiologique (CESIE), représenté par son Directeur Général, M. Franck Medegnonblo, d'une part,</p>
            
            <p>Et l'étudiant(e) :</p>
            <p><strong>Nom :</strong> {{$student }}</p>
            <p><strong>Université :</strong> {{ $university }}</p>
            <p><strong>Niveau :</strong> {{ $level }}</p>
            @if($binome)
            <p>En binôme avec :</p>
            <p><strong>Nom :</strong> {{ $binome }}</p>
            @endif
            <p><strong>Durée :</strong> {{ $duration }} mois</p>
            <p>d'autre part,</p>
        </div>
        
        <p>Il est convenu ce qui suit :</p>
        
        <p><strong>Article 1 : Objet du stage</strong></p>
        <p>Le présent contrat a pour objet de définir les conditions dans lesquelles le stage sera effectué par l'étudiant(e) susnommé(e) au sein de la structure d'accueil.</p>
        
        <p><strong>Article 2 : Missions</strong></p>
        <p>L'étudiant(e) se verra confier des missions en rapport avec son domaine de formation, notamment [préciser les missions si possible].</p>
        
        <p><strong>Article 3 : Engagements de la structure d'accueil</strong></p>
        <p>La structure d'accueil s'engage à fournir un encadrement professionnel et à mettre à disposition les moyens nécessaires à la bonne exécution du stage.</p>
        
        <p><strong>Article 4 : Engagements du stagiaire</strong></p>
        <p>Le stagiaire s'engage à respecter le règlement intérieur de la structure d'accueil et à effectuer son stage avec sérieux et assiduité.</p>
        
        <p><strong>Article 5 : Confidentialité</strong></p>
        <p>Le stagiaire est tenu à la confidentialité concernant les informations dont il aura connaissance durant son stage.</p>
        
        <p><strong>Article 6 : Gratification</strong></p>
        <p>Le stage est effectué à titre gracieux, sans contrepartie financière, conformément à la réglementation en vigueur.</p>
        
        <div class="signature two-columns">
            <div class="column">
               
                <p class="mt-40">Le Directeur Général</p>
                <p>Signature</p>
            </div>
            <div class="column">
                <p>Le(s) Stagiaire(s),</p>
                <p class="mt-40">{{ $student }}</p>
                <p>Signature</p>
                @if($binome)
                <p class="mt-40">{{ $binome }}</p>
                <p>Signature</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>CESIE - Siège Social: Abomey-Calavi, - Bénin</p>
        <p class="mt-0">Tél: (+229) 62 43 59 29/98 73 63 50 - Email: contact@cesiebenin.com</p>
    </div>
</body>
</html>