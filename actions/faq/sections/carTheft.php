<?php

include '../../functions/cars.php';
include '../../actions/carTheft/carTheftVariables.inc.php';

?>

<div>
    <h2 class="mb-3">3. Biltyveri</h2>
    <div id="faq-3" class="accordion" role="tablist" aria-multiselectable="true">
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-3-1">Biltyveri</button>
            </div>
            <div id="faq-3-1" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-3">
                <div class="accordion-body pt-0">
                    <div>
                        <p>
                            Via biltyveri kan du stjele biler i forskjellige klasser.
                            Klassenavnene samsvarer med klassenavnene på biltyveriet.
                            Når du stjeler en bil hender det at den blir skadet og det vil trekke verdien på bilen.
                            Spezial class biler kan stjeles fra R-klasse og har en 0,1% sjanse.
                            En Spezial Class bil vil aldri ha skade på seg.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-3-2">Biler</button>
            </div>
            <div id="faq-3-2" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-3">
                <div class="accordion-body pt-0">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th style="width: 33%;">Bilmerke</th>
                                        <th style="width: 33%;">Klasse</th>
                                        <th style="width: 33%;">Pris</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php

                                    $class = 0;
                                    for ($i = 0; $i < count($car_name); $i++) {
                                        if ($i != 0 && $i % 10 == 0) {
                                            $class++;
                                        }

                                    ?>
                                        <tr>
                                            <td><?= $car_name[$i]; ?></td>
                                            <td class="text-muted">
                                                <?= $carTheftArr[$class] ?? 'Spezial Class'; ?>
                                            </td>
                                            <td class="text-muted">
                                                <?= number($car_price[$i]) ?> kr
                                            </td>
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