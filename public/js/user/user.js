!function ($) {
    $.fn.users = function (method) {

        var settings,
            table;

        // Public methods
        var methods = {
            init: function (options) {
                settings = $.extend(true, {}, $.fn.users.defaults, options);

                return this.each(function () {
                    var $this = $(this);
                    var filters = {};

                    $(".filters_keyup input").keyup(function (event) {
                        event.stopPropagation();

                        table.api().draw();
                    });

                    $(".filters select").change(function (event) {
                        event.stopPropagation();

                        table.api().draw();
                    });

                    table = $("table.table", this).dataTable($.extend(true, {}, settings.datatables, {
                        initComplete: function (settings, json) {
                            $(this).show();
                        },
                        ajax: {
                            data: function (data) {
                                $(".filters input, .filters select, .filters_keyup input").each(function () {
                                    var name = $(this).attr("name"),
                                        value = $(this).attr("type") == "checkbox"
                                            ? ($(this).is(":checked") ? $(this).val() : 0)
                                            : $(this).val();

                                    data[name] = value;
                                });
                            }
                        }
                    }));

                });
            }
        };

        var helpers = {};

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }
        else if (typeof method === "object" || !method) {
            return methods.init.apply(this, arguments);
        }
        else {
            $.error("Method " + method + " does not exist in $.users.");
        }
    };

    $.fn.users.defaults = {
        datatables: {
            autoWidth: true,
            destroy: true,
            orderable: true,
            orderCellsTop: true,
            paging: true,
            processing: true,
            searching: false,
            serverSide: true,
            stripeClasses: []
        },
        date_format: "dd.MM.yy"
    };
}(window.jQuery);

$(document).ready(function () {
    $(".users").users(admin.users);
});