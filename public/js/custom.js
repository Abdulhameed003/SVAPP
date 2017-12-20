
        $(document).ready(function () {
            
            var yourbuttons = document.getElementsByClassName('mainbutton');
            for (var i = yourbuttons.length - 1; i >= 0; i--) {
                var currentbtn;
                yourbuttons[i].onclick = function () {
                    if (currentbtn) {
                        currentbtn.classList.remove("active");
                    }
                    this.classList.add("active");
                    currentbtn = this;
                }

            };
            
            $(document).click(function () {
                $(".dropdown-menu").hide();
            });

            $(".dropdown-menu").click(function (e) {
                e.stopPropagation();
            });

            $(".hidedropdown1").click(function () {
                $("#contentdropdown").hide();
            });
            $(".hidedropdown2").click(function () {
                $("#columndropdown").hide();
            });

            $("#showcontentdropdown").click(function () {
                $("#contentdropdown").show();
                $("#columndropdown").hide();
            });


            $("#showcolumndropdown").click(function () {
                $("#columndropdown").show();
                $("#contentdropdown").hide();
            });


            $('#examplebut').click(function (event) {
                $("#example").toggleClass("style_prevu_kit1");
                if ($("#example").hasClass("style_prevu_kit1")) {
                    $(".forfade").css("display", "block");
                    $("#examplebut").removeClass("fa-search-plus");
                    $("#examplebut").addClass("fa-remove");
                }
                if (!$("#example").hasClass("style_prevu_kit1")) {
                    $(".forfade").css("display", "none");
                    $("#examplebut").addClass("fa-search-plus");
                    $("#examplebut").removeClass("fa-remove");
                }
            });

            $('#example1but').click(function () {

                $("#example1").toggleClass("style_prevu_kit");
                if ($("#example1").hasClass("style_prevu_kit")) {
                    $(".forfade").css("display", "block");
                    $("#example1but").addClass("fa-remove");
                    $("#example1but").removeClass("fa-search-plus");
                }
                if (!$("#example1").hasClass("style_prevu_kit")) {
                    $(".forfade").css("display", "none");
                    $("#example1but").addClass("fa-search-plus");
                    $("#example1but").removeClass("fa-remove");
                }
            });

            $('#example2but').click(function () {
                $("#example2").toggleClass("style_prevu_kit2");
                if ($("#example2").hasClass("style_prevu_kit2")) {
                    $(".forfade").css("display", "block");
                    $("#example2but").addClass("fa-remove");
                    $("#example2but").removeClass("fa-search-plus");
                }
                if (!$("#example2").hasClass("style_prevu_kit2")) {
                    $(".forfade").css("display", "none");
                    $("#example2but").addClass("fa-search-plus");
                    $("#example2but").removeClass("fa-remove");
                }
            });

            $('#example3but').click(function (event) {

                $("#example3").toggleClass("style_prevu_kit1");
                if ($("#example3").hasClass("style_prevu_kit1")) {
                    $(".forfade").css("display", "block");
                    $("#example3but").addClass("fa-remove");
                    $("#example3but").removeClass("fa-search-plus");
                }
                if (!$("#example3").hasClass("style_prevu_kit1")) {
                    $(".forfade").css("display", "none");
                    $("#example3but").addClass("fa-search-plus");
                    $("#example3but").removeClass("fa-remove");
                }
            });

            $('#example4but').click(function (event) {
                $("#example4").toggleClass("style_prevu_kit");
                if ($("#example4").hasClass("style_prevu_kit")) {
                    $(".forfade").css("display", "block");
                    $("#example4but").addClass("fa-remove");
                    $("#example4but").removeClass("fa-search-plus");
                }
                if (!$("#example4").hasClass("style_prevu_kit")) {
                    $(".forfade").css("display", "none");
                    $("#example4but").addClass("fa-search-plus");
                    $("#example4but").removeClass("fa-remove");
                }
            });
            $('#example5but').click(function (event) {
                $("#example5").toggleClass("style_prevu_kit2");
                if ($("#example5").hasClass("style_prevu_kit2")) {
                    $(".forfade").css("display", "block");
                    $("#example5but").addClass("fa-remove");
                    $("#example5but").removeClass("fa-search-plus");
                }
                if (!$("#example5").hasClass("style_prevu_kit2")) {
                    $(".forfade").css("display", "none");
                    $("#example5but").addClass("fa-search-plus");
                    $("#example5but").removeClass("fa-remove");
                }

            });
            $('#example6but').click(function (event) {
                $("#example6").toggleClass("style_prevu_kit1");
                if ($("#example6").hasClass("style_prevu_kit1")) {
                    $(".forfade").css("display", "block");
                    $("#example6but").addClass("fa-remove");
                    $("#example6but").removeClass("fa-search-plus");
                }
                if (!$("#example6").hasClass("style_prevu_kit1")) {
                    $(".forfade").css("display", "none");
                    $("#example6but").addClass("fa-search-plus");
                    $("#example6but").removeClass("fa-remove");
                }
            });

            $('#example7but').click(function (event) {
                $("#example7").toggleClass("style_prevu_kit");
                if ($("#example7").hasClass("style_prevu_kit")) {
                    $(".forfade").css("display", "block");
                    $("#example7but").addClass("fa-remove");
                    $("#example7but").removeClass("fa-search-plus");
                }
                if (!$("#example7").hasClass("style_prevu_kit")) {
                    $(".forfade").css("display", "none");
                    $("#example7but").addClass("fa-search-plus");
                    $("#example7but").removeClass("fa-remove");
                }
            });
        });
    
 