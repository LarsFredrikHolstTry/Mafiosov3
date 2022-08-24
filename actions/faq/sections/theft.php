<?php

include '../../functions/things.php';

?>

<div>
    <h2 class="mb-3">4. Brekk</h2>
    <div id="faq-4" class="accordion" role="tablist" aria-multiselectable="true">
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-4-1">Biltyveri</button>
            </div>
            <div id="faq-4-1" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-4">
                <div class="accordion-body pt-0">
                    <div>
                        <p>
                            Via brekk kan du stjele ting fra forskjellige alternativ.
                            Tingene du stjeler via brekk kan brukes for å opprette små firmaer
                            som man kan tjene passiv inntekt på.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-4-2">Ting</button>
            </div>
            <div id="faq-4-2" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-4">
                <div class="accordion-body pt-0">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th style="width: 33%;">Ting</th>
                                        <th style="width: 33%;">Alternativ</th>
                                        <th style="width: 33%;">Pris</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $alt = 1;
                                    for ($i = 0; $i < count($thing_name); $i++) {
                                        if ($i != 0 && $i % 8 == 0) {
                                            $alt++;
                                        }

                                    ?>
                                        <tr>
                                            <td><?= $thing_name[$i]; ?></td>
                                            <td class="text-muted">
                                                <?= $alt ?>
                                            </td>
                                            <td class="text-muted">
                                                <?= number($thing_price[$i]) ?> kr
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