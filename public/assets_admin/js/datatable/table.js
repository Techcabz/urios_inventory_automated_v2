$(document).ready(function () {
    let tableIds = [
        "datatable3",
        "datatable2",
        "datatable1",
        "datatable",
        "datatable-pending",
        "datatable-approved",
        "datatable-cancelled",
        "datatable-completed",
    ];

    tableIds.forEach((id) => {
        if ($.fn.DataTable.isDataTable(`#${id}`)) {
            // ✅ Destroy DataTable before reinitializing
            $(`#${id}`).DataTable().destroy();
        }

        if (document.getElementById(id)) {
            $(`#${id}`).DataTable({
                dom: "l<br>Bfrtip",
                buttons: [
                    {
                        extend: "print",
                        text: "Print",
                        autoPrint: true,
                        exportOptions: {
                            columns: ":visible",
                            rows: function (idx, data, node) {
                                var dt = new $.fn.dataTable.Api("#example");
                                var selected = dt
                                    .rows({ selected: true })
                                    .indexes()
                                    .toArray();
                                if (
                                    selected.length === 0 ||
                                    $.inArray(idx, selected) !== -1
                                ) {
                                    return true;
                                } else {
                                    return false;
                                }
                            },
                        },

                        customize: function (win) {
                            $(win.document.body)
                                .find("table")
                                .addClass("display")
                                .css("font-size", "9px");
                            $(win.document.body)
                                .find("tr:nth-child(odd) td")
                                .each(function (index) {
                                    $(this).css("background-color", "#D0D0D0");
                                });
                            $(win.document.body)
                                .find("h1")
                                .css("text-align", "center");
                        },
                    },

                    "excel",
                    "pdf",
                    "colvis",
                ],

                responsive: {
                    details: true,
                    breakpoints: [
                        { name: "desktop", width: Infinity },
                        { name: "tablet", width: 1024 },
                        { name: "fablet", width: 768 },
                        { name: "phone", width: 480 },
                    ],
                },
                language: {
                    paginate: {
                        first: "First",
                        previous: "Previous",
                        next: "Next",
                        last: "Last",
                    },
                },
                select: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                columnDefs: [{ orderable: false, targets: "_all" }],
            });
        }
    });

    var table = $("#datatable-def").DataTable({
        dom: "l<br>Bfrtip",
        buttons: [
            {
                extend: "print",
                text: "Print",
                autoPrint: true,
                exportOptions: {
                    columns: ":visible",
                    rows: function (idx, data, node) {
                        var dt = new $.fn.dataTable.Api("#example");
                        var selected = dt
                            .rows({ selected: true })
                            .indexes()
                            .toArray();
                        if (
                            selected.length === 0 ||
                            $.inArray(idx, selected) !== -1
                        ) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                },

                customize: function (win) {
                    $(win.document.body)
                        .find("table")
                        .addClass("display")
                        .css("font-size", "9px");
                    $(win.document.body)
                        .find("tr:nth-child(odd) td")
                        .each(function (index) {
                            $(this).css("background-color", "#D0D0D0");
                        });
                    $(win.document.body).find("h1").css("text-align", "center");
                },
            },

            "excel",
            "pdf",
            "colvis",
        ],

        language: {
            paginate: {
                first: "First",
                previous: "Previous",
                next: "Next",
                last: "Last",
            },
        },
        select: true,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
        columnDefs: [{ orderable: false, targets: "_all" }],
    });

    $("#datatable-def tfoot th").each(function (i) {
        if ($(this).text() !== "") {
            var isStatusColumn = $(this).text() == "Status" ? true : false;
            var select = $('<select><option value=""></option></select>')
                .appendTo($(this).empty())
                .on("change", function () {
                    var val = $(this).val();

                    table
                        .column(i)
                        .search(
                            val ? "^" + $(this).val() + "$" : val,
                            true,
                            false
                        )
                        .draw();
                });

            // Get the Status values a specific way since the status is a anchor/image
            if (isStatusColumn) {
                var statusItems = [];

                /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
                table
                    .column(i)
                    .nodes()
                    .to$()
                    .each(function (d, j) {
                        var thisStatus = $(j).attr("data-filter");
                        if ($.inArray(thisStatus, statusItems) === -1)
                            statusItems.push(thisStatus);
                    });

                statusItems.sort();

                $.each(statusItems, function (i, item) {
                    select.append(
                        '<option value="' + item + '">' + item + "</option>"
                    );
                });
            }
            // All other non-Status columns (like the example)
            else {
                table
                    .column(i)
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                        select.append(
                            '<option value="' + d + '">' + d + "</option>"
                        );
                    });
            }
        }
    });

    $("#datatable_report").each(function () {
        var table = $("#datatable_report").DataTable({
            dom: "Brtip",
            buttons: [
                {
                    extend: "print",
                    text: "Print",
                    title: "FUAMI BORROWING REPORT",
                    exportOptions: { columns: ":not(.exclude-print)" },
                },
            ],
            searching: true,
            lengthChange: true,
            info: false,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            responsive: {
                details: true,
                breakpoints: [
                    { name: "desktop", width: Infinity },
                    { name: "tablet", width: 1024 },
                    { name: "fablet", width: 768 },
                    { name: "phone", width: 480 },
                ],
            },
        });

        var filterType = $("#filter-status");
        var monthFilter = $("#month");
        var weekFilter = $("#week-filter");

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            var typefilterValue = filterType.val().toLowerCase();
            var monthFilterValue = monthFilter.val().toLowerCase();
            var weekFilterValue = weekFilter.val();

            var rowData = table.row(dataIndex).data();
            var rowStatus = rowData[4].toLowerCase();
            var rowDate = new Date(rowData[3]);
            var rowMonth = convertDateToMonthName(rowDate).toLowerCase();
            var rowWeek = getWeekNumber(rowDate);

            console.log(rowData[3])
            if (
                typefilterValue !== "all" &&
                !rowStatus.includes(typefilterValue)
            ) {
                return false;
            }

            if (monthFilterValue !== "all" && rowMonth !== monthFilterValue) {
                return false;
            }

            if (
                weekFilterValue !== "all" &&
                rowWeek !== parseInt(weekFilterValue)
            ) {
                return false;
            }

            return true;
        });

        function convertDateToMonthName(date) {
            return date.toLocaleString("en-US", { month: "long" });
        }

        function getWeekNumber(date) {
            var firstDayOfMonth = new Date(
                date.getFullYear(),
                date.getMonth(),
                1
            );
            var dayOfWeek = firstDayOfMonth.getDay();
            var weekNumber = Math.ceil((date.getDate() + dayOfWeek) / 7);
            return weekNumber;
        }

        filterType.on("change", function () {
            table.draw();
        });
        monthFilter.on("change", function () {
            table.draw();
        });
        weekFilter.on("change", function () {
            table.draw();
        });

        table.draw();
    });
});
