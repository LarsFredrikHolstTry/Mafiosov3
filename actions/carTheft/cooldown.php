<?php

$carTheftCooldown =     DB::run("SELECT CD_carTheft FROM cooldown WHERE CD_acc_id=?", [$session_id])->fetchColumn();
