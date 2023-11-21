<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bailey | Digitalisation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<style>
    body{
        font-size: 11px;
    }
    
    html {
        height: 100%;
        margin: 0;
        margin-right: 6;
        margin-left: 6;
    }

    @page {
        /* margin: 85px 25px; */
    }

    header {
        /* position: fixed;
        top: -100px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align: center;
        line-height: 35px; */
    }

    #title{
        margin-bottom: 70px;
    }

    footer {
        position: fixed; 
        bottom: -60px; 
        left: 0px; 
        right: 0px;
        height: 50px; 
        text-align: center;
        line-height: 35px;
    }

    .txt-cntr{
        text-align: center;
    }
    .bold{
        font-weight: bold;
    }
    .container {
        display: table;
        width: 98%;
    }
    .table-row {
        display: table-row;
        height: 100px;
    }
    .table-cell{
        padding: 1em;
        border: solid;
        margin: 6px;
        display: table-cell;
        width: 50%;
    }

    .table-cell1{
        padding: 1em;
        margin: 6px;
        display: table-cell;
        width: 50%;
    }

    .box {
        padding: 1em;
        border: 1px solid #000;
        margin: 2px;
    }
    .inputs{
        color: #2f363cc2;
    }

    label input {
        display: none; 
    }

    label span {
        height: 10px;
        width: 10px;
        border: 1px solid grey;
        display: inline-block;
        position: relative;
    }

    ol.k {
        list-style-type: lower-alpha;
    }

    hr.simple {
        border-top: 1px solid black;
    }

    ul.b {
        list-style-type: square;
    }

    hr.new3 {
        border-top: 1px dashed black !important;
    }

    .txt-tp{
        margin-top: -40px !important;
    }

    #divtwo{
        margin-left: 5% !important;
        background: red;
    }

    .ouifinancchecked{
        margin-top:20px;
    }

    .bg {
        background-image: url("./images/pages/mn3.jpg");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .bd{
        background-image: url("./images/pages/mn4.jpg");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .bh{
        background-image: url("./images/pages/mn1.jpg");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .bn{
        background-image: url("./images/pages/mn2.jpg");
        height: 90%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .sncs{
        padding-top:20px !important;
    }

    .pg{
        font-size: 34px !important;
        padding-top: -20px !important;
    }

</style>

<body>

    <div class="bg"></div>
    <div class="bd"></div>

    <main style="padding:8px !important">
        <h2 class="txt-cntr" id="title">{{ $title }}</h2>
        <p class="txt-cntr txt-tp">En application des Articles L 521-2 et L 521-4 du code des assurances</p>
        <p>Le présent document est établi préalablement à la conclusion d’un contrat d’assurance. Il nous permet de vous communiquer les informations réglementaires 
        inhérentes à notre qualité d’intermédiaire en assurances, la nature de notre intervention et de préciser vos exigences et vos besoins à partir des éléments 
        d’information que vous nous avez communiqués afin de vous accompagner dans le choix de votre contrat d’assurance.</p>
        <hr class="simple">
        <ul>
            <li class="bold"><u>COMMUNICATION D’INFORMATIONS PRECONTRACTUELLES</u></li> 
        </ul>
            </br>
            <div>
                <span class="bold">&nbsp; &nbsp; 1. Présentation de Bailey Assurances</span>
                <p>Bailey Assurances est une société à responsabilité limitée au capital de 10000 € enregistrée au RCS Caen 820 472 553, et son siège social est situé 09 
                chemin des carreaux, 14111 Louvigny.<br/>
                Bailey Assurances a la qualité de société de courtage d’assurance, immatriculée à I’ORIAS sous le no 18 004 781 (www.orias.fr) et distribue des produits 
                d’assurances dont le risque est placé auprès de compagnies d’assurances.</p>
            </div>


            <table style="width:20cm;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size:10px;">
                <tbody>
                    <tr>
                        <td align="center" style="border:1px solid #000;width:10cm;">
                            <span class="boxleft bold txt-cntr">&nbsp; &nbsp; 2. Présentation de votre intermédiaire, partenaire de distribution de BAILEY</span>
                            <p class="txt-cntr">BAILEY Assurances – Mon assurance facture
                            09 chemin des carreaux 14111 Louvigny 
                            (Orias 18 004 781).</p>
                        </td>
                        <td align="center" style="border:1px solid #000;width:10cm;">
                            <span class="boxright bold txt-cntr">&nbsp; &nbsp; 3. Nature de notre intervention</span>
                            <p class="txt-cntr">Pour l’exercice de notre activité, nous ne sommes liés par aucun accord 
                            d’exclusivité  avec  un  ou  plusieurs  assureurs.  En  revanche,  nous  ne 
                            fournissons pas de service de recommandation personnalisée. Notre 
                            analyse repose sur la vérification de la cohérence du contrat proposé avec 
                            vos exigences et besoins.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br/>
            <div>
                <span class="bold">&nbsp; &nbsp; 4. Modalités de rémunération</span>
                <p>Dans le cadre de la commercialisation des contrats d’assurance, nous travaillons sur la base d’une commission, c’est-à-dire une rémunération incluse dans 
                la prime d’assurance du contrat souscrit.</p>
            </div>

            <ul>
                <li class="bold"><u>VOTRE SITUATION</u></li>
            </ul>   
            </br>
            <span class="boxleft bold">&nbsp; &nbsp; 1. Vos informations</span>
            <div class="box">
                <span class="boxleft">Nom : </span> <span class="inputs">{{ $fname }}</span>&nbsp; &nbsp;
                <span class="boxleft">Prénom : </span> <span class="inputs">{{ $lname }}</span>&nbsp; &nbsp;
                <span class="boxleft">Date de naissance : </span> <span class="inputs">{{ $datebird }}</span>&nbsp; &nbsp;
                <span class="boxleft">Adresse: </span> <span class="inputs">{{ $adresse  }}</span>&nbsp; &nbsp;
                <span class="boxleft">Ville : </span> <span class="inputs">{{ $city }}</span>&nbsp; &nbsp;
                <span class="boxleft">CP : </span> <span class="inputs">{{ $cp }}</span>&nbsp; &nbsp;
                <span class="boxleft">Mail : </span> <span class="inputs">{{ $mail }}</span>&nbsp; &nbsp;
                <span class="boxleft">Tel : </span> <span class="inputs">{{ $phone }}</span>
            </div>

            <span class="boxleft bold">&nbsp; &nbsp; 2. Vos besoins</span>
            <p>Cochez la case correspondant à votre situation <br/>
            Souhaitez-vous vous prémunir financièrement en cas de de licenciement économique, cessation d’activité suite à un dépôt de bilan, affectation longue durée (ALD 30 ou ALD 32) ou hospitalisation ? &nbsp; {{new Illuminate\Support\HtmlString($checkfinancementicon)}}</p>

            <p>Etes-vous assurés contre ce type de risques ? &nbsp; {{new Illuminate\Support\HtmlString($checkrisqueicon)}}</p>

            <p>Dans l’affirmative, souhaitez-vous changer de produit et d’assureur ? &nbsp; {{new Illuminate\Support\HtmlString($checkproducticon)}}</p>

            <p>Remarques : {{ $comment }}</p>

            <ul>
                <li class="bold"><u>NOTRE SOLUTION</u></li>
            </ul>

            <p>En fonction des précisions que vous nous avez communiquées sur vos besoins, nous vous proposons le contrat SOUTIEN FINANCIER « MON ASSURANCE 
            FACTURE » conditions générales LPASPH001 — dont le risque est placé auprès de WAKAM, 120-122 rue Réaumur - 75002 Paris Société anonyme : Capital 4 
            514 512 Euros Immatriculée au Registre du Commerce et des Sociétés de Paris sous le n° 562 117 085.<br/>
            Ce contrat vous permet la prise en charge de vos factures de téléphonie, internet, assurance et énergétique (électricité et ou gaz, bois, fuel, etc) pendant 12 
            mois à concurrence de 1 000 € par sinistre et par année en cas de licenciement économique, cessation d’activité suite à un dépôt de bilan, affectation longue 
            durée (ALD 30 ou ALD 32), et également les frais médicaux d’hospitalisation supérieur ou égal à 3 jours, à concurrence de 200€ par événement et par année 
            pour les prises en charge des factures énoncées ci-dessus, ainsi que les factures de ménage, jardinage, transport.</p>
            <span class="boxleft bold txt-cntr">&nbsp; &nbsp; Réclamations et médiation</span>
            <p>Si vous avez une réclamation à formuler quant à la souscription de votre contrat, sa distribution ou la gestion de vos prestations, vous pouvez l’adresser à 
            contact@monassurancefacture.fr ou par courrier à l’adresse suivante BAILEY  Assurances – Mon assurance facture, 09 chemin des carreaux, 14111 Louvigny  
            ou par téléphone au 09.70.17.27.52</p>
            <p>Il sera accusé réception de votre réclamation dans les 48h et le maximum sera fait pour vous apporter une réponse dans un délai maximal de deux mois.</p>
            <p class="sncs">Dans le cas d’un désaccord portant sur l’application ou l’interprétation du présent contrat, et uniquement après communication de notre position définitive, 
            vous pouvez faire appel à La Médiation de l’Assurance — TSA 50110 — 75441 Paris Cedex 09 http://www.mediation-assurance.org. Sera alors mis en place 
            un dispositif gratuit de règlement des litiges dans le but de trouver une solution amiable. En cas d’échec de cette démarche,</p>
            <p>vous conservez naturellement l’intégralité de vos droits à agir en justice. Tout litige relatif à l’application du contrat relève de la seule compétence des tribunaux Français.</p>
        
        <!-- <p class="txt-cntr">En application des Articles L 521-2 et L 521-4 du code des assurances</p> -->
        <p>Le présent document est établi préalablement à la conclusion d’un contrat d’assurance. Il nous permet de vous communiquer les informations réglementaires 
        inhérentes à notre qualité d’intermédiaire en assurances, la nature de notre intervention et de préciser vos exigences et vos besoins à partir des éléments 
        d’information que vous nous avez communiqués afin de vous accompagner dans le choix de votre contrat d’assurance</p>
        <hr class="simple">
        <p>Si vous avez souscrit à distance par Internet, vous pouvez saisir le médiateur compétent en déposant plainte sur la plateforme de la Commission Européenne 
        pour la résolution des litiges accessible à l’adresse suivante : http://ec.europa.eu/consumers/odr</p>
        <p>Par ailleurs, vous pouvez saisir l’Autorité de Contrôle Prudentiel et de Résolution (ACPR) : 4 place de Budapest CS 92459 -75436 Paris Cedex 09 http•]/acpr.
        banque-france.fr/accueil.html</p>
        <span class="boxleft bold txt-cntr">&nbsp; &nbsp; 2. Protection des données personnelles</span>
        <p>Il est précisé que les données personnelles qui figurent ci-dessus font l’objet d’un traitement informatique de la part de BAILEY ASSURANCES, en sa qualité 
        de responsable de traitement.</p>
        <div>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;a. Objet du traitement de données</div>
            <p>Finalités : Les données personnelles collectées sont uniquement utilisées pour l’étude de vos besoins en assurances et vous apporter la meilleure réponse et 
            information sur nos produits en vue de la souscription de votre contrat.<br/>
            Données — RGPD : Ce traitement de données est nécessaire au respect d’une obligation légale à laquelle le responsable du traitement est soumis et à 
            l’exécution des mesures précontractuelles d’information en application du RGPD et de la Loi Informatique et Libertés telle que modifiée.</p>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;b. Destinataires des données</div>
            <p>Vos données sont susceptibles d’être communiquées au personnel habilité de BAILEY ASSURANCES ayant besoin de connaitre de vos données dans le cadre 
            de leurs missions, à ses prestataires informatiques ou de centre d’appels ainsi qu’à ses partenaires courtiers ou assureurs</p>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;c. Durée de conservation des données</div>
            <p>BAILEY ASSURANCES s’engage à conserver vos données personnelles pour une durée n’excédant pas celle nécessaire aux finalités pour lesquelles elles sont 
            traitées et conformément aux durées de conservation imposées par les lois applicables en vigueur.</p>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;d. Les droits concernant vos données</div>
            <p>Conformément au RGPD et à la Loi Informatique et Libertés telle que modifiée, vous bénéficiez : d’un droit d’accès, de rectification, d’effacement, d’opposition, 
            de limitation du traitement, de portabilité des données qui vous concernent, ainsi que du droit de définir des directives relatives à la conservation, l’effacement 
            et à la communication de ces données après votre décès.<br/>
            Vous pouvez exercer ces droits en nous adressant un courrier accompagné d’une pièce d’identité recto-verso à Bailey Assurances, Service client — BAILEY  
            Assurances – Mon assurance facture, 09 chemin des carreaux, 14111 Louvigny. Si vous estimez, après nous avoir contactés, que vos droits sur vos données 
            ne sont pas respectés, vous pouvez adresser une réclamation auprès de la CNIL (3 Place de Fontenoy - TSA 80715 - 75334 PARIS CEDEX 07 ou sur le site de 
            la CNIL www.cnil.fr).</p>
        </div>
        <span class="boxleft bold txt-cntr">&nbsp; &nbsp;  3. Droit de renonciation d'un contrat souscrit dans le cadre d'un démarchage</span>
        <p>Vous pouvez renoncez à votre contrat s’il a été souscrit dans le cadre d’un démarchage au domicile ou sur le lieu de travail dans les conditions de l’article LI 12-9 du Code des assurances.</p>
        <p>Rappel de l’article LI 12-9 du Code des Assurances :<br/>
        Tout e personne phy sique qui fait l’obje t d’un démarchage à son domicile, à sa résidence ou à son lieu   de trav ail, même à sa  demande, et qui signe dans ce cadre une proposition d’assurance ou un contrat à des fins qui n’entrent pas dans le cadre de son activité commerciale ou professionnelle, a la faculté d’y renoncer par lettre recommandée avec demande d’avis de réception pendant le délai de 30 jours calendaires révolus à compter du jour de la conclusion du contrat sans avoir à justifier des motifs ni à supporter de pénalités.</p>
        <p class="bold">En apposant votre signature sur ce document, vous reconnaissez avoir pris connaissance du cont enu duprésent document préalablement à la signature de contrat d’assurance proposé ci-dessus et avoir reçu :</p>
        <dd class="bold">- Le document d’information afférent au contrat d’assurance qui vous est proposé</dd>
        <dd class="bold">- Les conditions générales dudit contrat d’assurance</dd>
        <br/>
        <div class="box">
            <div class="boxleft">Fait à : {{ $city }}</div>
            <div class="boxleft">Le : {{ $date }}</div>
            <div class="boxleft">Signature du client: </div>
            <br/>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1">
                    <h2>MON ASSURANCE FACTURE</h2>
                    <h2>Prise en charge du paiement des factures de
                    téléphonie, internet, assurance, frais médicaux
                    hospitalier et énergétique</h2>
                    <u class="bold">Notice d’information du contrat n° LPASPH001</u>
                    <p>La présente notice regroupe les principales dispositions du contrat collectif n°LPASPH001 souscrit par Sphinx au profit des Assurés souscripteurs d’un contrat de fourniture ou de distribution d’énergie et dont l’Assuré peut demander, à tout moment et sans frais, la communication intégrale.<br/>
                    <u class="bold">Assureur</u><br/>
                    <span class="bold">Wakam S.A.</span><br/>
                    120-122 rue Réaumur - 75002 Paris<br/>
                    Société anonyme : Capital 4 514 512 Euros<br/>
                    Immatriculée au Registre du Commerce et des Sociétés de Paris sous le n° 562 117 085.<br/>
                    Entreprise gérée régie par le Code des assurances et soumise à l’Autorité de Contrôle Prudentiel et de<br/>
                    Résolution (ACPR, 4 Place de Budapest CS 92459, 75436 Paris)</p>

                    <p><u class="bold">Courtier/gestionnaire :</u><br/>
                    <span class="bold">Sphinx Affinity</span><br/>
                    69, route de Montfavet CS 20053 84918 AVIGNON Cedex 9<br/>
                    Société par Actions Simplifiée : Capital 15 000 Euros,<br/>
                    Immatriculée au Registre du Commerce et des Sociétés d’Avignon sous le numéro 512 785 106.Inscrite au Registre National des Intermédiaires : n° 09 051 594<br/>
                    Entreprise gérée régie par le Code des assurances et soumise à l’Autorité de Contrôle Prudentiel et de Résolution (ACPR, 4 Place de Budapest CS 92459, 75436 Paris)</p>

                    <p><u class="bold">Distributeur :</u><br/>
                    <span class="bold">BAILEY Assurances – Mon assurance facture</span><br/>
                    9 chemin des carreaux 14111 Louvigny (Orias 18 004 781)<br/>
                    Immatriculée au Registre du Commerce et des Sociétés de Caen sous le n° 820 472 553.<br/>
                    Entreprise gérée régie par le Code des assurances et soumise à l’Autorité de Contrôle Prudentiel et de Résolution (ACPR, 4 Place de Budapest CS 92459, 75436 Paris)</p>
                    <p class="bold"><u>ARTICLE 1 - DICTIONNAIRE</u></p>
                    <dd class="bold">1 – Définitions relatives aux personnes</dd>
                    <ul class="b">
                        <li class="bold">Assuré</li>
                    </ul>
                    <p>Toute personne physique, domiciliée en France métropolitaine, souscripteur d’un contrat « actif » pour
                    les factures concernées prises en charge, ainsi que le (la) conjoint(e) ayant le même domicile fiscal que
                    l’Assuré. Ce dernier doit obligatoirement être à jour du règlement de ses factures.</p>
                    <dd class="bold">2 – Définitions relatives aux garanties</dd>
                    <ul class="b">
                        <li class="bold">Cessation d’activité suite à dépôt de bilan</li>
                    </ul>
                    <p>Cessation de toute activité de l’entreprise suite à un dépôt de bilan constaté par un jugement du Tribunal
                    de Commerce.</p>
                    <ul class="b">
                        <li class="bold">Licenciement économique :</li>
                    </ul>
                    <p>Cessation de toute activité professionnelle, imposée par l’employeur suite à un licenciement économique,
                    et confirmée par un courrier recommandé.</p>
                    <ul class="b">
                        <li class="bold"> Affections de longues durées ALD-30</li>
                    </ul>
                    <p>Affections, dont la gravité et/ou le caractère chronique nécessitent un traitement prolongé et une
                    thérapeutique particulièrement coûteuse, inscrites sur la liste des 30 Affections de Longue Durée (ALD-
                    30) établie par décret et définie par le Code de la Sécurité Sociale. L’Affection de Longue Durée ALD- 30
                    doit être constatée par le médecin traitant et reconnue par le médecin conseil de la Caisse d’Assurance
                    Maladie au cours de la période de garantie</p>
                    <ul class="b">
                        <li class="bold">Polypathologies ALD-32 :</li>
                    </ul>
                    <p>Le terme « polypathologies » est employé en cas d’atteinte par plusieurs affections caractérisées,
                    entraînant un état pathologique invalidant et nécessitant des soins continus d’une durée prévisible
                    supérieure à 6 mois. L’état de polypathologies ALD-32 doit être constaté par le médecin traitant et reconnu
                    par le médecin conseil de la Caisse d’Assurance Maladie au cours de la période de garantie.</p>
                    <ul class="b">
                        <li class="bold">Délai de carence</li>
                    </ul>
                    <p>Période de trois (3) mois, décomptée à partir de la date de réalisation de l’un des risques susvisés, pendant
                    laquelle le versement de l’indemnité ne peut avoir lieu.</p>
                    <ul class="b">
                        <li class="bold">Hospitalisation </li>
                    </ul>
                    <p>Prise en charge et/ou séjour d’un individu dans un hôpital public ou une clinique privée (conventionnée ou
                    non). Suite à son admission pour accident ou maladie, il deviendra alors un patient du centre hospitalier..</p>
                </div>
                <div class="table-cell1">
                   
                    
                    <p class="bold"><u>ARTICLE 2 - GARANTIES ACCORDEES</u></p>
                    <dd class="bold">1 – Objet, montant et limite de la garantie</dd>

                    <p>Suite à la réalisation de l’un des risques suivants :<br/>
                    - licenciement économique,<br/>
                    - cessation d’activité suite à dépôt de bilan,<br/>
                    - affections de longues durées (ALD-30) ou polypathologies (ALD-32),<br/>
                    nous prenons en charge 12 mois de factures de téléphonie, internet, assurances, et énergétique (électricité
                    et/ou gaz, bois, fuel, etc) comprenant la part « abonnement » et la part « consommation », sur la base de
                    l’offre souscrite par l’Assuré auprès de son fournisseur,<span class="bold"> dans la limite de 1.000,00 €uros par sinistre et
                    par année d’assurance.</span></p>
                    <p>Suite à la réalisation du risque d’hospitalisation (raison médicale ou chirurgicale) d’une durée supérieur
                    ou égale à 3 jours, nous versons une indemnité destinée à couvrir les frais complémentaires liés à
                    l’hospitalisation (transport taxi, personne à domicile pour le ménage, le jardinage, factures de téléphonie,
                    internet, assurances, et énergétique du mois de l’hospitalisation, supplément chambre individuel, frais de
                    location télé, téléphone durant l’hospitalisation,etc) <p class="bold">de 200 € (deux cent euros) euros.</span></p>
                    <p>La cessation de l’activité professionnelle ou l’état pathologique ouvrant droit à garantie doivent toujours
                    être constatés pendant la période de garantie et à l’issue du délai de carence de trois mois précité.</p>
                    <dd class="bold">2 – Effet et durée de la garantie</dd>

                    <u>o Prise d’effet de la garantie</u>
                    <p>La garantie est subordonnée à l’existence d’un contrat « actif » pour les factures concernées prises
                    en charge, en cours de validité au jour de l’événement. Elle est acquise à l’Assuré après réception du
                    règlement de la prime.</p>
                    <u>o Durée de la garantie</u>
                    <p>La garantie est souscrite pour une durée de 12 MOIS à partir de sa date d’effet. Elle est ensuite reconduite
                    automatiquement d’année en année, sauf dénonciation par l’envoi d’une lettre recommandée ou par une
                    déclaration verbale contre récépissé moyennant un préavis de DEUX MOIS (le cachet de la poste faisant
                    foi). La résiliation devient effective à la prochaine échéance anniversaire..</p>
                
                    <dd class="bold">3 – Exclusions</dd>
                    <p class="bold">AUCUNE GARANTIE NE POURRA ÊTRE DÉLIVRÉE A L’ASSURE :<br/>
                    o EN CAS DE SUSPENSION OU RÉSILIATION DU CONTRAT POUR LES FACTURES CONCERNÉES<br/>
                    o PRISES EN CHARGE,<br/>
                    o EN CAS DE NON RÉGULARISATION DES PRIMES ÉMISES AU TITRE DU PRÉSENT CONTRAT,<br/>
                    o EN CAS DE NON JUSTIFICATION PAR L’EMPLOYEUR D’UN LICENCIEMENT ECONOMIQUE,<br/>
                    o EN CAS DE FAILLITE FRAUDULEUSE,<br/>
                    o EN CAS D’ABSENCE DE JUGEMENT DE DÉPÔT DE BILAN DE LA SOCIÉTÉ RENDU PAR LE
                    TRIBUNAL DE COMMERCE,<br/>
                    o EN CAS DE NON-CLASSIFICATION EN AFFECTIONS DE LONGUE DUREE (ALD-30) OU
                    POLYPATHOLOGIES (ALD-32) PAR LA CAISSE D’ASSURANCE MALADIE,<br/>
                    o EN CAS D’AFFECTIONS DE LONGUES DUREES OU POLYPATHOLOGIE DONT LES CAUSES SON
                    ANTERIEURES A L’AHDHESION,<br/>
                    o EN CAS DE SINSITRE CAUSE OU PROVOQUE INTENTIONNELLEMENT PAR L’ASSURE OU LE
                    BENEFICIAIRE DU PRESENT CONTRAT,<br/>
                    o EN CAS DE SINSITRE RESULTANT D’UN ACTE DE DEMENCE, D’UNE DEPRESSION NERVEUSE
                    OU DE TOUTE AUTRE AFFECTION PSYCHOPATHOLOGIQUE,<br/>
                    o EN CAS DE SINSITRE RESULTANT DE LA PRATIQUE D’UN SPORT EN TANT QUE PROFESSIONNEL
                    Y COMPRIS LORS DES ENTRAÎNEMENTS</p>
                    <p class="bold">o EN CAS DE SINISTRE PROVOQUE PAR LA GUERRE CIVILE OU ETRANGERE (QUE LA GUERRE
                    AIT ETE DECLAREE OU NON), OU UN ATTENTAT</p>
                   <p class="bold">AUCUNE GARANTIE NE SERA FOURNIE AU TITRE DE LA PRESENTE POLICE POUR TOUTE
                    RECLAMATION, SINISTRE, COUT OU DEPENSE DE QUELQUE NATURE QUE CE SOIT DECOULANT
                    ET/OU RESULTANT DU CORONAVIRUS (COVID-19) ET/OU DU SYNDROME RESPIRATOIRE AIGU
                    SEVERE CORONAVIRUS 2 (SARS-CoV-2), ET/OU DE TOUTE MUTATION OU VARIATION DE CEUX-CI.
                    AUCUNE GARANTIE NE SERA FOURNIE AU TITRE DE LA PRESENTE POLICE POUR TOUTE
                    RECLAMATION, SINISTRE, COUT OU DEPENSE DE QUELQUE NATURE QUE CE SOIT DECOULANT
                    ET/OU RESULTANT DE DECISIONS ADMINISTRATIVES, GOUVERNEMENTALES OU JUDICIAIRES
                    AYANT POUR OBJET DE LUTTER CONTRE LES EFFETS DE PROPAGATION D’UNE EPIDEMIE OU
                    D’UNE PANDEMIE.</p>
                    <p class="bold"><u>ARTICLE 3 - SINISTRES</u></p>
                    <p>1- L’Assuré doit fournir au GESTIONNAIRE dès la découverte du sinistre:</p>
                    <p><span class="bold">a)</span> <u>suite à un licenciement économique :</u></span></p>
                </div>
            </div>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1">
                    <p>- une copie du courrier recommandé de l’employeur faisant état du licenciement économique,<br/>
                    - une copie de l’attestation Pôle Emploi de rupture du contrat de travail (émise par l’employeur),<br/>
                    - une copie de l’attestation d’inscription au Pôle Emploi en tant que demandeur d’emploi,<br/>
                    - un relevé de situation Pôle Emploi émis à l’issue du délai de carence de 3 mois.</p>
                    <p><span class="bold">b)</span> <u>suite à un dépôt de bilan de l’activité professionnelle :</u></span></p>
                    <p>- une copie du jugement du Tribunal de Commerce indiquant le dépôt de bilan avec cessation d’activité,<br/>
                    - une copie de l’attestation d’inscription au Pôle Emploi en tant que demandeur d’emploi,<br/>
                    - un relevé de situation Pôle Emploi émis à l’issue du délai de carence de 3 mois.</p>
                    <p><span class="bold">c)</span> <u>suite à une maladie déclarée en affections de longue durée ou polypathologies :</u></span></p>
                    <p>- une copie du protocole de soins établi par le médecin traitant et validé par le médecin conseil de la
                    Caisse d’Assurance Maladie indiquant les dates de début de la maladie et de reconnaissance par le corps
                    médical en Affections de Longue Durée (ALD-30) ou en polyathologies (ALD-32),<br/>
                    - une copie de l’attestation de droits à l’assurance maladie mentionnant la prise en charge à 100% pour
                    affections de longue durée ou polypathologies.</p>
                    <p><span class="bold">d)</span> <u>suite à une hospitalisation supérieure ou égale à 3 jours :</u></span></p>
                    <p>- une copie du bulletin de situation ou d’hospitalisation,<br/>
                    - une copie du récapitulatif ou compte rendu d’hospitalisation,<br/>
                    - une copie du bon de sortie.</p>
                    <p>2-  Toute demande de prise en charge devra être accompagnée de l’échéancier de règlement des factures
                    d’énergie émis par le fournisseur avant la date du sinistre, des quittances d’assurances, des factures
                    d’abonnement à internet ou de téléphonie ; et indiquera les montants à régler au cours des 12 mois
                    suivants.</p>
                    <p>3-  LE GESTIONNAIRE/ L’ASSUREUR effectuera le règlement par subrogation au fournisseur concerné
                    qui s’engage à créditer le compte du contrat conclu par l’Assuré et auquel la présente garantie se rattache.
                    L’imputation de ce crédit commence à la date où la facture à échoir acquittée par l’Assuré au moment
                    du sinistre cesse ses effets, soit au prochain terme en cas de fractionnements annuel, semestriel ou
                    trimestriel, soit encore au prochain prélèvement à émettre en cas de fractionnement mensuel. Ce crédit
                    ne peut par conséquent ni donner lieu à ristourne sur une facture déjà réglée, ni servir à compenser une
                    facture impayée antérieure à la date du sinistre.</p>

                    <p class="bold"><u>ARTICLE 4 -  EXAMEN DES RECLAMATIONS</u></p>
                    <p>En cas de difficultés dans l’application des dispositions du présent contrat, contactez LE DISTRIBUTEUR :
                    <span class="bold"><u>BAILEY Assurances – Mon assurance facture, par courrier électronique contact@monassurancefacture.
                    fr ou courrier ou par téléphone au 09.70.17.27.52</u></span> <br/>
                    ou bien LE GESTIONNAIRE : SPHINX Affinity par
                    courrier : 69, route de Montfavet, CS 20053 84918 AVIGNON Cedex 9. Vous recevrez un accusé de
                    réception sous 10 jours ouvrables maximum. Vous serez tenu informé de l’avancement de l’examen de
                    votre situation, et recevrez, sauf exception, une réponse au plus tard dans les deux mois qui suivent la
                    réception de votre réclamation. Si votre mécontentement persiste, ou si ces échanges ne vous donnent
                    pas satisfaction, vous pouvez solliciter directement le service RECLAMATION DE L’ASSUREUR par
                    courrier : Wakam, Service Réclamations, 120 – 122 rue Réaumur, TSA 60235, 75083 PARIS CEDEX 02.
                    Wakam s’engage à accuser réception de votre correspondance dans un délai de 10 jours ouvrables (sauf
                    si Wakam vous a déjà apporté une réponse au cours de ce délai), et à traiter votre réclamation dans un
                    délai maximal de 60 jours ouvrables à compter de la réception de votre courrier. Après épuisement des
                    procédures internes de réclamations propres à Wakam, vous pouvez saisir par écrit le Médiateur de la
                    Fédération Française de l’Assurance (FFA) : Soit directement sur le site du médiateur de l’assurance:<br/>
                    http://www.mediation-assurance.org/Saisir+le+mediateur,<br/>
                    Soit par courrier à l’adresse suivante :<br/>
                    La Médiation de l’Assurance<br/>
                    TSA 50 110<br/>
                    75441 Paris cedex 09</p>
                    <p>Le Médiateur est une personnalité extérieure à Wakam qui exerce sa mission en toute indépendance. Ce
                    recours est gratuit. Il rend un avis motivé dans les 3 mois qui suivent sa saisine.<br/>
                    La procédure de recours au médiateur et la « Charte de la médiation » de la FFA sont librement
                    consultables sur le site :<br/>
                    www.ffa-assurance.fr.</p>
                    <p>Pour l’ensemble des offres « dématérialisées » vous avez également la possibilité d’utiliser la plateforme
                    de Résolutions des Litiges en Ligne de la Commission Européenne au lien suivant : http://ec.europa.eu/
                    consumers/odr/</p>
                    <p class="bold"><u>ARTICLE 5 - LOI INFORMATIQUE ET LIBERTES</u></p>
                    <p>L’Assureur est le responsable du traitement des données personnelles que l’Assuré a communiqué à
                    l’Assureur ou à ses mandataires (par téléphone, messagerie électronique ou autrement) pour les besoins
                    de la Garantie et sont nécessaires pour les traitements informatiques liés à la gestion de son contrat d’assurance et peuvent être également 
                </div>
                <div class="table-cell1 sncs">           
                    utilisées, sauf opposition de sa part, à des fins commerciales.
                    Ces données personnelles peuvent également faire l’objet de traitements spécifiques et d’informations
                    aux autorités publiques compétentes dans le cadre des dispositions législatives et réglementaires en
                    vigueur notamment relatives à la lutte contre le blanchiment et le financement du terrorisme. Les mêmes
                    données personnelles pourront être enregistrées à des fins de formation du personnel de l’Assureur et
                    de ses mandataires dans le cadre de la gestion des sinistres de l’Assuré. Elles pourront être utilisées par
                    les mandataires de l’Assureur, ses réassureurs, ses partenaires et organismes professionnels. L’Assuré
                    dispose d’un droit d’accès, de rectification, de modification, de suppression et d’opposition sur les données
                    personnelles le concernant qu’il peut exercer en contactant le Directeur de la Protection des données via
                    l’adresse suivante : dpo@Wakam.com.</p>

                    <p class="bold"><u>ARTICLE 6 - PRESCRIPTION</u></p>
                    <p>Toute action relative à l’application du présent contrat se prescrit par deux ans à compter de
                    l’évènement qui y donne naissance conformément aux articles L114-1, L114-2 et L114-3 du Code
                    des Assurances ci-dessous reproduits. La prescription peut être interrompue par une des causes
                    ordinaires d’interruption : toute demande en justice, même en référé, tout acte d’exécution forcée,
                    toute reconnaissance par l’Assureur du droit à garantir l’Assuré ou toute reconnaissance de dette de
                    l’Assuré envers l’Assureur. Elle est également interrompue par la désignation d’un expert à la suite
                    d’un sinistre, par l’envoi d’une lettre recommandée avec accusé de réception adressée par l’Assureur
                    à l’Assuré en ce qui concerne l’action en paiement de la cotisation, par l’Assuré à l’Assureur en ce qui
                    concerne le règlement de l’indemnité.<br/>
                    Article L114-1 du Code des Assurances : toutes actions dérivant d’un contrat d’assurance sont
                    prescrites par deux ans à compter de l’évènement qui y donne naissance. Toutefois, ce délai ne
                    court :<br/>
                    1) en cas de réticence, omission, déclaration fausse ou inexacte sur le risque couru, que du jour où
                    l’Assureur en a eu connaissance<br/>
                    2) en cas de sinistre, que du jour où les intéressés en ont eu connaissance, s’ils prouvent qu’ils
                    l’ont ignoré jusque-là. Quand l’action de l’Assuré contre l’Assureur a pour cause le recours d’un
                    tiers, le délai de la prescription ne court que du jour où ce tiers a exercé une action en justice contre
                    l’Assuré ou a été indemnisé par ce dernier. Article L114-2 du Code des Assurances :</p>
                    <p>la prescription est interrompue par une des causes ordinaires d’interruption de la prescription et par la désignation
                    d’experts à la suite d’un sinistre. L’interruption de la prescription de l’action peut, en outre, résulter
                    de l’envoi d’une lettre recommandée avec accusé de réception adressée par l’Assureur à l’Assuré en
                    ce qui concerne l’action en paiement de la cotisation, par l’Assuré à l’Assureur en ce qui concerne le
                    règlement de l’indemnité. Article L114-3 du Code des Assurances : par dérogation à l’article 2254 du
                    Code Civil, les parties au contrat d’assurance ne peuvent, même d’un commun accord, ni modifier la
                    durée de la prescription, ni ajouter aux causes de suspension ou d’interruption de celle-ci.</p>
                    <p class="bold"><u>ARTICLE 7 - Traitement de vos Données personnelles</u></p>
                    <p>Nous contacter</p>
                    <p>Pour toute question ou renseignement relatif à l’utilisation de vos données personnelles, ou pour
                    exercer vos droits relatifs à ces données personnelles, veuillez contacter notre Délégué à la
                    Protection des Données à l’adresse suivante :</p>
                    <p>Délégué à la Protection des Données,<br/>
                    Wakam<br/>
                    120-122 rue Réaumur<br/>
                    75002 Paris, France</p>
                    <p>Ou par courriel à : dpo@Wakam.com</p>
                    <p>Dans le cadre des services et produits que Wakam et ses partenaires (ensemble « nous », « notre »,
                    « nos ») vous fournissent, vous êtes amenés à communiquer des données à caractère personnel
                    (« données personnelles » ou « données ») vous concernant. Cette Notice d’information est mise
                    à votre disposition afin de mieux comprendre comment nous collectons, traitons et protégeons ces
                    données personnelles.</p>
                    <p>Nous nous engageons à respecter les dispositions relatives à la protection des données à caractère
                    personnel en vigueur, et en particulier le Règlement (UE) 2016/679 du Parlement européen et du
                    Conseil du 27 avril 2016 relatif à la protection des personnes physiques à l’égard du traitement des
                    données à caractère personnel et à la libre circulation de ces données, et abrogeant la directive
                    95/46/CE (règlement général sur la protection des données), ainsi que la Loi n°78-17 du 6 janvier
                    1978 relative à l’informatique, aux fichiers et aux libertés, modifiée (ensemble « la Réglementation
                    relative à la protection des données »).</p>
                    <p>Qui sommes-nous ?</p>
                    <p>Wakam est une société anonyme au capital social de 4 514 512 €, immatriculée au Registre du
                    commerce et des sociétés de Paris sous le n° 562 117 085 dont le siège social est situé 120-122 rue
                    Réaumur, 75002 Paris, France.<br/>
                    Catégories de données personnelles collectées<br/>
                    Dans le cadre de la fourniture de nos produits et services, nous pouvons recueillir et utiliser des
                    données personnelles vous concernant, telles que :<br/>
                    &nbsp; &nbsp; · Informations relatives à votre identité (nom, prénoms, adresse postale, numéro de
                    téléphone, adresse e-mail…)<br/>
                    &nbsp; &nbsp; · Informations relatives au titulaire de la police d’assurance (numéro de police d’assurance,
                    numéro de compte bancaire, données de carte de paiement, facturation, historique de paiement…)<br/>
                </div>
            </div>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1 sncs">  
                    &nbsp; &nbsp; · Informations relatives aux réclamations (numéro de réclamation, date et motif de la perte,
                    historique des appels, détails de la perte, numéro de référence de la police et documents supports…)<br/>
                    &nbsp; &nbsp; · Informations sur les factures d’énergie (fournisseur, montant, contrat souscrit,
                    consommation)<br/>
                    &nbsp; &nbsp; · Informations sur le travail de l’assuré (nom de la société, éventuel licenciement,
                    informations sur la cessation d’activité…)</p>
                    <p>Dans le cadre du traitement de ces données, nous pouvons être amenés à collecter des données
                    relatives aux infractions, condamnations et mesures de sûreté, au moment de votre souscription au contrat d’assurance, en cours d’exécution de ce contrat ou dans le cadre de la gestion d’un
                    contentieux.<br/>
                    Certains de nos produits peuvent impliquer le traitement de données personnelles dites « sensibles »,
                    telles que des données de santé. Ces données seront traitées uniquement dans le but de respecter
                    nos engagements envers vous et dans le strict respect des dispositions légales applicables à ces
                    données.</p>
                    <p>Vous pouvez choisir de nous fournir ou non ces données. Il se peut que nous ne soyons pas en
                    mesure de vous fournir des produits ou services spécifiques si vous ne nous fournissez pas certaines
                    données.</p>
                    <p>Pourquoi nous traitons vos données personnelles</p>
                    <p>Vos données personnelles sont utilisées pour les finalités suivantes :<br/>
                    &nbsp; &nbsp; · La gestion de votre contrat et police d’assurance, l’exécution des garanties du contrat (y
                    compris la gestion de sinistres) et la gestion des réclamations et des contentieux, ces traitements
                    étant nécessaires à l’exécution de votre contrat ;<br/>
                    &nbsp; &nbsp; · Le contrôle et la surveillance des risques, cela nous permettant de prévenir les activités
                    frauduleuses et d’assurer le recouvrement des sommes dues et étant donc nécessaire aux fins de
                    nos intérêts légitimes ;<br/>
                    &nbsp; &nbsp; · L’élaboration de statistiques et d’études actuarielles, cela nous permettant d’améliorer les
                    offres et services proposés et étant donc nécessaire aux fins de nos intérêts légitimes ;<br/>
                    &nbsp; &nbsp; · La lutte contre la fraude à l’assurance et la lutte contre le blanchiment d’argent afin de
                    nous conformer à nos obligations légales.</p>
                    <p>Divulgation de vos données personnelles</p>
                    <p>Vos données personnelles peuvent être divulguées aux tiers suivants :<br/>
                    &nbsp; &nbsp; · Aux sociétés de notre groupe telles que notre maison mère et les sociétés qui lui sont
                    affiliées ;<br/>
                    &nbsp; &nbsp; · A nos prestataires de services et sous-traitants, pour les besoins de la gestion et
                    l’exécution de votre contrat ;<br/>
                    &nbsp; &nbsp; · A d’autres compagnies d’assurance (intermédiaires, réassureurs) ;<br/>
                    &nbsp; &nbsp; · Aux autorités publiques, afin de prévenir ou détecter la fraude ou toute autre activité
                    criminelle et afin de satisfaire à nos obligations légales et réglementaires.</p>
                    <p>Transferts internationaux de vos données personnelles</p>
                </div>
                <div class="table-cell1 aze">                 
                    <p>Nous pouvons être amenés à transférer vos données personnelles en dehors de l’Union Européenne,
                    notamment dans des pays n’étant pas considérés comme fournissant un niveau de protection suffisant
                    selon la Commission européenne. Afin d’assurer un niveau de sécurité adéquat, ces transferts
                    seront encadrés par les clauses contractuelles types établies par la Commission européenne, ou
                    par d’autres garanties appropriées conformément à la Règlementation relative à la protection des
                    données.</p>
                    <p>Durée de conservation de vos données personnelles</p>
                    <p>Vos données personnelles seront conservées pour la durée strictement nécessaire à la fourniture
                    du service et à l’exécution du contrat, et selon notre politique de conservation des données. Ces
                    données personnelles pourront également être conservées pour toute durée additionnelle requise ou
                    autorisée par les dispositions légales applicables, cela incluant les durées de prescription auxquelles
                    nous sommes soumises.</p>
                    <p>Vos droits</p>
                    <p>Conformément à la Réglementation relative à la protection des données, vous disposez d’un droit
                    d’accès, de rectification, d’effacement, de limitation, d’opposition, de portabilité de vos données
                    personnelles, de ne pas faire l’objet d’une décision automatisée (y compris le profilage), ainsi que
                    du droit de donner des directives relatives au sort de vos données personnelles après votre décès.
                    Veuillez noter que l’exercice de ces droits n’est cependant pas absolu et est soumis aux limitations
                    prévues par la loi applicable.</p>
                    <p>Si vous estimez que le traitement de vos données personnelles constitue une violation de la
                    Réglementation relative à la protection des données, vous avez également le droit d’introduire
                    une réclamation auprès de la Commission Nationale de l’Informatique et des Libertés, à l’adresse
                    suivante : CNIL – 3 Place de Fontenoy – TSA 80715 – 75334 PARIS CEDEX 07.</p>
                    <p>Pour obtenir une copie de vos données personnelles que nous détenons, pour plus de renseignements
                    ou pour exercer vos droits relatifs à vos données personnelles, veuillez nous contacter à l’adresse ou
                    courriel indiqué dans la section ci-dessus.</p>
                    <p>(*) Rappel de l’article L112-9 du Code des Assurances (Modifié par Ordonnance n°2017-1433 du
                    4 octobre 2017 - art. 2)</p>
                    <p>Toute personne physique qui fait l’objet d’un démarchage à son domicile, à sa résidence ou à son lieu
                    de travail, même à sa demande, et qui signe dans ce cadre une proposition d’assurance ou un contrat
                    à des fins qui n’entrent pas dans le cadre de son activité commerciale ou professionnelle, a la faculté
                    d’y renoncer par lettre recommandée ou par envoi recommandé électronique avec demande d’avis
                    de réception pendant le délai de 30 jours calendaires révolus à compter du jour de la conclusion du
                    contrat sans avoir à justifier des motifs ni à supporter de pénalités.</p>

                </div>
            </div>
        </div>

        <div>
            <h3 class="bold txt-cntr"><u>I M P O R T A N T</u></h3>
            <ul>
                <li class="bold">SI L’ASSURE NE RESPECTE PAS LES DELAIS OU NE SE SOUMET PAS A CES OBLIGATIONS, IL POURRA ETRE DECHU DE TOUT DROIT A
                INDEMNITE POUR CE SINISTRE ET/OU LITIGE SI NOUS POUVONS APPORTER LA PREUVE QUE LE NON-RESPECT DE CETTE OBLIGATION
                NOUS A FAIT SUBIR UN PREJUDICE.</li></br>
                <li class="bold">TOUTE DECLARATION INEXACTE, TOUTE RETICENCE OU OMISSION VOLONTAIRE QUANT AUX FAITS AYANT DONNE NAISSANCE AU LITIGE
                ET/OU SINISTRE OU QUANT AUX ELEMENTS POUVANT SERVIR A SA SOLUTION ENTRAINE LA DECHEANCE DU DROIT A GARANTIE POUR
                LE LITIGE ET/OU LE SINISTRE CONSIDERE.</li></br>
                <li class="bold">DANS LE CAS OU IL S’AVERERAIT QUE NOUS AURIONS ETE AMENES A DECLENCHER NOS GARANTIES ALORS QUE LE BENEFICIAIRE
                N’ETAIT PLUS OU PAS ASSURE, LES FRAIS ENGAGES LUI SERAIENT INTEGRALEMENT REFACTURES, DE MEME S’IL AVAIT VOLONTAIREMENT
                FOURNI DE FAUSSES INFORMATIONS SUR LES CAUSES L’AMENANT A DEMANDER NOTRE INTERVENTION.</li></br>
            </ul>
        <br/>
        <hr class="new3">      

        <table style="width:20cm;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size:10px;">
            <tbody>
                <tr>
                    <td align="center" style="width:10cm;">
                        <p>Je soussigné(e), déclare renoncer à l’offre «Mon Assurance Facture».</p>
                        <p>Conditions : à renvoyer au plus tard 30 jours calendaires après la date de conclusion
                        du contrat par lettre recommandée avec accusé de réception à l’intermediaire en
                        assurance : Bailey Assurances, 9 chemin des carreaux, 14111 Louvigny.
                        Cette rétractation n’est valable que si elle adressée dans le délai mentionné
                        ci-dessus, lisiblement, parfaitement remplie et signée.</p>

                        @if(!empty($textselected))
                            @foreach ($textselected as $article)
                                <div> &nbsp; &nbsp;&nbsp; &nbsp;<label>
                                        {{$article}}<img src="./images/pages/checked.png" id="ouifinancchecked" style="display:none; margin-bottom:-5px; margin-left:8px;" width="15px" height="15px">
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td align="center" style="width:10cm;">
                        <p><span>Nom du Client : {{ $fname }} {{ $lname }}</span></p>
                        <p><span>Adresse : {{ $adresse  }}</span></p>
                        <p><span>Code Postal : {{ $cp }}</span> <span>Ville : {{ $city }}</span></p>
                        <p><span>Date contrat : {{ $date }}</span></p>
                        <p><span>Signature du client : </span></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

    <div class="bh"></div>
    <div class="bn"></div>
    
    <p class="txt-cntr pg"><u>Le code est </u>: {{ $code }}</p>
</body>
</html>