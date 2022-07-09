<?php

include '../../functions/ranks.php';

?>

<div>
    <h2 class="mb-3">2. Rank</h2>
    <div id="faq-2" class="accordion" role="tablist" aria-multiselectable="true">
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-2-1">Hvordan skaffe EXP</button>
            </div>
            <div id="faq-2-1" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-2">
                <div class="accordion-body pt-0">
                    <div>
                        <p>For å tjene EXP må man utføre slåsskamper i fight club,
                            kriminalitet, biltyveri, brekk, stjel fra bruker,
                            bryt mafiosoer ut av fengsel, utføre oppdrag eller utføre heist.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-2-2">Capo Di Tutti Capi</button>
            </div>
            <div id="faq-2-2" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-2">
                <div class="accordion-body pt-0">
                    <div>
                        <p>Dersom du får ranken Capo Di Tutti Capi uten å bli drept av en annen mafioso har du mulighet for å starte på nytt på samme bruker.
                            Da starter du med 0 exp, mister alt av biler, ting og alle dine penger. Du vil få en overførelses-ban på 4 dager og har da ikke lov å
                            sende eller motta penger fra andre spillere. Du har heller ikke lov å selge eller kjøpe objekter på markedet i denne tiden.
                            <br><br>
                            Bak ranken din vil du få et romertall på hvor mange ganger du har restartet ranken. Dersom du har restartet ranken din 4 ganger
                            vil f.eks ranken din se slik ut: Sotto Capo IV
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-2-3">Rankliste</button>
            </div>
            <div id="faq-2-3" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-2">
                <div class="accordion-body pt-0">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">Rank</th>
                                        <th style="width: 25%;">EXP fra</th>
                                        <th style="width: 25%;">EXP til</th>
                                        <th style="width: 25%;">Rankpremie</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php

                                    for ($i = 0; $i < count($rank_arr); $i++) {

                                    ?>
                                        <tr>
                                            <td><?= $rank_arr[$i]; ?></td>
                                            <td class="text-muted"><?= number($rank_from[$i]) ?></td>
                                            <td class="text-muted"><?= number($rank_to[$i]) ?></td>
                                            <td class="text-muted"><?= number($rank_prize[$i]) ?> kr</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>