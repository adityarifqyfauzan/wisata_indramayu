var dari_hari;
var setiap_hari;
$(document).ready(function () {

    $('#dari_hari').change(function () {
        dari_hari = $(this).children('option:selected').val();
        console.log(dari_hari);

        if (dari_hari != "") {

            $("#setiap_hari").removeAttr("checked");
            $("#setiap_hari").attr("disabled", true);
            $("#setiap_hari").attr("value", null);

        } else {

            $("#setiap_hari").removeAttr("disabled");

        }

    });

    $('#setiap_hari').change(function () {

        var attr = $(this).attr('checked');

        setiap_hari = $(this).val();
        console.log(setiap_hari);

        if (setiap_hari != "") {

            $("#dari_hari").val(null);
            $("#sampai_hari").val(null);

        }

    })


})