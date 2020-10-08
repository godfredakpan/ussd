'use strict';

(function($) {

    var wind_ = $(window),
        body_ = $('body');

    /*------------- waves effect -------------*/
    Waves.init({
        duration: 300
    });
    Waves.attach('.btn:not(.btn-badge)', ['waves-button', 'waves-light']);


    feather.replace();

    /*------------- create overlay -------------*/
    $.createOverlay = function() {
        if ($('.overlay').length < 1) {
            body_.addClass('no-scroll').append('<div class="overlay"></div>');
            $('.overlay').addClass('show');
        }
    };
    /*------------- create overlay -------------*/

    $('.dropdown-menu a[data-toggle="dropdown"]').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });

    $('[data-backround-image]').each(function(e) {
        $(this).css("background", 'url(' + $(this).data('backround-image') + ')');
    });

    /*------------- page loader -------------*/
    // wind_.on('load', function () {
    //     $('.page-loader').fadeOut(700, function () {
    //         setTimeout(function () {
    //             toastr.options = {
    //                 timeOut: 3000,
    //                 progressBar: true,
    //                 showMethod: "slideDown",
    //                 hideMethod: "slideUp",
    //                 showDuration: 200,
    //                 hideDuration: 200
    //             };
    //             toastr.success('Welcome! Kenneth Hune.');
    //         }, 1000);
    //     });

    // });
    /*------------- page loader -------------*/

    /*------------- side menu (sub menü arrow) -------------*/
    wind_.on('load', function() {
        setTimeout(function() {
            $('.side-menu .side-menu-body ul li a').each(function() {
                var $this = $(this);
                if ($this.next('ul').length) {
                    if (body_.hasClass('horizontal-side-menu')) {
                        $this.append('<i class="sub-menu-arrow ti-angle-right"></i>');
                        $('.side-menu .side-menu-body > ul > li > a > .sub-menu-arrow').removeClass('ti-angle-right').addClass('ti-angle-down');
                    } else {
                        $this.append('<i class="sub-menu-arrow ti-plus"></i>');
                    }
                }
            });
            $('.side-menu .side-menu-body ul li.open>a>.sub-menu-arrow').removeClass('ti-plus').addClass('ti-minus').addClass('rotate-in');
        }, 200);
    });
    /*------------- side menu (sub menü arrow) -------------*/

    /*------------- sidebar show/hide -------------*/
    $(document).on('click', '.sidebar-open', function() {

        $('[data-toggle="dropdown"]').dropdown('hide');
        var $sidebar = $('.sidebar');
        $sidebar.toggleClass('show');
        $.createOverlay();
        return false;
    });
    /*------------- sidebar show/hide -------------*/

    $(document).on('click', '*', function(e) {
        if (
            (!$(e.target).is('.sidebar, .sidebar *, .sidebar-open, .sidebar-open *') && $('.sidebar').hasClass('show')) ||
            (!$(e.target).is('.search-panel-open, .search-panel-open *, nav.navbar .header-body form.search, nav.navbar .header-body form.search *') && $('nav.navbar .header-body form.search').hasClass('show')) ||
            (!$(e.target).is('.side-menu-open, .side-menu-open *, .side-menu, .side-menu *') && $('.side-menu').hasClass('show'))
        ) {
            $('.sidebar').removeClass('show');
            $('nav.navbar .header-body form.search').removeClass('show');
            $('.side-menu').removeClass('show');
            body_.removeClass('no-scroll');
            $('.overlay').remove();
        }
    });
    /*------------- sidebar show/hide -------------*/

    /*------------- mobile search panel open -------------*/
    $(document).on('click', '.search-panel-open', function() {
        $('nav.navbar form.search')
            .addClass('show')
            .find('input:first')
            .focus();
        $.createOverlay();
        return false;
    });
    /*------------- mobile search panel open -------------*/

    /*------------- mobile or hidden side menu open -------------*/
    $(document).on('click', '.side-menu-open', function() {
        $('[data-toggle="dropdown"]').dropdown('hide');
        $('.side-menu').addClass('show');
        $.createOverlay();
        return false;
    });
    /*------------- mobile or hidden side menu open -------------*/

    /*------------- form validation -------------*/
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
    /*------------- form validation -------------*/

    /*------------- responsive html table -------------*/
    var table_responsive_stack = $(".table-responsive-stack");
    table_responsive_stack
        .find("th")
        .each(function(i) {
            $(".table-responsive-stack td:nth-child(" + (i + 1) + ")").prepend(
                '<span class="table-responsive-stack-thead">' +
                $(this).text() +
                ":</span> "
            );
            $(".table-responsive-stack-thead").hide();
        });

    table_responsive_stack.each(function() {
        var thCount = $(this).find("th").length,
            rowGrow = 100 / thCount + "%";
        $(this).find("th, td").css("flex-basis", rowGrow);
    });

    function flexTable() {
        if (wind_.width() < 768) {
            $(".table-responsive-stack").each(function(i) {
                $(this)
                    .find(".table-responsive-stack-thead")
                    .show();
                $(this)
                    .find("thead")
                    .hide();
            });

            // window is less than 768px
        } else {
            $(".table-responsive-stack").each(function(i) {
                $(this)
                    .find(".table-responsive-stack-thead")
                    .hide();
                $(this)
                    .find("thead")
                    .show();
            });
        }
    }

    flexTable();
    initCustomScrollbar();

    window.onresize = function(event) {
        flexTable();
        initCustomScrollbar('resize');
    };
    /*------------- responsive html table -------------*/

    /*------------- custom accordion -------------*/
    $(document).on('click', '.accordion.custom-accordion .accordion-row a.accordion-header', function() {
        var $this = $(this);
        $this.closest('.accordion.custom-accordion').find('.accordion-row').not($this.parent()).removeClass('open');
        $this.parent('.accordion-row').toggleClass('open');
        return false;
    });
    /*------------- custom accordion -------------*/

    /*------------- responsive table dropdown -------------*/
    var dropdownMenu,
        table_responsive = $('.table-responsive');

    table_responsive.on('show.bs.dropdown', function(e) {
        dropdownMenu = $(e.target).find('.dropdown-menu');
        body_.append(dropdownMenu.detach());
        var eOffset = $(e.target).offset();
        dropdownMenu.css({
            'display': 'block',
            'top': eOffset.top + $(e.target).outerHeight(),
            'left': eOffset.left,
            'width': '184px',
            'font-size': '14px'
        });
        dropdownMenu.addClass("mobPosDropdown");
    });

    table_responsive.on('hide.bs.dropdown', function(e) {
        $(e.target).append(dropdownMenu.detach());
        dropdownMenu.hide();
    });
    /*------------- responsive table dropdown -------------*/

    /*------------- chat -------------*/
    $(document).on('click', '.chat-app-wrapper .btn-chat-sidebar-open', function() {
        $('.chat-app-wrapper .chat-sidebar').addClass('chat-sidebar-opened');
        return false;
    });

    $(document).on('click', '*', function(e) {
        if (!$(e.target).is('.chat-app-wrapper .chat-sidebar, .chat-app-wrapper .chat-sidebar *, .chat-app-wrapper .btn-chat-sidebar-open, .chat-app-wrapper .btn-chat-sidebar-open *')) {
            $('.chat-app-wrapper .chat-sidebar').removeClass('chat-sidebar-opened');
        }
    });
    /*------------- chat -------------*/

    /*------------- aside menu toggle -------------*/
    $(document).on('click', '.side-menu ul li a', function() {
        var $this = $(this);
        if ($this.next('ul').length) {
            var sub_menu_arrow = $this.find('.sub-menu-arrow');
            sub_menu_arrow.toggleClass('rotate-in');
            $this.next('ul').toggle(200);
            $this.parent('li').siblings().find('ul').not($this.parent('li').find('ul')).slideUp(200);
            $this.next('ul').find('li ul').slideUp(200);
            $this.next('ul').find('li>a').find('.sub-menu-arrow').removeClass('ti-minus').addClass('ti-plus');
            $this.next('ul').find('li>a').find('.sub-menu-arrow').removeClass('rotate-in');
            $this.parent('li').siblings().not($this.parent('li').find('ul')).find('>a').find('.sub-menu-arrow').removeClass('ti-minus').addClass('ti-plus');
            $this.parent('li').siblings().not($this.parent('li').find('ul')).find('>a').find('.sub-menu-arrow').removeClass('rotate-in');
            if (sub_menu_arrow.hasClass('rotate-in')) {
                setTimeout(function() {
                    sub_menu_arrow.removeClass('ti-plus').addClass('ti-minus');
                }, 200);
            } else {
                sub_menu_arrow.removeClass('ti-minus').addClass('ti-plus');
            }
            if (!body_.hasClass('horizontal-side-menu') && wind_.width() >= 768) {
                setTimeout(function(e) {
                    $('.side-menu>div>ul').getNiceScroll().resize();
                }, 300);
            }
            return false;
        }
    });

    $('body.icon-side-menu .side-menu').hover(function(e) {}, function(e) {
        e.stopPropagation();
        $('.side-menu ul').removeAttr('style');
        $('.side-menu ul li').not('.open').find('>a>.sub-menu-arrow').removeClass('rotate-in').removeClass('ti-minus').addClass('ti-plus');
    });
    /*------------- aside menu toggle -------------*/

    /*------------- other -------------*/
    $(document).on('click', '.dropdown-menu', function(e) {
        e.stopPropagation();
    });

    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget),
            recipient = button.data('whatever'),
            modal = $(this);

        modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('.modal-body input').val(recipient);
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('[data-toggle="popover"]').popover();

    $('.carousel').carousel();

    if (body_.hasClass('icon-side-menu')) {
        $('.side-menu').hover(function(e) {
            $('.side-menu').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
                $('.side-menu>div>ul').niceScroll();
            });
        });
    }

    function initCustomScrollbar(type) {

        type = type ? type : '';

        if (type == 'resize') {
            if (wind_.width() >= 768) {
                $('.card-scroll').getNiceScroll().resize();
            }

            if (
                (!body_.hasClass('horizontal-side-menu') && wind_.width() >= 992) ||
                body_.hasClass('horizontal-side-menu') && wind_.width() < 992
            ) {
                if (wind_.width() >= 768) {
                    $('.side-menu>div>ul').getNiceScroll().resize();
                }
            }

            $('.card').each(function() {
                if (wind_.width() >= 768) {
                    var $this = $(this),
                        scroll_div = $this.find('.card-scroll');
                    if (scroll_div.length) {
                        scroll_div.getNiceScroll().resize();
                    }
                }
            });

            $('.sidebar .tab-content .tab-pane').each(function() {
                if (wind_.width() >= 768) {
                    var $this = $(this);
                    $this.find('.tab-pane-body').getNiceScroll().resize();
                }
            });

            $('.dropdown-menu').each(function() {
                if (typeof $('.dropdown-menu-body', this)[0] != 'undefined' && wind_.width() >= 768) {
                    $('.dropdown-menu-body', this).getNiceScroll().resize();
                }
            });

            if (wind_.width() >= 768) {
                $('.chat-app .chat-sidebar .chat-sidebar-messages')[0] ? $('.chat-app .chat-sidebar .chat-sidebar-messages').getNiceScroll().resize() : '';

                $('.chat-app .chat-body .chat-body-messages')[0] ? $('.chat-app .chat-body .chat-body-messages').getNiceScroll().resize() : '';
            }

        } else {
            if (wind_.width() >= 768) {
                $('.card-scroll').niceScroll();
                $('.table-responsive').niceScroll();
            }

            if (
                (!body_.hasClass('horizontal-side-menu') && wind_.width() >= 992) ||
                body_.hasClass('horizontal-side-menu') && wind_.width() < 992
            ) {
                wind_.on('load', function() {
                    if (!body_.hasClass('horizontal-side-menu') && !body_.hasClass('icon-side-menu') && wind_.width() >= 768) {
                        $('.side-menu>div>ul').niceScroll();
                    }
                });
            }

            $('.card').each(function() {
                if (wind_.width() >= 768) {
                    var $this = $(this),
                        scroll_div = $this.find('.card-scroll');
                    if (scroll_div.length) {
                        scroll_div.niceScroll();
                    }
                }
            });

            $('.sidebar .tab-content .tab-pane').each(function() {
                if (wind_.width() >= 768) {
                    var $this = $(this);
                    $this.find('.tab-pane-body').niceScroll();
                }
            });

            $('.dropdown-menu').each(function() {
                if (typeof $('.dropdown-menu-body', this)[0] != 'undefined' && wind_.width() >= 768) {
                    $('.dropdown-menu-body', this).niceScroll();
                }
            });

            if (wind_.width() >= 768) {
                $('.chat-app .chat-sidebar .chat-sidebar-messages')[0] ? $('.chat-app .chat-sidebar .chat-sidebar-messages').scrollTop($('.chat-app .chat-sidebar .chat-sidebar-messages').get(0).scrollHeight, -1).niceScroll() : '';

                $('.chat-app .chat-body .chat-body-messages')[0] ? $('.chat-app .chat-body .chat-body-messages').scrollTop($('.chat-app .chat-body .chat-body-messages').get(0).scrollHeight, -1).niceScroll() : '';
            }
        }
    }

    if (typeof CKEDITOR == 'object' && $('body').hasClass('dark')) {
        var backgroundColor = $('.card').css("background-color"),
            fontColor = $('body').css("color");
        CKEDITOR.on('instanceReady', function(e) {
            var iframe = $('iframe.cke_wysiwyg_frame');
            iframe.each(function(e) {
                var ifrm = $(this)[0];
                var iframeDocument = ifrm.contentDocument || ifrm.contentWindow.document;
                iframeDocument.body.style.backgroundColor = backgroundColor;
                iframeDocument.body.style.color = fontColor;
            });
        });
    }

})(jQuery);