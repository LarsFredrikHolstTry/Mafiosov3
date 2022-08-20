<?php

$family_id = $_GET['id'];

?>

<table class="table table-vcenter">
    <thead>
        <tr>
            <th>Bruker</th>
            <th>Rolle</th>
            <th>Ble medlem</th>
            <th>Endre rolle</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $stmt = DB::run("SELECT * FROM family_member WHERE FM_family_id = $family_id ORDER BY FM_role ASC");
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {

            $username = DB::run("SELECT ACC_username FROM account WHERE ACC_id = ?", [$row['FM_acc_id']])->fetchColumn();

        ?>
            <tr>
                <td><?= $username ?></td>
                <td class="text-muted"><?= $familyRoles[$row['FM_role']] ?></td>
                <td class="text-muted"><?= date_to_text($row['FM_joined']) ?></td>
                <td>
                    <div class="df aic">
                        <select class="form-select">
                            <?php for ($i = 0; $i < count($familyRoles); $i++) { ?>
                                <option value="<?= $i ?><|><?= $row['FM_acc_id'] ?>"><?= $familyRoles[$i] ?></option>
                            <?php } ?>
                            <option value="<?= $i ?><|><?= $row['FM_acc_id'] ?>">Kast ut</option>
                        </select>
                        <div class="btn ml-025">Lagre</div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>