<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

?>
<table class="table table-vcenter">
    <thead>
        <tr>
            <th>Familie</th>
            <th>Medlemmer</th>
            <th>Krig</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php

        $stmt = DB::run("SELECT FA_id, FA_name, FA_member, FA_war FROM family");
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

            $members = DB::run("SELECT COUNT(*) FROM family_member WHERE FM_family_id = ?", [$row['FA_id']])->fetchColumn();

        ?>
            <tr>
                <td>
                    <div hx-get="actions/familyprofile/familyprofile.php?id=<?= $row['FA_id'] ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer" id="htmxForm">
                        <?= $row['FA_name'] ?>
                    </div>
                </td>
                <td class="text-muted"><?= $members ?> / <?= $row['FA_member'] ?></td>
                <td><?= $row['FA_war'] > 0 ? '<span class="text-warning">I krig mot ' . $row['FA_war'] . '</span>' : '<span class="text-success">Ikke i aktiv krig</span>' ?></td>
                <td>
                    <div hx-get="actions/family/family.php?application=<?= $row['FA_id'] ?>" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer" id="htmxForm">
                        Send søknad
                    </div>
                </td>
            </tr>

        <?php } ?>
    </tbody>
</table>