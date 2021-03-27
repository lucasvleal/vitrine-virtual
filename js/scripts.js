/*!
    * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
*/  

    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    // HABILITAR/DESABILITAR PREÇO ANTIGO:begin -------
        // By Default Disable radio button

        // $("#inputPrecoAntigo").attr('disabled', true);
        // $("#inputPrecoAntigo").attr('value', 0.0);

        $("#inputPrecoAntigo").css('opacity', '.2'); // This line is used to lightly hide label for disable radio buttons.
        
        // Disable radio buttons function on Check Disable radio button.
        $("form input:radio").change(function() {
        if ($(this).val() == "nao") {
            // $("#inputPrecoAntigo").attr('checked', false);
            // $("#inputPrecoAntigo").attr('disabled', true);
            $("#inputPrecoAntigo").css('opacity', '.2');
        }
        // Else Enable radio buttons.
        else if ($(this).val() == "sim"){
            // $("#inputPrecoAntigo").attr('disabled', false);
            // $("#inputPrecoAntigo").removeAttr('value');
            $("#inputPrecoAntigo").css('opacity', '1');
        }
        });
    // HABILITAR/DESABILITAR PREÇO ANTIGO:end -------
})(jQuery);
