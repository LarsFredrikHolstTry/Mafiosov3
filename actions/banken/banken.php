<div class="card col-6" id="container">
    <div class="card">
        <?php include 'alerts.inc.php'; ?>
        <div class="card-header">
            <h3 class="card-title">Banken</h3>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-blue text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-euro" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17.2 7a6 7 0 1 0 0 10"></path>
                                        <path d="M13 10h-8m0 4h8"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-muted">
                                    Saldo
                                </div>
                                <div class="font-weight-medium">
                                    15 000 000 kr
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-blue text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-euro" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17.2 7a6 7 0 1 0 0 10"></path>
                                        <path d="M13 10h-8m0 4h8"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-muted">
                                    Rentebeløp ved midnatt
                                </div>
                                <div class="font-weight-medium">
                                    1 500 kr
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-sm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-twitter text-white avatar">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <desc>Download more icon variants from https://tabler-icons.io/i/brand-twitter</desc>
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-muted">
                                    Poeng
                                </div>
                                <div class="font-weight-medium">
                                    150
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <button id="butsave" class="btn btn-primary btn-sm" type="button">Sett inn 100 000 kr</button> -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#butsave').on('click', function() {
            $.ajax({
                url: 'actions/banken/money_in.inc.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    test: 'hello world'
                },
                success: function(data) {
                    $("#money_in").show().delay(3000).fadeOut();
                }
            })
        });
    });
</script>