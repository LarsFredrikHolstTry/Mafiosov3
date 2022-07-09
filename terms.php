<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mafioso v3 - Vilkår</title>

  <!-- HTMX -->
  <script src="https://unpkg.com/htmx.org@1.3.3"></script>

  <!-- Ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Flat Icon interface icons -->
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css" />

  <!-- Tabler css and JS -->
  <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/@tabler/core@1.0.0-beta10/dist/css/tabler-flags.min.css" />

  <!-- Local styling -->
  <link rel="stylesheet" href="styling/styling.css" />
  <link rel="icon" type="image/x-icon" href="img/logo/favicon.ico" />
  <noscript>Javascript is required to run
    Mafioso.</noscript>
</head>

<body class="border-primary d-flex flex-column theme-dark" cz-shortcut-listen="true">
  <div class="page-body">
    <div class="container-xl">
      <div class="card card-lg">
        <div class="card-body">
          <div class="space-y-4">
            <a href="register.php">Tilbake til registreringssiden</a>

            <div>
              <h2 class="mb-3">
                Generelle vilkår
              </h2>
              <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                <div class="accordion-item">
                  <div class="accordion-header" role="tab">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-1-1" aria-expanded="false">
                      Om Mafioso
                    </button>
                  </div>
                  <div id="faq-1-1" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-1">
                    <div class="accordion-body pt-0">
                      <div>
                        <p>
                          Mafioso er et tekstbasert mafiaspill. Alt som skjer i spillet er kun ment for underholdning og skal på ingen måte oppfordre til
                          å utføre kriminelle handlinger i det virkelige liv.
                        </p>
                        <p>Spillet har en anbefalt aldersgrense på 15+, men spillet kan spilles med tillatelse fra foresatte.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <div class="accordion-header" role="tab">
                    <button class="accordion-button collapsed " data-bs-toggle="collapse" data-bs-target="#faq-1-2" aria-expanded="false">
                      Generelle regler
                    </button>
                  </div>
                  <div id="faq-1-2" class="accordion-collapse collapse show" role="tabpanel" data-bs-parent="#faq-1">
                    <div class="accordion-body pt-0">
                      <div>
                        <p>Vi velger å følge kardemommeloven som en generell lov;
                          <cite>Man skal ikke plage andre, man skal være grei og snill, og for øvrig kan man gjøre hva man vil.</cite>
                          <br>
                          Det er heller ikke lov å benytte seg av bot eller andre tredjepartsprogrammer for å automatisere spillopplevelsen.
                          <br>
                          Det er forbudt å ha mer enn 1 aktiv spiller. Dersom din bruker blir drept av en annen mafioso har du lov å
                          opprette ny bruker med samme e-post som du brukte på den forrige bruker.
                          <br>
                          Dersom du blir utestengt fra spillet på grunn av regelbrudd er du i hovedsak ikke velkommen til å lage ny bruker
                          og e-post adressen (og eller IP-adressen) din kan bli svartelistet.
                          <br>
                          Vanlig protokoll er å alltid gi advarsel til brukere før utestengelse.
                          <br>
                          Dersom det er mistanke om juks kan ledelsen velge å utestenge spilleren på bestemt eller ubestemt tid.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <div class="accordion-header" role="tab">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-1-3" aria-expanded="false">
                      Innsamling av data
                    </button>
                  </div>
                  <div id="faq-1-3" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-1">
                    <div class="accordion-body pt-0">
                      <div>
                        <p>Innsamling av data utføres kun for å enten avdekke juks eller ved godkjenning av bruker.<br>
                          Mafioso samler inn IP-adresser for å sjekke om en bruker har flere enn 1 tillatt bruker.<br>
                          Mafioso samler inn E-post adressen ved registrering for å kunne aktivere brukeren sin.
                          Vi selger ikke videre din E-post og sjekker helle ikke din E-post adresse i vårt admin panel.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <div class="accordion-header" role="tab">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-1-4" aria-expanded="false">
                      Utestenging av bruker
                    </button>
                  </div>
                  <div id="faq-1-4" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-1">
                    <div class="accordion-body pt-0">
                      <div>
                        <p>Dersom man velger å bryte noen av de generelle reglene vil man få straff. Enten i følge av utestengelse fra mafioso på
                          bestemt eller ubestemt tid, eller utestenging fra kommunikasjon i spillet.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>