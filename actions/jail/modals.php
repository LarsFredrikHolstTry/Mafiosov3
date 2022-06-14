<div class="modal modal-blur fade" id="modal-small" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Er du sikker?</div>
                <div>Er du sikker på at du vil kjøpe fengselet i <?= $city[$city_name] ?> for 1 000 000kr?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Avbryt</button>
                <button type="button" id="buy_jail" class="btn btn-success" data-bs-dismiss="modal">Kjøp</button>
            </div>
        </div>
    </div>
</div>