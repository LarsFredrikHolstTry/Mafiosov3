<?php

include '../../functions/money_ranks.php';

?>

<div>
    <h2 class="mb-3">5. Pengeranker</h2>
    <div id="faq-5" class="accordion" role="tablist" aria-multiselectable="true">
        <div class="accordion-item">
            <div class="accordion-header" role="tab">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-5-1">Pengeranker</button>
            </div>
            <div id="faq-5-1" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-5">
                <div class="accordion-body pt-0">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th style="width: 33%;">Pengerank</th>
                                        <th style="width: 33%;">Penger fra</th>
                                        <th style="width: 33%;">Penger til</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $alt = 1;
                                    for ($i = 0; $i < count($money_rank); $i++) {

                                    ?>
                                        <tr>
                                            <td><?= $money_rank[$i]; ?></td>
                                            <td class="text-muted">
                                                <?= number($money_amount_from[$i]) ?> kr
                                            </td>
                                            <td class="text-muted">
                                                <?= number($money_amount_to[$i]) ?> kr
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