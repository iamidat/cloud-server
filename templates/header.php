<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Cloud Server B Praktikum Web">
<meta name="author" content="Kelas B 18">
<title>Cloud Server B</title>

<!-- Favicon -->
<link rel="icon" href="assets/img/logo/fav.png" type="image/png">

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

<!-- Icons -->
<link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
<link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

<!-- Page plugins -->
<!-- Argon CSS -->
<link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">

<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="assets/dataTables/datatables.min.css"/>
 
<!-- CropperJS -->
<link rel="stylesheet" type="text/css" href="assets/croppie/croppie.css"/>

<!-- Animate -->
<link rel="stylesheet" href="assets/vendor/animatecss/animate.min.css" type="text/css">

<!-- Upload CSS -->
<link rel="stylesheet" href="assets/css/upload.css" type="text/css">

<!-- Search UI-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.js"></script>
<link href="assets/css/search.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    $(function() {

        $("#keyword").autocomplete({
            source: "search_files.php",
            minLength: 2,
            select: function(event, ui) {
                var getUrl = ui.item.id;
                if (getUrl != '#') {
                    location.href = getUrl;
                }
            },

            html: true,

            open: function(event, ui) {
                $(".ui-autocomplete").css("z-index", 1000);
            }
        });

    });
</script>