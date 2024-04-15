<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href="assets/img/brgy-logo.png" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="assets/js/plugin/webfont/webfont.min.js"></script>
<script>
WebFont.load({
    google: {
        "families": ["Lato:300,400,700,900"]
    },
    custom: {
        "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
            "simple-line-icons"
        ],
        urls: ['assets/css/fonts.min.css']
    },
    active: function() {
        sessionStorage.fonts = true;
    }
});
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<!-- Datatables -->
<link
    href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/datatables.min.css"
    rel="stylesheet" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
<!-- Remix Icons -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
<!-- Custom -->
<link rel=" stylesheet" href="assets/css/stylesheet.css">
<link rel="stylesheet" href="assets/css/custom.css">

<style>
#loading-container {
    position: absolute;
    display: flex;
    height: 100%;
    width: 100%;
    background-color: white;
    z-index: 9999;
}

#loading-screen {
    position: absolute;
    left: 48%;
    top: 48%;
    z-index: 9999;
    text-align: center;
}
</style>