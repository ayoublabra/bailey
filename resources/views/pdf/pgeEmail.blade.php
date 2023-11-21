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

    .topdiv{
        border: 1px solid #0000FF;
        border-radius:50px;
        padding:4px;
        color : #0052CC;
    }

    .txtblue{
        color : #0052CC;
    }

    .txtgray{
        color : gray;
    }

    .chx {
        vertical-align: text-bottom;
    }

    .radiudiv{
        border-radius:30px !important;
        margin-top: 10px;
        border: 1px solid grey !important;
    }

    .styledzone{
        border-radius: 10%;
        border: 1px solid grey !important;
    }

    input[type=checkbox]{
        height: 15px;width:15px;
        margin-bottom: 7px;
        /* border:1px solid black; */
    }
</style>

<body>

    <!-- <header>
        <h2 class="txt-cntr" id="title">{{ $title }}</h2>
    </header> -->

    <!-- <footer>
        Bailey &copy; <?php echo date("Y");?> 
    </footer> -->
    
    <main>
        <div><img src="./images/pages/empge1.jpg" width="620px" height="1000px"></div>
        <div><img src="./images/pages/empge2.jpg" width="620px" height="1000px"></div>

        <h2 class="txt-cntr" id="title">{{ $title }}</h2>
        <p class="txt-cntr txt-tp">En application des Articles L 521-2 et L 521-4 du code des assurances</p>
        <p>Le présent document est établi préalablement à la conclusion d’un contrat d’assurance. Il nous permet de vous communiquer les informations réglementaires
        inhérentes à notre qualité d’intermédiaire en assurances, la nature de notre intervention et de préciser vos exigences et vos besoins à partir des éléments
        d’information que vous nous avez communiqués afin de vous accompagner dans le choix de votre contrat d’assurance.</p>
        <hr class="simple">
        <ul>
            <li class="bold"><u>COMMUNICATION D’INFORMATIONS PRECONTRACTUELLES</u></li> 
        </u>
            </br>
            <div>
                <span class="bold">&nbsp; &nbsp; 1. Présentation de Bailey Assurances</span>
                <p>Bailey Assurances est une société à responsabilité limitée au capital de 10000 € enregistrée au RCS Caen 820 472 553, et son siège social est situé 09 
                chemin des carreaux, 14111 Louvigny.<br/>
                Bailey Assurances a la qualité de société de courtage d’assurance, immatriculée à I’ORIAS sous le no 18 004 781 (www.orias.fr) et distribue des produits 
                d’assurances dont le risque est placé auprès de compagnies d’assurances.</p>
            </div>


            <table style="width:16.8cm;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size:10px;">
                <tbody>
                    <tr>
                        <td align="center" style="border:1px solid #000;width:8cm;">
                            <span class="boxleft bold txt-cntr">&nbsp; &nbsp; 2. Présentation de votre intermédiaire, partenaire de distribution de BAILEY</span>
                            <p class="txt-cntr">BAILEY Assurances – Mon assurance PGE
                            09 chemin des carreaux 14111 Louvigny
                            (Orias 18 004 781).</p>
                        </td>
                        <td align="center" style="border:1px solid #000;width:8cm;">
                            <span class="boxright bold txt-cntr">&nbsp; &nbsp; 3. Nature de notre intervention</span>
                            <p class="txt-cntr">Pour l’exercice de notre activité, nous ne sommes liés par aucun accord
                            d’exclusivité avec un ou plusieurs assureurs. En revanche, nous ne
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
            Souhaitez-vous vous prémunir financièrement en cas d’une fuite d’eau intérieure ou extérieure, d’une panne de votre installation électrique
            et / ou de disfonctionnement de votre chaudière, chauffe-eau ou chauffe-bain ? &nbsp; {{new Illuminate\Support\HtmlString($checkfinancementicon)}}</p>

            <p>Etes-vous assurés contre ce type de risques ? &nbsp; {{new Illuminate\Support\HtmlString($checkrisqueicon)}}</p>

            <p>Dans l’affirmative, souhaitez-vous changer de produit et d’assureur ? &nbsp; {{new Illuminate\Support\HtmlString($checkproducticon)}} </p>

            <p>Remarques : {{ $comment }}</p>

            <ul>
                <li class="bold"><u>NOTRE SOLUTION</u></li>
            </ul>

            <p>En fonction des précisions que vous nous avez communiquées sur vos besoins, nous vous proposons le contrat «MON ASSURANCE PGE», contrat d’assurance
            n°01049859 — dont le risque est placé auprès de l’assureur AREAS, Société d’assurance mutuelle, 47-49 rue de Miromesnil 75390 Paris cedex. Société
            immatriculée au registre du Commerce et des Sociétés de Paris sous le n° 775 670 466.<br/>
            Ce contrat vous permet la prise en charge, à hauteur du forfait énoncé, de vos frais de réparation en cas de 1/ fuite d’eau intérieure ou extérieure
            ( Intérieure : fuite ou engorgement sur circuit d’évacuation, de chauffage, ballon, sanitaires et raccordement des appareils avec prise en charge des
            réparations : 600 € ; Extérieure : fuite ou engorgement sur circuit d’alimentation en eau ou sur circuit d’évacuation avec prise en charge des réparations :
            1 000 €). En cas de 2/ panne de l’installation électrique (Panne électrique sur câblage, tableau électrique, prises, interrupteurs, plafonniers et appliques
            avec prise en charge des réparations : 600 €). En cas de 3/ disfonctionnement de votre chaudière (Panne accidentelle provoquant l’interruption ou le
            dysfonctionnement de la chaudière ou du chauffe-eau avec prise en charge des réparations : 600 €).</p>
            <span class="boxleft bold txt-cntr">&nbsp; &nbsp; Réclamations et médiation</span>
            <p>Si vous avez une réclamation à formuler quant à la souscription de votre contrat, sa distribution ou la gestion de vos prestations, vous pouvez l’adresser à
            contact@monassurancepge.fr ou par courrier à l’adresse suivante BAILEY Assurances – Mon assurance PGE, 09 chemin des carreaux, 14111 Louvigny ou par
            téléphone au 0 974 136 222.</p>
            <p>Il sera accusé réception de votre réclamation dans les 48h et le maximum sera fait pour vous apporter une réponse dans un délai maximal de deux mois.</p>
            <p>Dans le cas d’un désaccord portant sur l’application ou l’interprétation du présent contrat, et uniquement après communication de notre position définitive,
            vous pouvez faire appel à La Médiation de l’Assurance — TSA 50110 — 75441 Paris Cedex 09 http://www.mediation-assurance.org. Sera alors mis en place
            un dispositif gratuit de règlement des litiges dans le but de trouver une solution amiable. En cas d’échec de cette démarche, vous conservez naturellement
            l’intégralité de vos droits à agir en justice. Tout litige relatif à l’application du contrat relève de la seule compétence des tribunaux Français.</p>
        
        <!-- <p class="txt-cntr">En application des Articles L 521-2 et L 521-4 du code des assurances</p> -->
        <p>Le présent document est établi préalablement à la conclusion d’un contrat d’assurance. Il nous permet de vous communiquer les informations réglementaires
        inhérentes à notre qualité d’intermédiaire en assurances, la nature de notre intervention et de préciser vos exigences et vos besoins à partir des éléments
        d’information que vous nous avez communiqués afin de vous accompagner dans le choix de votre contrat d’assurance.</p>
        <hr class="simple">
        <p>Si vous avez souscrit à distance par Internet, vous pouvez saisir le médiateur compétent en déposant plainte sur la plateforme de la Commission Européenne
        pour la résolution des litiges accessible à l’adresse suivante : http://ec.europa.eu/consumers/odr</p>
        <p>Par ailleurs, vous pouvez saisir l’Autorité de Contrôle Prudentiel et de Résolution (ACPR) : 4 place de Budapest CS 92459 -75436 Paris Cedex 09 http://acpr.
        banque-france.fr/accueil.html</p>
        <span class="boxleft bold txt-cntr">&nbsp; &nbsp; 2. Protection des données personnelles</span>
        <p>Il est précisé que les données personnelles qui figurent ci-dessus font l’objet d’un traitement informatique de la part de BAILEY ASSURANCES, en sa qualité
        de responsable de traitement.</p>
        <div>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;a. Objet du traitement de données</div>
            <p>Finalités : Les données personnelles collectées sont uniquement utilisées pour l’étude de vos besoins en assurances et vous apporter la meilleure réponse et
            information sur nos produits en vue de la souscription de votre contrat.
            Données — RGPD : Ce traitement de données est nécessaire au respect d’une obligation légale à laquelle le responsable du traitement est soumis et à
            l’exécution des mesures précontractuelles d’information en application du RGPD et de la Loi Informatique et Libertés telle que modifiée.</p>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;b. Destinataires des données</div>
            <p>Vos données sont susceptibles d’être communiquées au personnel habilité de BAILEY ASSURANCES ayant besoin de connaitre de vos données dans le cadre
            de leurs missions, à ses prestataires informatiques ou de centre d’appels ainsi qu’à ses partenaires courtiers ou assureurs.</p>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;c. Durée de conservation des données</div>
            <p>BAILEY ASSURANCES s’engage à conserver vos données personnelles pour une durée n’excédant pas celle nécessaire aux finalités pour lesquelles elles sont
            traitées et conformément aux durées de conservation imposées par les lois applicables en vigueur.</p>
            <div class="bold">&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;d. Les droits concernant vos données</div>
            <p>Conformément au RGPD et à la Loi Informatique et Libertés telle que modifiée, vous bénéficiez : d’un droit d’accès, de rectification, d’effacement, d’opposition,
            de limitation du traitement, de portabilité des données qui vous concernent, ainsi que du droit de définir des directives relatives à la conservation, l’effacement
            et à la communication de ces données après votre décès.
            Vous pouvez exercer ces droits en nous adressant un courrier accompagné d’une pièce d’identité recto-verso à Bailey Assurances, Service client — BAILEY
            Assurances – Mon assurance PGE, 09 chemin des carreaux, 14111 Louvigny. Si vous estimez, après nous avoir contactés, que vos droits sur vos données ne
            sont pas respectés, vous pouvez adresser une réclamation auprès de la CNIL (3 Place de Fontenoy - TSA 80715 - 75334 PARIS CEDEX 07 ou sur le site de la
            CNIL www.cnil.fr).</p>
        </div>
        <span class="boxleft bold txt-cntr">&nbsp; &nbsp;  3. Droit de renonciation d'un contrat souscrit dans le cadre d'un démarchage</span>
        <p>Vous pouvez renoncez à votre contrat s’il a été souscrit dans le cadre d’un démarchage au domicile ou sur le lieu de travail dans les conditions de l’article
        LI 12-9 du Code des assurances.</p>
        <p>Rappel de l’article LI 12-9 du Code des Assurances :<br/>
        Toute personne physique qui fait l’objet d’un démarchage à son domicile, à sa résidence ou à son lieu de travail, même à sa demande, et qui signe dans ce
        cadre une proposition d’assurance ou un contrat à des fins qui n’entrent pas dans le cadre de son activité commerciale ou professionnelle, a la faculté
        d’y renoncer par lettre recommandée avec demande d’avis de réception pendant le délai de 30 jours calendaires révolus à compter du jour de la
        conclusion du contrat sans avoir à justifier des motifs ni à supporter de pénalités.</p>
        <p class="bold">En apposant votre signature sur ce document, vous reconnaissez avoir pris connaissance du cont enu duprésent document préalablement à la signature de contrat d’assurance proposé ci-dessus et avoir reçu :</p>
        <dd class="bold">- Le document d’information afférent au contrat d’assurance qui vous est proposé</dd>
        <dd class="bold">- Les conditions générales dudit contrat d’assurance</dd>
        <br/>
        <div class="box">
            <div class="boxleft">Fait à : {{ $city }}</div>
            <div class="boxleft">Le : {{ $date }}</div>
            <div class="boxleft">( NB : Compléter recto-verso ) </div>
            <div class="boxleft">Signature du client: </div>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1">
                    <h2>MON ASSURANCE PGE<br/>Prise en charge du paiement des factures de frais de
                    réparations Électriques, Gaz et Plomberie</h2>
                    <u class="bold">Notice d’information valant Conditions Générales du contrat n°01049859</u>
                    <p>La présente notice regroupe les principales dispositions du contrat collectif n°01049859 souscrit par Sphinx au profit des Assurés qui peuvent en demander, à tout moment et sans frais, la communication intégrale.<br/>
                    <u>Assureur</u><br/>
                    <span class="bold">AREAS</span><br/>
                    47-49 rue de Miromesnil 75390 Paris cedex.<br/>
                    Société d’assurance mutuelle immatriculée au Registre du Commerce et des Sociétés de Paris sous le n° 775 670<br/>
                    466. Entreprise régie par le code des assurance, AREAS est soumise au contrôle de l’Autorité de Contrôle Prudentiel<br/>
                    et de Résolution (ACPR),4 Place de Budapest, 75436 Paris.</p>

                    <p><u>Courtier/gestionnaire :</u><br/>
                    <span class="bold">Sphinx Affinity</span><br/>
                    69, route de Montfavet CS 20053 84918 AVIGNON Cedex 9<br/>
                    Société par Actions Simplifiée : Capital 15 000 Euros,<br/>
                    Immatriculée au Registre du Commerce et des Sociétés d’Avignon sous le numéro 512 785 106.Inscrite au Registre National des Intermédiaires : n° 09 051 594<br/>
                    Entreprise gérée régie par le Code des assurances et soumise à l’Autorité de Contrôle Prudentiel et de Résolution (ACPR, 4 Place de Budapest CS 92459, 75436 Paris)</p>

                    <p><u>Distributeur :</u><br/>
                    <span class="bold">BAILEY Assurances – Mon assurance PGE</span><br/>
                    9 chemin des carreaux 14111 Louvigny (Orias 18 004 781)<br/>
                    Immatriculée au Registre du Commerce et des Sociétés de Caen sous le n° 820 472 553.<br/>
                    Entreprise gérée régie par le Code des assurances et soumise à l’Autorité de Contrôle Prudentiel et de Résolution (ACPR, 4 Place de Budapest CS 92459, 75436 Paris)</p>
                    <p class="bold"><u>ARTICLE 1 - DICTIONNAIRE</u></p>
                    <dd class="bold">1 – Définitions relatives aux personnes</dd>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Assuré</li>
                    </ul>
                    <p>Toute personne physique, domiciliée en France métropolitaine, ayant adhéré au contrat collectif n°01049859.</p>
                    <dd class="bold">2 – Définitions relatives aux garanties</dd>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Par installation de plomberie intérieure, on entend :</li>
                    </ul>
                    <p>Les canalisations d’eau se situant à partir et en aval du robinet d’arrêt général intérieur. Pour les maisons individuelles
                    n’étant pas équipées de robinet d’arrêt général intérieur, la limite est matérialisée à partir de la pénétration extérieure
                    de la canalisation dans le mur de façade.</p>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Par installation de plomberie extérieure, on entend :</li>
                    </ul>
                    <p>Les canalisations d’alimentation générale en eau situées, sur les terrains attenants à l’habitation, en aval du compteur
                    général d’eau et à l’extérieur des murs de façade.
                    - Les canalisations d’évacuation c’est à dire de collecte des eaux usées (toilettes, cuisine, salle de bains, vidange de
                    machine) situées dans les terrains attenants à l’habitation, à l’extérieur du mur de façade et jusqu’au raccordement
                    au réseau collectif d’évacuation (égouts).</p>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Par fuite d’eau, on entend </li>
                    </ul>
                    <p>Un écoulement d’eau à débit constant sur l’Installation de plomberie intérieure, résultant de l’action soudaine et
                    imprévisible d’une cause extérieure indépendante de l’Assuré et qui présente un risque de dégât pour l’habitation. Il
                    doit pouvoir être constaté visuellement par le réparateur. Une facture d’eau anormalement élevée ou un compteur
                    d’eau qui tourne lorsque tous les robinets sont fermés ne peuvent être considérés comme étant la preuve d’une
                    fuite d’eau</p>      
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Par engorgement, on entend :</li>
                    </ul>           
                </div>
                <div class="table-cell1">

                    <p>L’obstruction totale de l’évacuation des eaux usées présentant un risque de dégât pour l’habitation.</p>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Par Installation électrique, on entend :</li>
                    </ul></br>
                    <p>Le système permanent d’alimentation en électricité installé dans le domicile et fournissant l’énergie électrique, situé
                    entre le disjoncteur de la compagnie de distribution d’électricité jusqu’aux prises murales.</p>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Par panne électrique, on entend </li>
                    </ul>
                    <p>Tout dysfonctionnement soudain et imprévisible survenu sur l’installation électrique provoquant une interruption de
                    l’alimentation électrique.</p>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Par panne de chaudière/chauffe-eau, on entend : </li>
                    </ul>
                    <p>Tout dysfonctionnement soudain et imprévisible survenu sur l’installation provoquant une interruption.</p>
                    <ul class="b">
                        &nbsp; &nbsp;<li class="bold">Délai de carence : </li>
                    </ul>
                    <p>Période de trois (3) mois, décomptée à partir de la date de prise d’effet du contrat, pendant laquelle l’indemnisation
                    pour un sinistre intervenu durant cette période, ne peut avoir lieu.</p>
                    <p class="bold"><u>ARTICLE 2 - GARANTIES ACCORDEES</u></p>
                    <dd class="bold">1 – Objet, montant et limite de la garantie</dd>
                    <p>La garantie est acquise après l’expiration du Délai de Carence de trois (3) mois à compter de la date d’effet du
                    contrat.<br/>
                    <span class="bold">Le nombre de sinistres pris en charge est limité à deux (2) par année d’assurance.</span><br/>
                    Nous intervenons à la suite de la réalisation de l’un des risques suivants :</p>
                    <p><u>A. En cas de fuite d’eau intérieure ou extérieure</u></p>
                    <p><span class="bold"> > Intérieure </span>: fuite ou engorgement sur circuit d’alimentation ou d’évacuation, de chauffage, ballon, sanitaires et
                    raccordement des appareils.<br/>
                    Nous prenons en charge les frais de réparations dans les limites définies ci-après sur la base de la facture réglée
                    par l’Assuré auprès du professionnel, <span class="bold">dans la limite de 600,00 €uros par sinistre et par année d’assurance.</span></p>
                    <p><span class="bold"> > Extérieure </span>: fuite ou engorgement sur circuit d’alimentation en eau ou sur circuit d’évacuation
                    Nous prenons en charge les frais de réparations dans les limites définies ci-après sur la base de la facture réglée
                    par l’Assuré auprès du professionnel, <span class="bold">dans la limite de 1000,00 €uros par sinistre et par année d’assurance.</span></p>
                    <p class="bold txt-cntr">– Garantie Plomberie intérieure –</p>
                    <p class="bold">Périmètre d’intervention et événements couverts :<br/>
                    Sont couvertes les fuites et les engorgements survenus sur les éléments suivants de l’installation :</p>
                    <u>Circuit intérieur d’alimentation d’eau</u>
                    <p>o Fuite d’eau ou engorgement sur les canalisations y compris les joints situés sur ces canalisations jusqu’aux
                    raccordements aux appareils sanitaires et électroménagers de l’habitation.</p>
                    <u>Circuit intérieur d’évacuation d’eau</u>
                    <p>o Fuite d’eau ou engorgement sur les canalisations y compris les joints situés sur ces canalisations,<br/>
                    o Fuite ou engorgement sur la canalisation de trop-plein percé de baignoire, lavabo, bidet et évier et WC,<br/>
                    o Fuite ou engorgement sur le siphon PVC ou métal.</p>
                    <u>Eau Chaude sanitaire</u>
                    <p>o Fuite d’eau sur un ballon d’eau chaude électrique percé (prise en charge de la vidange uniquement),<br/>
                    o Fuite sur le groupe de sécurité d’un ballon d’eau chaude électrique.
                    Sanitaires<br/>
                    o Fuite d’eau sur le joint de sortie de cuvette des WC,<br/>
                    o Fuite sur le robinet d’arrêt de la chasse d’eau.</p>
                    <u>Raccordement des appareils à effet d’eau (lave-vaisselle, lave-linge)</u>
                    <!-- <p>o Fuite d’eau sur joint et robinet de l’appareil à effet d’eau.
                    Circuit de chauffage<br/>
                    o Fuite d’eau sur le circuit d’eau du chauffage individuel, sur le robinet d’arrêt de la chaudière et le joint ou le té de
                    réglage des radiateurs de chauffage individuel</p>
                    <p class="bold">Pièces prises en charge</p>
                    <p>Les pièces prises en charge sont exclusivement les suivantes :</p> -->
                </div>
            </div>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1">
                    <p>o joints de canalisations intérieures d’alimentation et d’évacuation d’eau,<br/>
                       o joint de sortie de cuvette de WC,<br/>
                       o Pjoint de chasse d’eau de WC,<br/>
                       o Pjoint de raccordement aux appareils ménagers à effet d’eau (lave-vaisselle, lave-linge),<br/>
                       o robinet d’arrêt des appareils ménagers à effet d’eau (lave-vaisselle, lave-linge),<br/>
                       o robinet d’arrêt intérieur d’alimentation générale d’eau,<br/>
                       o robinet d’arrêt de chasse d’eau de WC,<br/>
                       o robinet ou té de réglage de chauffage individuel,<br/>
                       o tuyau de canalisation intérieure d’alimentation et d’évacuation d’eau,<br/>
                       o siphon PVC ou métal,<br/>
                       o tuyau de canalisation de trop-plein de baignoire, de lavabo, de bidet et d’évier,<br/>
                       o tuyau de circuit d’eau de chauffage individuel,<br/>
                       o groupe de sécurité des ballons d’eau chaude,<br/>
                       o robinet d’arrêt de la chaudière</p>

                       <p class="bold txt-cntr"><u>– Garantie Plomberie extérieure –</u></p>
                       <p><span class="bold">Périmètre d’intervention et événements couverts</span><br/><span>Sont couvertes les fuites et les engorgements survenus sur les éléments suivants de l’installation :</span></p>
                       <u>Circuit d’alimentation d’eau</u>
                        <p>o Fuite d’eau sur la canalisation,<br/>
                        o Fuite sur joint de parcours de la canalisation,<br/>
                        o Fuite sur robinet d’arrêt d’alimentation générale d’eau.</p>
                        <u>Circuit d’évacuation d’eau</u>
                        <p>o Fuite d’eau sur les canalisations extérieures,<br/>
                        o Fuite sur joint de parcours des canalisations,<br/>
                        o Engorgement des canalisations.<br/>
                        Dans le cas où l’événement garanti survient sur une portion de l’installation située sur un terrain faisant l’objet d’une
                        servitude, le prestataire agréé n’interviendra qu’après signature d’une décharge de la part du bénéficiaire indiquant
                        que ce dernier a réalisé les formalités nécessaires pour obtenir l’autorisation d’effectuer les réparations en application
                        des termes de la présente convention</p>
                        <p class="bold">Pièces prises en charge</p>
                        <p>Les pièces prises en charge sont exclusivement les suivantes :<br/>
                        o robinets d’arrêt,<br/>
                        o raccords,<br/>
                        o joints,<br/>
                        o tuyaux de canalisation d’alimentation et d’évacuation d’eau.</p>
                        <u>B. En cas de panne de l’installation électrique</u>
                        <p>Panne électrique sur câblage, tableau électrique, prises, interrupteurs, plafonniers et appliques <span class="bold">dans la limite de
                        600,00 €uros par sinistre et par année d’assurance</span>.</p>

                        <p class="bold txt-cntr"><u>– Garantie Electricité –</u></p>
                        <p class="bold">Périmètre d’intervention et événements couverts</p>
                        <p>Sont couvertes les pannes électriques survenues sur les éléments suivants de l’installation :<br/>
                        o Les câblages,<br/>
                        o Le tableau électrique.<br/>
                        o Les prises murales.<br/>
                        o Les interrupteurs.<br/>
                        o Les douilles des plafonniers et appliques fixes.</p>
                        <p class="bold">Pièces prises en charge</p>
                        <p>Les pièces prises en charge sont exclusivement les suivantes :<br/>
                        o fusibles et porte fusibles,<br/>
                        o appareillage(s) de base (interrupteur de commande(s),<br/>
                        o prise(s) monophasée(s) et câbles,<br/>
                        o disjoncteur divisionnaire, disjoncteur différentiel ou interrupteur différentiel.</p>
                        <u>C. En cas de disfonctionnement de votre chaudière / Chauffe-eau / Chauffe-bain</u>
                        <p>Panne accidentelle provoquant l’interruption ou le dysfonctionnement de la chaudière ou du chauffe-eau <span class="bold">dans la
                        limite de 600,00 €uros par sinistre et par année d’assurance.</span></p>
                        
                </div>
                <div class="table-cell1">
                    <p class="bold txt-cntr"><u>– Garantie Chaudière / Chauffe-eau / Chauffe-bain –</u></p>
                    <p class="bold">Appareils garantis et événements couverts</p>
                    <p>Sont couverts les chaudières, chauffe-eau ou chauffe-bains, de moins de 10 ans (suivant la date d’installation) agréés
                    en France par la norme NF, à usage domestique et ne bénéficiant plus d’aucune garantie (légale, constructeur ou
                    distributeur), situés au domicile de l’Assuré, utilisant les combustibles fiouls ou gazeux et dont la puissance est
                    inférieure ou égale à 70 kW.</p>
                    <p class="bold">Le bénéficiaire doit pouvoir justifier d’un contrat d’entretien annuel obligatoire conformément à la norme
                    AFNOR NF X50-010 ou NF X50-011.<br/>
                    Ce contrat ainsi que la facture d’installation de la chaudière doivent être présentés au réparateur lors de
                    toute intervention.</p>
                    <p class="bold">2 – Exclusions</p>
                    <p>AUCUNE GARANTIE NE POURRA ÊTRE DÉLIVRÉE A L’ASSURE :</p>
                    <p class="bold">o EN CAS DE SUSPENSION OU RÉSILIATION DU CONTRAT POUR LES FACTURES CONCERNÉES<br/>
                    o PRISES EN CHARGE,<br/>
                    o EN CAS DE NON RÉGULARISATION DES PRIMES ÉMISES AU TITRE DU PRÉSENT CONTRAT,<br/>
                    o EN CAS DE PANNES DONT LES CAUSES SONT ANTERIEURES A L’AHDHESION,<br/>
                    o EN CAS DE SINSITRE CAUSE OU PROVOQUE INTENTIONNELLEMENT PAR L’ASSURE OU LE<br/>
                    BENEFICIAIRE DU PRESENT CONTRAT,<br/>
                    o EN CAS DE SINISTRE PROVOQUE PAR LA GUERRE CIVILE OU ETRANGERE (QUE LA GUERRE AIT ETE<br/>
                    DECLAREE OU NON), OU UN ATTENTAT.</p>

                    <p class="bold txt-cntr">Exclusions spécifiques à la garantie Plomberie Intérieure</p>
                    <p>Sont exclus et ne pourront donner lieu à indemnisation à quelque titre que ce soit :</br>
                    <span class="bold">• les fuites d’eau ou engorgements sur les canalisations qui relèvent d’une copropriété (qualifiées de parties
                    communes ou spéciales par le règlement de copropriété), du chauffage au sol,</span></br>
                    <span class="bold">• les fuites d’eau sur les appareillages sanitaires (douche, baignoire, bidet, lavabo, évier, WC, robinetterie,
                    cumulus) et leur remplacement,</span></br>
                    <span class="bold">• toute fuite sur les corps de chauffe (radiateurs), pompes à chaleur, chauffages solaires, chaudières,</span></br>
                    <span class="bold">• l’Intervention sur les pompes, les réducteurs de pression et les détendeurs, des adoucisseurs d’eau,</span></br>
                    <span class="bold">• toute Intervention sur les systèmes de climatisation,</span></br>
                    <span class="bold">• les dommages matériels causés par l’eau,</span></br>
                    <span class="bold">• toute perte ou dommage résultant d’un dysfonctionnement dont la résolution est du ressort de la
                    compagnie de distribution d’eau,</span></br>
                    <span class="bold">• les interruptions de fourniture d’eau consécutives à un non-paiement des factures à la compagnie de
                    distribution,</span></br>
                    <span class="bold">•les frais encourus alors que l’Assuré a été averti par la compagnie de distribution de la nécessité de
                    procéder à des travaux de réparation définitifs en vue d’éviter la répétition de situations entraînant une
                    panne et/ou une défaillance,</span></br>
                    <span class="bold">• le remplacement de canalisation qui découle d’une mise en conformité avec les prescriptions légales,
                    sanitaires ou de sécurité, ou avec les bonnes pratiques en vigueur,</span></br>
                    <span class="bold">• les travaux de réparation, de renouvellement ou de mise en conformité de l’ensemble de l’installation
                    plomberie,</span></br>
                    <span class="bold">• les dommages relevant de l’assurance construction obligatoire (loi n° 78-12 du 4 janvier 1978),</span></br>
                    <span class="bold">• les frais liés à une recherche de fuite d’eau.</p>

                    <p class="bold txt-cntr">Exclusions spécifiques à la garantie Plomberie Extérieure</p>
                    <p>Sont exclus et ne pourront donner lieu à indemnisation à quelque titre que ce soit :</br>
                    <span class="bold">• toute Intervention sur les éléments situés en aval du robinet de puisage, les circuits d’arrosage,</span></br>
                    <span class="bold">• toute Intervention sur les fosses septiques, les bacs à graisses, les systèmes d’épandages d’eaux usées,
                    les drainages, les puisards, les réseaux d’évacuation des eaux pluviales, les gouttières, les chêneaux, les
                    descentes,</span></br>
                    <span class="bold">• toute Intervention sur les compteurs d’eau et la canalisation d’alimentation d’eau située avant ce compteur,</span></br>
                    <span class="bold">• toute Intervention sur les pompes, les réducteurs de pression, les détendeurs et les stations de relevage
                    des systèmes d’évacuation des eaux usées,</span></p>
                </div>
            </div>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1">
                    <p class="bold">Les drainages, les puisards, les réseaux d’évacuation des eaux pluviales, les gouttières, les chêneaux, les
                    descentes,<br/>
                    • toute Intervention sur les compteurs d’eau et la canalisation d’alimentation d’eau située avant ce compteur,<br/>
                    • toute Intervention sur les pompes, les réducteurs de pression, les détendeurs et les stations de relevage
                    des systèmes d’évacuation des eaux usées,<br/>
                    • les dommages relevant de l’assurance construction obligatoire (loi n° 78-12 du 4 janvier 1978),<br/>
                    • les conséquences et dommages consécutifs à un gel survenu sur une portion non enterrée des
                    canalisations,<br/>
                    • les dommages matériels causés par l’eau,<br/>
                    • toute perte ou dommage résultant d’un dysfonctionnement dont la résolution est du ressort de la
                    compagnie de distribution d’eau,<br/>
                    • les interruptions de fourniture d’eau consécutives à un non-paiement des factures à la compagnie de
                    distribution,<br/>
                    • les frais encourus alors que l’Assuré a été averti par la compagnie de distribution de la nécessité de
                    procéder à des travaux de réparation définitifs en vue d’éviter la répétition de situations entraînant une
                    panne et/ou une défaillance,<br/>
                    • le remplacement de canalisation qui découle d’une mise en conformité avec les prescriptions légales,
                    sanitaires ou de sécurité, ou avec les bonnes pratiques en vigueur,<br/>
                    • les travaux de réparation, de renouvellement ou de mise en conformité de l’ensemble de l’installation de
                    plomberie,<br/>
                    • les frais liés à une recherche de fuite d’eau dès lors qu’aucune fuite n’a été constatée par le Prestataire
                    agréé</p>
                    <p class="bold txt-cntr">Exclusions spécifiques à la garantie Electricité</p>
                    <p>Sont exclus et ne pourront donner lieu à indemnisation à quelque titre que ce soit :</p>
                    <p class="bold">• les Interventions portant sur le réglage de l’intensité de déclenchement du disjoncteur (augmentation de
                    la puissance souscrite),<br/>
                    • tout dysfonctionnement électrique imputable à une défaillance des réseaux de distribution et/ou de
                    transport d’électricité,<br/>
                    • toute perte ou dommage découlant de la coupure ou de l’interruption de l’alimentation publique en
                    électricité dans le Domicile,<br/>
                    • les installations électriques intérieures faisant l’objet d’un branchement provisoire n’ayant pas obtenu
                    le certificat de conformité délivré par le CONSUEL (Comité National pour la sécurité des Usagers de
                    l’Electricité),<br/>
                    • les appareils électriques, électroniques, électroménagers, les consommables tel que les ampoules, les
                    transformateurs,<br/>
                    • les systèmes de climatisation, de chauffage au sol et de pompe à chaleur,<br/>
                    • les installations électriques raccordées à une pompe utilisée pour une piscine, un bassin, un plan d’eau ou
                    un aquarium, à l’intérieur ou à l’extérieur du Domicile,<br/>
                    • les conséquences d’une combustion (avec ou sans flamme) ou d’une explosion,<br/>
                    • toute Intervention sur l’un ou l’autre des éléments suivants :<br/>
                    &nbsp; &nbsp; o toute installation fixe, y compris le câblage et la mise à la terre, lorsque son remplacement est
                    uniquement la conséquence de modifications apportées à la législation ou aux directives relatives à
                    la santé et à la sécurité,<br/>
                    &nbsp; &nbsp; o le câblage de commande des alarmes antivol, le câblage téléphonique, les détecteurs de fumée, les
                    sonnettes, les systèmes électriques pour portes de garage, les gâches électriques, les interphones
                    et visiophones,<br/>
                    &nbsp; &nbsp; o les chauffe-eau électriques (exception faite du câblage fixe et permanent conduisant au chauffe-eau
                    qui reste couvert).<br/>
                    • les dommages matériels causés par l’électricité,<br/>
                    • toute perte ou dommage résultant d’un dysfonctionnement dont la résolution est du ressort de la c
                    compagnie de distribution d’électricité,<br/>
                    • les interruptions de fourniture d’électricité consécutives à un non-paiement des factures à la compagnie
                    de distribution,<br/>
                    • les frais encourus alors que l’Assuré a été averti par la compagnie de distribution de la nécessité de
                    procéder à des travaux de réparation définitifs en vue d’éviter la répétition de situations entraînant une
                    panne et/ou une défaillance,<br/>
                    • le remplacement de câblage qui découle d’une mise en conformité avec les prescriptions légales,
                    sanitaires ou de sécurité, ou avec les bonnes pratiques en vigueur,<br/>
                    • les travaux de réparation, de renouvellement ou de mise en conformité de l’ensemble de l’installation
                    électrique,<br/>
                    • les dommages relevant de l’assurance construction obligatoire (loi n° 78-12 du 4 janvier 1978).</p>
                    <br/>
                </div>
                <div class="table-cell1">
                    <p class="bold">Exclusions spécifiques à la garantie Chaudière / Chauffe-eau / Chauffe-bain</p>
                    <p>Sont exclus et ne pourront donner lieu à indemnisation à quelque titre que ce soit :</p>
                    <p class="bold">• les dommages relevant de l’assurance construction obligatoire (loi n° 78-12 du 4 janvier 1978),<br/>
                    • les dommages matériels causés par l’eau, le gaz et l’électricité,<br/>
                    • toute perte ou dommage résultant d’un dysfonctionnement dont la résolution est du ressort de la
                    compagnie de distribution d’eau, d’électricité ou de gaz,<br/>
                    • les interruptions de fourniture d’électricité, d’eau ou de gaz consécutives à un non-paiement des factures
                    à la compagnie de distribution,<br/>
                    • les frais encourus alors que l’Assuré a été averti par la compagnie de distribution de la nécessité de
                    procéder à des travaux de réparation définitifs en vue d’éviter la répétition de situations entraînant une
                    panne et/ou une défaillance,<br/>
                    • le remplacement de canalisation, de câblage ou de circuit d’alimentation qui découle d’une mise en
                    conformité avec les prescriptions légales, sanitaires ou de sécurité, ou avec les bonnes pratiques en
                    vigueur,<br/>
                    • les travaux de réparation, de renouvellement ou de mise en conformité de l’ensemble de l’installation
                    électrique, de plomberie, de chauffage ou de gaz,<br/>
                    • les appareils pour lesquels les originaux des factures d’achat et factures d’installation ne peuvent être
                    produits lors de l’Intervention du Prestataire agréé,<br/>
                    • toute Intervention autre que la simple mise en sécurité de l’appareil dont la dernière visite d’entretien
                    réalisée par un technicien agréé date de plus de 12 mois ou dont le carnet d’entretien n’est pas à jour ou
                    n’est pas conforme aux prescriptions du fabricant,<br/>
                    • les Interventions lorsque le Prestataire agréé estime la chaudière non réparable, notamment en cas
                    d’indisponibilité des pièces,<br/>
                    • toute Intervention qui relève de l’entretien annuel obligatoire conformément aux normes AFNOR NF X50-10
                    ou NF X50-011,<br/>
                    • les incidents liés à un dysfonctionnement des robinets détendeurs d’arrivée de gaz situés à l’extérieur de
                    la chaudière, du chauffe-eau ou du chauffe-bain,<br/>
                    • toute Intervention consécutive à un dommage ou rouille causé par une utilisation incorrecte d’un matériel
                    d’entretien ou autres substances,<br/>
                    • les coûts éventuels engagés pour accéder à la chaudière, chauffe-eau ou au chauffe bain, à la tuyauterie
                    ou à son environnement,<br/>
                    • le ramonage et les pièces des conduits de fumées ainsi que le pot de purge,<br/>
                    • la réparation de dommages causés par l’utilisation d’eau, de fioul ou de gaz anormalement pollués,
                    utilisation en atmosphère anormalement polluée (poussière abondante, vapeur grasse et/ou corrosives),<br/>
                    • l’Intervention pour manque de gaz, d’électricité ou d’eau, corrosion ou eau dans la citerne, détartrage des
                    batteries et des ballons d’eau chaude sanitaire,<br/>
                    • l’entretien et le dépannage des dispositifs extérieurs à la chaudière (VMC, régulation, etc....),<br/>
                    • toute Intervention extérieure à la chaudière, chauffe-eau ou chauffe-bain sur le circuit hydraulique (fuites,
                    appoints d’eau) et sur les dispositifs électriques de l’installation,<br/>
                    • l’Intervention nécessitant la vidange de l’installation et/ou le déplacement de la chaudière et/ou le
                    remplacement du corps de chauffe ou du ballon d’eau chaude sanitaire,<br/>
                    • la réfection du briquetage de la chaudière,<br/>
                    • la réfection des points de fixation,<br/>
                    • toute Intervention sur les cuves et ballons de réserve d’eau chaude des cumulus et des appareils,<br/>
                    • toute Intervention sur les vases d’expansion,<br/>
                    • les pompes à chaleur,<br/>
                    • l’entartrement des appareils.<br/>
                    • Les sinistres si l’assuré ne peut justifier d’un contrat d’entretien annuel obligatoire conformément à la
                    norme AFNOR NF X50-010 ou NF X50-011. Ce contrat ainsi que la facture d’installation de la chaudière
                    doivent être présentés au réparateur lors de toute intervention.</p>
                    <p class="bold">3 - Déclaration et obligation en cas de sinistres</p>
                    <p>Tout sinistre doit être déclaré par l’Assuré au Distributeur Bailey Assurances ou bien au Gestionnaire dans les cinq 
                    (5) jours ouvrés de sa date de survenance.</p> 
                </div>
            </div>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1">
                    <p><span class="bold">a)</span> L’Assuré doit fournir, dès la découverte du sinistre et au maximum dans les 5 jours ouvrés, au Distributeur (par
                    courrier : Bailey Assurances – Service assurance PGE – 09 chemin des carreaux 14111 Louvigny ou par mail :
                    contact@monassurancepge.fr) ou au Gestionnaire (par courrier : Sphinx Affinity - Service assurance PGE – 69 route
                    de Montfavet CS 20053 84918 AVIGNON Cedex 9) :</p>

                    <u>En cas de fuite d’eau intérieure ou extérieure :</u>
                    <p>Une copie de la facture d’intervention de l’artisan mentionnant la réparation à 100% pour motif de :<br/>
                    <span class="bold"> > Intérieure</span> : fuite ou engorgement sur circuit d’évacuation, de chauffage, ballon, sanitaires et raccordement des appareils.<br/>
                    <span class="bold"> > Extérieure</span> : fuite ou engorgement sur circuit d’alimentation en eau ou sur circuit d’évacuation.</p>
                    <u>En cas de panne de l’installation électrique :</u>
                    <p>Une copie de la facture d’intervention de l’artisan mentionnant la réparation à 100% pour motif de Panne électrique
                    sur câblage, tableau électrique, prises, interrupteurs, plafonniers et appliques.</p>
                    <u>En cas de disfonctionnement de votre chaudière :</u>
                    <p>Une copie de la facture d’intervention de l’artisan mentionnant la réparation à 100% pour motif dePanne accidentelle
                    provoquant l’interruption ou le dysfonctionnement de la chaudière ou du chauffe-eau.</p>
                    <p><span class="bold">a)</span> Toute demande de prise en charge devra être accompagnée de toutes les factures de réparations acquittées,
                    d’une déclaration de sinistre et de tout autre élément justificatif (photos si possible).<br/>
                    <span class="bold">b)</span> Le GESTIONNAIRE effectuera, pour le compte de L’Assureur, le règlement du sinistre.</p>

                    <p class="bold"><u>ARTICLE 3 - CADRE DU CONTRAT</u></p>
                    <p><span class="bold">PRISE D’EFFET DE LA GARANTIE</span><br/>
                    Le contrat prend effet à la date indiquée au certificat d’adhésion.<br/>
                    La garantie est subordonnée à l’existence d’un contrat en cours de validité au jour de l’événement et à jour du
                    paiement des cotisations.</p>
                    <span class="bold">DUREE DE LA GARANTIE</span><br/>
                    Le contrat est conclu pour une durée d’un an et se reconduit tacitement d’année en année à sa date d’échéance
                    principale sauf résiliation par l’une des parties dans les cas et conditions fixés au contrat.</p>
                    <span class="bold">PAIEMENT DE LA PRIME</span><br/>
                    L’adhérent, tel que défini sur le certificat d’adhésion, s’engage à payer la prime d’assurance afférente aux garanties du
                    présent Contrat. La prime d’assurance dont le montant est précisé au bulletin d’adhésion, est réglée mensuellement
                    auprès du DISTRIBUTEUR par prélèvement automatique.
                    <span class="bold">DEFAUT DE PAIEMENT DE LA PRIME</span><br/>
                    En cas de défaut de paiement de la prime ou d’une fraction de la prime dans les 10 jours qui suivent son échéance,
                    BAILEY ASSURANCES enverra une relance à l’Adhérent par Lettre, Email ou SMS (Bailey Assurances agit sur les
                    prélèvements en tant que délégataire de Sphinx). Si dans les 30 jours qui suivent son envoi, la(les) prime(s) ou la(les)
                    fraction(s) de prime due n’est toujours pas payée, les garanties seront suspendues et si la prime n’est toujours pas
                    réglée dans les 10 jours qui suivent la date de suspension des garanties, BAILEY ASSURANCES pourra résilier le
                    Contrat.</p>
                    <p class="bold">CESSATION DU CONTRAT</p>
                    <p>Pour toute demande de cessation de contrat, l’Assuré ou ses Bénéficiaires doivent en premier lieu consulter son
                    interlocuteur habituel :</p>
                    <p>Le DISTRIBUTEUR :</p>
                    <p class="bold">Par courrier : BAILEY Assurances – Mon assurance PGE, - service sinistre - 9 chemin des carreaux - 14111
                    Louvigny,<br/>
                    par courrier électronique : contact@monassurancepge. Fr,<br/>
                    ou par téléphone au : 09.74.13.62.22</p>
                    <p>ou bien LE GESTIONNAIRE :<br/>
                    Par courrier : Sphinx affinity-Service Assurance PGE : 69, route de Montfavet, CS 20053 84918 AVIGNON Cedex 9</p>
                    <p>Le Contrat prend fin dans les cas suivants :<br/>
                    - En cas d’utilisation par l’Adhérent de sa faculté de renonciation ;<br/>
                    - En cas de résiliation par l’Adhérent à échéance à l’issue de la première année contractuelle. La demande doit
                    être adressée au DISTRIBUTEUR voire au GESTIONNAIRE, par lettre recommandée avec avis de réception à
                    l’adresse ci-dessus. La résiliation intervenue au cours du mois « M » prendra effet à la date d’échéance de la prime
                    du mois « M+1 » ;</p>
                    </p>
                </div>
                <div class="table-cell1">
                    <p>- En cas de résiliation par AREAS pour non-paiement de la prime (en application des dispositions de l’article L.113-3
                    du Code des assurances) ;<br/>
                    - En cas de décès de l’Assuré, ses ayants droits devant informer le DISTRIBUTEUR voire le GESTIONNAIRE par
                    écrit. La résiliation prend alors effet à la date du décès ;<br/>
                    - Dans tous les autres cas prévus par le Code des assurances</p>
                    <p class="bold">RESILIATION</p>
                    <p>Le contrat peut être résilié auprès du DISTRIBUTEUR voire du GESTIONNAIRE. La résiliation peut se faire en
                    adressant la demande, au choix :<br/>
                    • par lettre ou tout autre support durable ;<br/>
                    • par déclaration faite au siège social ou chez le représentant de l’assureur ;<br/>
                    • par acte extrajudiciaire ;<br/>
                    • lorsque l’assureur propose la conclusion de contrat par un mode de communication à distance, par le même mode
                    de communication ;<br/>
                    • par tout autre moyen prévu par le contrat.</p>
                    <p>Le DISTRIBUTEUR voire le GESTIONNAIRE confirme par écrit la réception de la notification</p>
                    <p>La résiliation intervient :</br>
                    o À l’échéance sous réserve de la notification de la résiliation à l’assureur par l’intermédiaire du courtier dans les 2
                    mois précédant cette date ;</br>
                    o En cas d’augmentation de la prime si cette augmentation n’est pas acceptée, l’assuré peut la contester dans les
                    30 jours suivant la notification de l’augmentation ;</br>
                    o Tout moment passé une première année d’assurance.</p>

                    <p class="bold">PRESCRIPTION</p>
                    <p>Toute action relative à l’application du présent contrat se prescrit par deux ans à compter de l’évènement qui y donne
                    naissance conformément aux articles L114-1, L114-2 et L114-3 du Code des Assurances ci-dessous reproduits. La
                    prescription peut être interrompue par une des causes ordinaires d’interruption : toute demande en justice, même
                    en référé, tout acte d’exécution forcée, toute reconnaissance par l’Assureur du droit à garantir l’Assuré ou toute
                    reconnaissance de dette de l’Assuré envers l’Assureur. Elle est également interrompue par la désignation d’un expert
                    à la suite d’un sinistre, par l’envoi d’une lettre recommandée avec accusé de réception adressée par l’Assureur à
                    l’Assuré en ce qui concerne l’action en paiement de la cotisation, par l’Assuré à l’Assureur en ce qui concerne le
                    règlement de l’indemnité.</p>

                    <p><u>Article L114-1 du Code des Assurances</u> : toutes actions dérivant d’un contrat d’assurance sont prescrites par deux
                    ans à compter de l’évènement qui y donne naissance. Toutefois, ce délai ne court :<br/>
                    1) en cas de réticence, omission, déclaration fausse ou inexacte sur le risque couru, que du jour où l’Assureur en a
                    eu connaissance<br/>
                    2) en cas de sinistre, que du jour où les intéressés en ont eu connaissance, s’ils prouvent qu’ils l’ont ignoré jusque-là.
                    Quand l’action de l’Assuré contre l’Assureur a pour cause le recours d’un tiers, le délai de la prescription ne court que
                    du jour où ce tiers a exercé une action en justice contre l’Assuré ou a été indemnisé par ce dernier.<br/>
                    <u>Article L114-2 du Code des Assurances </u>: la prescription est interrompue par une des causes ordinaires d’interruption
                    de la prescription et par la désignation d’experts à la suite d’un sinistre. L’interruption de la prescription de l’action
                    peut, en outre, résulter de l’envoi d’une lettre recommandée avec accusé de réception adressée par l’Assureur à
                    l’Assuré en ce qui concerne l’action en paiement de la cotisation, par l’Assuré à l’Assureur en ce qui concerne le
                    règlement de l’indemnité.<br/>
                    <u>Article L114-3 du Code des Assurances </u>: par dérogation à l’article 2254 du Code Civil, les parties au contrat
                    d’assurance ne peuvent, même d’un commun accord, ni modifier la durée de la prescription, ni ajouter aux causes
                    de suspension ou d’interruption de celle-ci.</p>

                    <p class="bold">SUBROGATION</p>
                    <p>Après vous avoir réglé une indemnité, nous sommes subrogés dans les droits et actions que vous pouvez avoir
                    contre les tiers responsables du sinistre, comme le prévoit l’article L. 121-12 du Code des assurances français.
                    Notre subrogation est limitée au montant de l’indemnité que nous vous avons versée ou des services que nous
                    avons fournis.</p>
                    <p class="bold">PLURALITÉ D’ASSURANCES</p>
                    <p>Conformément aux dispositions de l’article L. 121-4 du Code des assurances, quand plusieurs assurances sont
                    contractées sans fraude pour un même risque, chacune d’elles produit ses effets dans les limites des garanties du
                    contrat, et dans le respect des dispositions de l’article L. 121-1 du Code des assurances. Dans ce cas, l’Assuré doit
                    prévenir tous les assureurs.</p>
                </div>
            </div>
        </div>

        <div class="container" style="font-size:10px !important;">
            <div class="table-row">
                <div class="table-cell1">
                    <p>Dans ces limites, l’Assuré peut s’adresser à l’Assureur de son choix. Quand elles sont contractées de manière
                    dolosive ou frauduleuse, les sanctions prévues par le Code des assurances (nullité du contrat et dommages-intérêts)
                    sont applicables.</p>
                    <p class="bold"><u>ARTICLE 4 - DISPOSITION DIVERSES</u></p>
                    <p class="bold">TRIBUNAUX COMPETENTS – LOI APPLICABLE</p>
                    <p>Toute action judiciaire relative au présent contrat sera de la seule compétence des tribunaux français.</p>
                    <p class="bold">LANGUE UTILISÉE</p>
                    <p>La langue utilisée dans le cadre des relations précontractuelles et contractuelles est la langue française.</p>
                    <p class="bold">LOI INFORMATIQUE ET LIBERTES</p>
                    <p>L’Assureur est le responsable du traitement des données personnelles que l’Assuré a communiqué à l’Assureur
                    ou à ses mandataires (par téléphone, messagerie électronique ou autrement) pour les besoins de la Garantie et
                    sont nécessaires pour les traitements informatiques liés à la gestion de son contrat d’assurance et peuvent être
                    également utilisées, sauf opposition de sa part, à des fins commerciales. Ces données personnelles peuvent
                    également faire l’objet de traitements spécifiques et d’informations aux autorités publiques compétentes dans le
                    cadre des dispositions législatives et réglementaires en vigueur notamment relatives à la lutte contre le blanchiment
                    et le financement du terrorisme. Les mêmes données personnelles pourront être enregistrées à des fins de
                    formation du personnel de l’Assureur et de ses mandataires dans le cadre de la gestion des sinistres de l’Assuré.
                    Elles pourront être utilisées par les mandataires de l’Assureur, ses réassureurs, ses partenaires et organismes
                    professionnels. L’Assuré dispose d’un droit d’accès, de rectification, de modification, de suppression et d’opposition
                    sur les données personnelles le concernant qu’il peut exercer en contactant le Directeur de la Protection des
                    données via l’adresse suivante : dpo@areas.com</p>
                    <p class="bold">TRAITEMENT DE VOS DONNEES PERSONNELLES</p>
                    <p class="bold">1. Nous contacter</p>
                    <p>Pour toute question ou renseignement relatif à l’utilisation de vos données personnelles, ou pour exercer vos droits
                    relatifs à ces données personnelles, veuillez contacter notre Délégué à la Protection des Données à l’adresse
                    suivante :</p>
                    <p>&nbsp; &nbsp;Délégué à la Protection des Données,<br/>
                    &nbsp; &nbsp;AREAS<br/>
                    &nbsp; &nbsp;47-49 rue de Miromesnil<br/>
                    &nbsp; &nbsp;75390 Paris, FranceBR<br/>
                    Ou <span class="bold">par courriel</span> à : dpo@areas.fr<br/>
                    Dans le cadre des services et produits que Aréas et ses partenaires (ensemble « nous », « notre », nos ») vous
                    fournissent, vous êtes amenés à communiquer des données à caractère personnel (« données personnelles » ou
                    « données ») vous concernant. Cette Notice d’information est mise à votre disposition afin de mieux comprendre
                    comment nous collectons, traitons et protégeons ces données personnelles.</p>
                    <p>Nous nous engageons à respecter les dispositions relatives à la protection des données à caractère personnel en
                    vigueur, et en particulier le Règlement (UE) 2016/679 du Parlement européen et du Conseil du 27 avril 2016 relatif
                    à la protection des personnes physiques à l’égard du traitement des données à caractère personnel et à la libre
                    circulation de ces données, et abrogeant la directive 95/46/CE (règlement général sur la protection des données),
                    ainsi que la Loi n°78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, modifiée (ensemble «
                    la Réglementation relative à la protection des données »).</p>
                    <p><span class="bold">2. Qui sommes-nous ?</span><br/>
                    AREAS est une Société d’assurance mutuelle dont le siège social est situé 47-49 rue de Miromesnil 75390 Paris
                    cedex. Société immatriculée au Registre du Commerce et des Sociétés de Paris sous le n° 775 670 466.</p>
                    <p><span class="bold">3. Catégories de données personnelles collectées</span><br/>
                    Dans le cadre de la fourniture de nos produits et services, nous pouvons recueillir et utiliser des données personnelles
                    vous concernant, telles que </p>
                    <p>· Informations relatives à votre identité (nom, prénoms, adresse postale, numéro de téléphone, adresse e-mail…),<br/>
                    · Informations relatives au titulaire de la police d’assurance (numéro de police d’assurance, numéro de compte
                    bancaire, données de carte de paiement, facturation, historique de paiement…),</p>
                </div>
                <div class="table-cell1">
                    <p>· Informations relatives aux réclamations (numéro de réclamation, date et motif de la perte, historique des appels,
                    détails de la perte, numéro de référence de la police et documents supports…),<br/>
                    Dans le cadre du traitement de ces données, nous pouvons être amenés à collecter des données relatives aux
                    infractions, condamnations et mesures de sûreté, au moment de votre souscription au contrat d’assurance, en cours
                    d’exécution de ce contrat ou dans le cadre de la gestion d’un contentieux.<br/>
                    Certains de nos produits peuvent impliquer le traitement de données personnelles dites « sensibles », telles que des
                    données de santé. Ces données seront traitées uniquement dans le but de respecter nos engagements envers vous
                    et dans le strict respect des dispositions légales applicables à ces données.<br/>
                    Vous pouvez choisir de nous fournir ou non ces données. Il se peut que nous ne soyons pas en mesure de vous
                    fournir des produits ou services spécifiques si vous ne nous fournissez pas certaines données</p>

                    <p class="bold">4. Pourquoi nous traitons vos données personnelles</p>
                    <p>Vos données personnelles sont utilisées pour les finalités suivantes :</p>
                    <p>· La gestion de votre contrat et police d’assurance, l’exécution des garanties du contrat (y compris la gestion de
                    sinistres) et la gestion des réclamations et des contentieux, ces traitements étant nécessaires à l’exécution de
                    votre contrat ;<br>
                    · Le contrôle et la surveillance des risques, cela nous permettant de prévenir les activités frauduleuses et d’assurer
                    le recouvrement des sommes dues et étant donc nécessaire aux fins de nos intérêts légitimes ;<br>
                    · L’élaboration de statistiques et d’études actuarielles, cela nous permettant d’améliorer les offres et services
                    proposés et étant donc nécessaire aux fins de nos intérêts légitimes ;<br>
                    · La lutte contre la fraude à l’assurance et la lutte contre le blanchiment d’argent afin de nous conformer à nos
                    obligations légales.</p>

                    <p class="bold">5. Divulgation de vos données personnelles</p>
                    <p>Vos données personnelles peuvent être divulguées aux tiers suivants :<br>
                    · Aux sociétés de notre groupe telles que notre maison mère et les sociétés qui lui sont affiliées ;<br>
                    · A nos prestataires de services et sous-traitants, pour les besoins de la gestion et l’exécution de votre contrat ;<br>
                    · A d’autres compagnies d’assurance (intermédiaires, réassureurs) ;<br>
                    · Aux autorités publiques, afin de prévenir ou détecter la fraude ou toute autre activité criminelle et afin de satisfaire
                    à nos obligations légales et réglementaires.</p>

                    <p class="bold">6. Transferts internationaux de vos données personnelles</p>
                    <p>Nous pouvons être amenés à transférer vos données personnelles en dehors de l’Union Européenne, notamment
                    dans des pays n’étant pas considérés comme fournissant un niveau de protection suffisant selon la Commission
                    européenne. Afin d’assurer un niveau de sécurité adéquat, ces transferts seront encadrés par les clauses
                    contractuelles types établies par la Commission européenne, ou par d’autres garanties appropriées conformément
                    à la Règlementation relative à la protection des données.</p>

                    <p class="bold">7. Durée de conservation de vos données personnelles</p>
                    <p>Vos données personnelles seront conservées pour la durée strictement nécessaire à la fourniture du service et à
                    l’exécution du contrat, et selon notre politique de conservation des données. Ces données personnelles pourront
                    également être conservées pour toute durée additionnelle requise ou autorisée par les dispositions légales
                    applicables, cela incluant les durées de prescription auxquelles nous sommes soumises.</p>

                    <p class="bold">8. Vos droits</p>
                    <p>Conformément à la Réglementation relative à la protection des données, vous disposez d’un droit d’accès, de
                    rectification, d’effacement, de limitation, d’opposition, de portabilité de vos données personnelles, de ne pas faire
                    l’objet d’une décision automatisée (y compris le profilage), ainsi que du droit de donner des directives relatives au
                    sort de vos données personnelles après votre décès. Veuillez noter que l’exercice de ces droits n’est cependant pas
                    absolu et est soumis aux limitations prévues par la loi applicable.</p>
                    <p>Si vous estimez que le traitement de vos données personnelles constitue une violation de la Réglementation relative
                    à la protection des données, vous avez également le droit d’introduire une réclamation auprès de la Commission
                    Nationale de l’Informatique et des Libertés, à l’adresse suivante : CNIL – 3 Place de Fontenoy – TSA 80715 – 75334
                    PARIS CEDEX 07.
                </div>
            </div>
        </div>

        <div>
            <p>Pour obtenir une copie de vos données personnelles que nous détenons, pour plus de renseignements ou pour
            exercer vos droits relatifs à vos données personnelles, veuillez nous contacter à l’adresse ou courriel indiqué dans
            la section ci-dessus.</p>

            <p class="bold">EXAMEN DES RECLAMATIONS</p>
            <p>Au cours de la vie du Contrat, des difficultés peuvent survenir.
            Aussi, pour toute demande ou rectification d’information concernant l’Assuré ou ses Bénéficiaires ou en cas de litige,
            l’Assuré ou ses Bénéficiaires doivent en premier lieu consulter son interlocuteur habituel :</p>
            <p>Le DISTRIBUTEUR :</p>
            <p><span class="bold">Par courrier : BAILEY Assurances – Mon assurance PGE, - service sinistre - 9 chemin des carreaux - 14111
            Louvigny,<br/>
            par courrier électronique : contact@monassurancepge.fr,<br/>
            ou par téléphone au : 09.74.13.62.22</span><br/>
            ou bien LE GESTIONNAIRE :<br/>
            <span class="bold">Par courrier </span>: Sphinx affinity-Service Assurance PGE : 69, route de Montfavet, CS 20053 84918 AVIGNON Cedex 9.
            Vous recevrez un accusé de réception sous 10 jours ouvrables maximum. Vous serez tenu informé de l’avancement
            de l’examen de votre situation, et recevrez, sauf exception, une réponse au plus tard dans les deux mois qui suivent
            la réception de votre réclamation.</p>
            <p>Si la réponse ne le satisfait pas, l’Assuré peut saisir le service relations clientèle de l’Assureur (AREAS - 49, rue de
            Miromesnil 75380 Paris cedex 08, www.areas.fr, téléphone : 01 40 17 65 00) qui lui répondra au plus tard dans les
            deux mois suivant la date de réception de sa réclamation.
            En cas de désaccord persistant après la réponse donnée par le service relations clientèle, à condition qu’aucune
            action judiciaire n’ait été engagée, l’Assuré a la possibilité de saisir la Médiation de l’Assurance par courrier TSA
            50110 75441 Paris cedex 09 ou par voie électronique www.mediation-assurance.org. L’avis du médiateur de
            l’assurance ne lie pas les parties, lesquelles sont libres d’accepter ou de refuser sa proposition de solution et de
            saisir le tribunal compétent.</p>
            <p class="bold">AUTORITE CHARGEE DU CONTROLE DE L’ENTREPRISE D’ASSURANCES</p>
            <div class="box" style="width:80%;text-align: center;margin: auto;"> 
                <span class="boxleft">L’Autorité de contrôle prudentiel et de résolution (ACPR)</span><br/>
                <span class="boxleft">4 Place de Budapest,</span><br/>
                <span class="boxleft">CS 92459,</span><br/>
                <span class="boxleft">75436 Paris Cedex 09, France</span><br/>
            </div>
            <p><span style="bold">DROIT D’OPPOSITION DES CONSOMMATEURS AU DEMARCHAGE TELEPHONIQUE</span><br/>
            Si vous ne souhaitez pas faire l’objet de prospection commerciale par téléphone, vous pouvez gratuitement vous
            inscrire sur une liste d’opposition au démarchage téléphonique, notamment la liste BLOCTEL : http://www.bloctel.
            gouv.fr/index.php<br/>
            Ces dispositions sont applicables à tout consommateur c’est à dire à toute personne physique qui agit à des fins qui
            n’entrent pas dans le cadre de son activité commerciale, industrielle, artisanale ou libérale.</p>
            <p>(*) Rappel de l’article L112-9 du Code des Assurances (Modifié par Ordonnance n°2017-1433 du
            4 octobre 2017 - art. 2)</p>
            <p>Toute personne physique qui fait l’objet d’un démarchage à son domicile, à sa résidence ou à son lieu
            de travail, même à sa demande, et qui signe dans ce cadre une proposition d’assurance ou un contrat
            à des fins qui n’entrent pas dans le cadre de son activité commerciale ou professionnelle, a la faculté
            d’y renoncer par lettre recommandée ou par envoi recommandé électronique avec demande d’avis
            de réception pendant le délai de 30 jours calendaires révolus à compter du jour de la conclusion du
            contrat sans avoir à justifier des motifs ni à supporter de pénalités.</p>
        </div>

        <h4 class="bold txt-cntr"><u>I M P O R T A N T</u></h4>
        <ul>
            <li class="bold">SI L’ASSURE NE RESPECTE PAS LES DELAIS OU NE SE SOUMET PAS A CES OBLIGATIONS, IL POURRA ETRE DECHU DE TOUT DROIT A
            INDEMNITE POUR CE SINISTRE ET/OU LITIGE SI NOUS POUVONS APPORTER LA PREUVE QUE LE NON-RESPECT DE CETTE OBLIGATION
            NOUS A FAIT SUBIR UN PREJUDICE.</li>
            <li class="bold">TOUTE DECLARATION INEXACTE, TOUTE RETICENCE OU OMISSION VOLONTAIRE QUANT AUX FAITS AYANT DONNE NAISSANCE AU LITIGE
            ET/OU SINISTRE OU QUANT AUX ELEMENTS POUVANT SERVIR A SA SOLUTION ENTRAINE LA DECHEANCE DU DROIT A GARANTIE POUR
            LE LITIGE ET/OU LE SINISTRE CONSIDERE.</li>
            <li class="bold">DANS LE CAS OU IL S’AVERERAIT QUE NOUS AURIONS ETE AMENES A DECLENCHER NOS GARANTIES ALORS QUE LE BENEFICIAIRE
            N’ETAIT PLUS OU PAS ASSURE, LES FRAIS ENGAGES LUI SERAIENT INTEGRALEMENT REFACTURES, DE MEME S’IL AVAIT VOLONTAIREMENT
            FOURNI DE FAUSSES INFORMATIONS SUR LES CAUSES L’AMENANT A DEMANDER NOTRE INTERVENTION.</li>
        </ul>
        <br/>

        <hr class="new3">  

        <table style="width:16.8cm;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size:10px;">
            <tbody>
                <tr>
                    <td align="center" style="width:8cm;">
                        <p>Je soussigné(e), déclare renoncer à l’offre « Mon Assurance PGE ».</p>
                        <p>Conditions : à renvoyer au plus tard 30 jours calendaires après la date de conclusion
                        du contrat par lettre recommandée avec accusé de réception à l’intermediaire en
                        assurance : Bailey Assurances, 9 chemin des carreaux, 14111 Louvigny.
                        Cette rétractation n’est valable que si elle adressée dans le délai mentionné
                        ci-dessus, lisiblement, parfaitement remplie et signée.</p>
                    </td>
                    <td align="center" style="width:8cm;">
                        <p><span>Nom du Client : {{ $fname }} {{ $lname }}</span></p>
                        <p><span>Adresse : {{ $adresse  }}</span></p>
                        <p><span>Code Postal : {{ $cp }}</span> <span>Ville : {{ $city }}</span></p>
                        <p><span>Date contrat : </span></p>
                        <p><span>Signature du client : {{ $date }}</span></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div><img src="./images/pages/empge3.jpg" width="620px" height="1000px"></div>
        <div ><img src="./images/pages/empge4.jpg" width="620px" height="1000px"></div>

        <table style="width:16.8cm;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size:10px;">
            <tbody>
                <tr>
                    <td align="center" style="width:4cm;">
                        <p class="txtgray bold">Prise en Charge du</p>
                        <p class="txtgray bold">paiement de vos</p>
                        <p class="txtgray bold">factures de réparation</p>
                        <p class="txtgray bold">Électrique / Gaz / Plomberie*</p>
                        <p class="txtgray bold">DEMANDE D’ADHESION</p>
                    </td>
                    <td align="center" style="width:8cm;">
                        <img src="./images/pages/pge.jpg" width="160px" height="80px">
                    </td>
                    <td align="center" style="width:4cm;">
                        <p><span class="topdiv bold">0 974 136 222</span></p>
                        <p><span class="txtblue bold">Prix d’un appel local</span></p>
                        <p><span class="txtgray bold">contact@monassurancepge.fr</span></p>
                        <p><span class="txtgray bold">De 10h à 18h</span></p>
                        <p><span class="txtgray bold">Du lundi au vendredi</span></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div>
            <span class="boxleft">Distributeur : </span> <span class="inputs">{{ $fname }}</span>&nbsp; &nbsp;
            <span class="boxleft">Conseiller : </span> <span class="inputs">{{ $conseiller }}</span>&nbsp; &nbsp;
            <span class="boxleft">N° de Validation : </span> <span class="inputs">{{ $number }}</span>&nbsp; &nbsp;
        </div>

        <div class="box radiudiv">
            <p class="bold txt-cntr"> Coordonnées du/des Adhérent(s) du contrat </p>
            <p>
                <input type="checkbox" class="chx">
                <label class="checkbox-label bold">Mme: </label>
                <input type="checkbox" class="chx">
                <label class="checkbox-label bold">M :</label>
                <input type="checkbox" class="chx">
                <label class="checkbox-label bold">Date d’effet :</label>
            </p>
            <span class="boxleft bold">Nom : </span> <span class="inputs">{{ $fname }}</span>&nbsp; &nbsp;
            <span class="boxleft bold">Prénom : </span> <span class="inputs">{{ $lname }}</span>&nbsp; &nbsp;
            <span class="boxleft bold">Né(e) le : </span> <span class="inputs">{{ $datebird }}</span>&nbsp; &nbsp;
            <span class="boxleft bold">Adresse: </span> <span class="inputs">{{ $adresse  }}</span>&nbsp; &nbsp;
            <span class="boxleft bold">Code postal : </span> <span class="inputs"> {{ $cp }}</span>&nbsp; &nbsp;
            <span class="boxleft bold">Ville : </span> <span class="inputs">{{ $city }}</span>&nbsp; &nbsp;
            <span class="boxleft bold">Tél : </span> <span class="inputs">{{ $phone }}</span>&nbsp; &nbsp;
            <span class="boxleft bold">Mobile : </span> <span class="inputs">{{ $phone }}</span>
            <span class="boxleft bold">E-Mail : </span> <span class="inputs">{{ $mail }}</span>
        </div>

        <div class="box radiudiv">
            <p class="bold txt-cntr"> GARANTIES </p>
            <p>
                <input type="checkbox" class="chx">
                <label class="checkbox-label bold">LES GARANTIES SOUSCRITES : L’assuré, à jour de ses cotisations, béneficie d’une prise en charge du paiement des factures en cas de
                réparation* suite à la réalisation de l’un des risques suivants, mentionnés dans la notice d’information du contrat N°01049859 : </label>
                <p class="bold">- fuite d’eau intérieure ou extérieure<br/>
                - panne de l’installation électrique,<br/>
                - disfonctionnement de votre chaudière, chauffe-eau,<br/>
                * L’assureur prend en charge, dans la limite des montants ci-dessous, vos frais de réparation en cas de :<br/>
                1. fuite d’eau intérieure ou extérieure (Intérieure : fuite ou engorgement sur circuit d’évacuation, de chauffage, ballon, sanitaires et
                raccordement des appareils avec prise en charge des réparations : 600 € par sinistre et par année d’assurance); Extérieure : fuite ou engorgement
                sur circuit d’alimentation en eau ou sur circuit d’évacuation avec prise en charge des réparations : 1 000 € par sinistre et par année d’assurance).<br/>
                2. panne de l’installation électrique (Panne électrique sur câblage, tableau électrique, prises, interrupteurs, plafonniers et appliques avec prise
                en charge des réparations : 600 € par sinistre et par année d’assurance).<br/>
                3. disfonctionnement de votre chaudière (Panne accidentelle provoquant l’interruption ou le dysfonctionnement de la chaudière ou du
                chauffe-eau avec prise en charge des réparations : 600 € par sinistre et par année d’assurance).
                L’ensemble des sinistres pris en charge est limité à deux (2) par année d’assurance.</p>
                <input type="checkbox" class="chx">
                <label class="checkbox-label">Je reconnais avoir reçu lors de l’adhésion la fiche IPID, la notice d’information valant conditions générales et avoir répondu en toute sincérité à
                la fiche d’information et de conseil.</label>
            </p>      
        </div>

        <div class="box radiudiv">
            <p class="bold"> ASSUREUR : Contrat souscrit par SPHINX AFFINITY auprès d’AREAS, (Société d’assurance mutuelle, 47-49 rue de Miromesnil 75390 Paris cedex. Société immatriculée au Registre du
            Commerce et des Sociétés de Paris sous le n° 775 670 466), distribué par l’INTERMEDIAIRE D’ASSURANCE : BAILEY ASSURANCES N° Orias : 18004781 SIREN 820 472 553 RCS Caen - Louvigny
            14111, 9 chemin des carreaux. Entreprises régies par le code des assurances et soumises à l’Autorité de Contrôle Prudentiel et de Résolution (A.C.P.R) 4 place de Budapest, CS 92459 -
            75009 PARIS. </p>       
        </div>

        <div class="box radiudiv">
            <p class="bold txt-cntr"> CONDITION </p>
            <input type="checkbox" class="chx">
            <label class="checkbox-label bold">En signant ce bulletin d’adhesion:</label>
            <p><span>J’atteste disposer de la capacité nécessaire à la conclusion et à l’exécution du présent contrat.
            Je reconnais avoir reçu et pris connaissance des principales dispositions du contrat collectif n° 01048959 et je demande à adhérer à ce contrat.
            J’accepte les conditions générales d’assurance, dont l’article 3 de la notice d’information du contrat n° 01048959 relatif à la durée du présent
            bulletin d’adhesion et des conditions de résiliation.<br/>
            Je confirme ma souscription aux garanties de prise en charge du paiement des factures en cas de réparation* moyennant un abonnement</span> 
            <span class="bold">TTC (11.90 € de prime d’assurance TAC + 2 € de frais de dossier) par mois , avec un engagement de 12 mois, ensuite résiliable à tout moment et
            renouvelable par tacite reconduction.</span></p>   
            <p><span>Fait à : {{ $city }}</span>  &nbsp; &nbsp; <span>Signature :</span> <span>Le : {{ $date }}</span></p>
        </div>
        <br/><br/>
        <div class="box radiudiv">
            <p class="bold txt-cntr"> MANDAT DE PRÉLÈVEMENT SEPA </p>
            <p>L’adhésion dure un an (1 an) et se renouvelle tacitement à chaque échéance annuelle. En cas de litige sur un prélèvement, je pourrai en faire suspendre l’exécution par
            simple demande à l’établissement de mon compte. Je règlerais le différent directement avec le créancier. Avec ce mandat, vous autorisez BAILEY ASSURANCES à envoyer
            des instructions à votre banque pour débiter votre compte, et votre banque à débiter votre compte conformément aux instructions de BAILEY ASSURANCES.</p>
            <table style="width:16.8cm;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size:10px;">
                <tbody>
                    <tr>
                        <td align="center" style="width:4cm;">
                            <div class="box styledzone">
                                <p><span  class="txtgray">Nom du Créancier</span><br/><span class="bold">BAILEY ASSURANCES MON ASSURANCE PGE</span></p>
                                <p><span  class="txtgray">Adresse</span><br/><span class="bold">Louvigny 14111, 9 chemin des carreaux</span></p>
                                <p><span  class="txtgray">Identifiant créancier SEPA</span><br/><span class="bold">FR46ZZZ8119E9</span></p>
                                <p><span  class="txtgray">Type de prélèvement</span><br/><span class="bold">Récurrent</span></p>
                                 Le <input type="checkbox" class="chx">
                                <label class="checkbox-label bold">5 </label>
                                <input type="checkbox" class="chx">
                                <label class="checkbox-label bold">10 </label>                            </div>
                        </td>
                        <td align="center" style="width:12cm;">
                            <div class="box styledzone">
                                <p class="bold">Coordonnées bancaires du débiteur</p>
                                <p><span">BIS: </span></span> <span class="inputs">{{ $bic }}</span></p>
                                <p><span>IBAN: </span></span> <span class="inputs">{{ $iban  }}</span></p>
                                <p class="bold">Vos coordonnées personnelles</p>
                                <p> <span class="boxleft">Nom : </span> <span class="inputs">{{ $fname }}</span>&nbsp; &nbsp;
                                <span class="boxleft">Prénom : </span> <span class="inputs">{{ $lname }}</span>&nbsp; &nbsp;
                                <span class="boxleft">Adresse : </span> <span class="inputs">{{ $adresse }}</span>&nbsp; &nbsp;
                                <span class="boxleft">Numéro de téléphone : </span> <span class="inputs">{{ $phone }}</span>&nbsp; &nbsp;</p>
                                <p class="boxleft">Fait à : {{ $city }}</p>
                                <p class="boxleft">Le : {{ $date }}</p>
                                <p class="boxleft">Signature :</p>
                            </div>                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p>Vous bénéficiez du droit d’être remboursé par votre banque selon les conditions décrites dans la convention que vous avez passée avec elle. Une demande de remboursement
        doit être présentée dans les 8 semaines suivant la date de débit de votre compte pour un prélèvement autorisé. Vos droits concernant le présent mandat sont expliqués dans
        un document que vous pouvez obtenir auprès de votre banque. EXEMPLAIRE FOURNISSEUR</p>
    </main>

</body>
</html>