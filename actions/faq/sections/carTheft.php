<?php

include '../../functions/cars.php';

?>

<div>
    <h2 class="mb-3">2. Biltyveri</h2>
    <div id="faq-2" class="accordion" role="tablist" aria-multiselectable="true">
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-2-1">Biltyveri</button>
            </div>
            <div id="faq-2-1" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-2">
                <div class="accordion-body pt-0">
                    <div>
                        <p>um in iste iure maiores nemo recusandae rerum saepe sed, sunt totam! Explicabo, ipsa?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-2-2">Biler</button>
            </div>
            <div id="faq-2-2" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-2">
                <div class="accordion-body pt-0">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Bilmerke</th>
                                        <th>Klasse</th>
                                        <th>Pris</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php

                                    for ($i = 0; $i < count($car_name); $i++) {

                                    ?>
                                        <tr>
                                            <td><?= $car_name[$i]; ?></td>
                                            <td class="text-muted">
                                                Klasse Lorem
                                            </td>
                                            <td class="text-muted">
                                                <?= number($car_price[$i]) ?> kr
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>