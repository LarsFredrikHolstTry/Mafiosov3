<div hx-get="actions/family/family.php" hx-trigger="click" hx-target="#container" hx-swap="outerHTML" class="fake-link cursor-pointer">
    Tilbake til familieoversikt
</div>
<p class="mt-2 text-muted">
    Ved å erklære krig vil alle i din familie være i fare. Tjen krigspoeng ved å stjele
    fra den rivaliserende familien, drep medlemmer eller drep underboss eller bossen.
    Merk at det kun er boss som kan erklære krig mot en annen familie.
</p>

<div class="container-tight py-4">
    <div class="mb-3">
        <div hx-get="actions/family/familyWarPage.php" id="familyWarUpdate" hx-trigger="load, familyWarUpdate"></div>
    </div>
</div>