<?php

include '../../global-variables.php';
include '../../db/PDODB.php';

$fightPoints = DB::run("SELECT AS_fightpoints FROM account_stat WHERE AS_id = ?", [$session_id])->fetchColumn();

$fights = DB::run("SELECT * FROM fc_fights WHERE FC_loser = $session_id OR FC_winner = $session_id")->fetchColumn();

if (!$fights) {
    echo '<div class="text-info df mb-2 jcc">Ingen tidligere slåsskamper</div>';
} else {

?>

    <div class="table-responsive">
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th>Mafioso</th>
                    <th>Resultat</th>
                    <th>Dato</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $stmt = DB::run("SELECT * FROM fc_fights WHERE FC_loser = $session_id OR FC_winner = $session_id ORDER BY FC_date DESC LIMIT 5");
                while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                    $looserOrWinner =       $row['FC_loser'] == $session_id ? $row['FC_winner'] : $row['FC_loser'];
                    $looseOrWin =           $row['FC_loser'] == $session_id ? 'Tap' : 'Vinn';
                    $username =     DB::run("SELECT ACC_username FROM account WHERE ACC_id = " . $looserOrWinner)->fetchColumn();

                ?>
                    <tr>
                        <td><?= $username ?></td>
                        <td><?= $looseOrWin ?></td>
                        <td><?= date_to_text($row['FC_date']) ?></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>