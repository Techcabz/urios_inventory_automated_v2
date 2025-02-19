$(document).ready(function () {
    $("#datatable_stock").DataTable({
        dom: "frtip",

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

    $("#datatable_stock_modal").DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
    });

    var table = $("#datatable").DataTable({
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
    var table = $("#datatable1").DataTable({
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
    var table = $("#datatable2").DataTable({
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

    var table = $("#datatable3").DataTable({
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

    $("#datatable tfoot th").each(function (i) {
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

    $("#datatable2 tfoot th").each(function (i) {
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

    $("#datatable3 tfoot th").each(function (i) {
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

    $(document).ready(function () {
        $("#datatable_report").each(function () {
            var datatable_report = $(this).DataTable({
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "print",
                        text: "Print",
                        title: "RESERVATION REPORT",
                        exportOptions: {
                            columns: ":not(.exclude-print)",
                        },
                        customize: function (win) {
                            $(win.document.body)
                                .find("table")
                                .addClass("display")
                                .css("font-size", "16px");
                            $(win.document.body)
                                .find("tr:nth-child(odd) td")
                                .each(function () {
                                    $(this).css("background-color", "#D0D0D0");
                                });
                            $(win.document.body)
                                .find("h1")
                                .css("text-align", "center")
                                .css("font-size", "16px");
                            $(win.document.body)
                                .find("h1")
                                .text("RESERVATION REPORT");
                            $(win.document.body).find("h1").after("<hr>");
                            $(win.document.body)
                                .find("thead")
                                .after(
                                    '<tfoot><tr><th colspan="5"></th></tr></tfoot>'
                                );
                            $(win.document.body)
                                .find("tfoot th")
                                .css("text-align", "left");

                            var totalMyHours = table
                                .rows({ search: "applied" }) // Ensure we use filtered data
                                .data()
                                .reduce(function (acc, row) {
                                    var val = row[4]; // Assuming column 4 contains the duration
                                    var parts = val.split(" and ");
                                    var days = 0;
                                    var hours = 0;
                                    parts.forEach(function (part) {
                                        if (part.includes("day")) {
                                            days += parseInt(
                                                part.match(/\d+/)[0]
                                            );
                                        } else if (part.includes("hour")) {
                                            hours += parseInt(
                                                part.match(/\d+/)[0]
                                            );
                                        }
                                    });
                                    return acc + days * 24 + hours;
                                }, 0);

                            $(win.document.body)
                                .find("tfoot th")
                                .text("TOTAL HOURS: " + totalMyHours + "hrs")
                                .css("font-weight", "bold");
                        },
                    },
                ],
                searching: true,
                lengthChange: true,
                info: false,

                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                responsive: {
                    details: true,
                },
                drawCallback: function (settings) {
                    var api = this.api();
                    var totalMyHours = api
                        .column(4, { page: "current" })
                        .data()
                        .reduce(function (acc, val) {
                            var parts = val.split(" and ");
                            var days = 0;
                            var hours = 0;
                            parts.forEach(function (part) {
                                if (part.includes("day")) {
                                    days += parseInt(part.match(/\d+/)[0]);
                                } else if (part.includes("hour")) {
                                    hours += parseInt(part.match(/\d+/)[0]);
                                }
                            });
                            return acc + days * 24 + hours;
                        }, 0);
                    console.log("TOTAL HOURS: " + totalMyHours + "hrs");
                },
            });

            var table = datatable_report;
            var filterDepart = $("#hhdepartment");
            var venue = $("#hhvenue");
            var item = $("#hhitem");
            var fromFilter = $("#from-filter");
            var toFilter = $("#to-filter");

            $.fn.dataTable.ext.search.push(function (
                settings,
                data,
                dataIndex
            ) {
                var filterDepartValue = filterDepart.val().toLowerCase();
                var venueValue = venue.val().toLowerCase();
                var itemValue = item.val().toLowerCase();
                var fromFilterValue = fromFilter.val();
                var toFilterValue = toFilter.val();

                var rowData = table.row(dataIndex).data();
                var rowDepart = rowData[8];
                var rowVenue = rowData[9]; // Assuming venue data is in column index 9
                var rowItem = rowData[10];
                var myHours = parseInt(rowData[4]); // Parse the value to integer
                var rowDate = rowData[7];

                var fromDate = new Date(fromFilterValue);
                var toDate = new Date(toFilterValue);
                var rowDataDate = new Date(rowDate);

                var rowItemName = rowItem.split("-")[0].trim().toLowerCase();
                var rowVenueName = rowVenue.split("-")[0].trim().toLowerCase();
                console.log("RowVeneuName: " + rowVenueName);
                console.log(rowData);

                // Check date range
                var isDateValid =
                    (isNaN(fromDate.getTime()) || rowDataDate >= fromDate) &&
                    (isNaN(toDate.getTime()) || rowDataDate <= toDate);

                // Check department
                var isDepartmentValid =
                    filterDepartValue === "all" ||
                    rowDepart === filterDepartValue;

                // Check venue
                var isVenueValid =
                    venueValue === "all" || rowVenueName.endsWith(venueValue);

                // Check item
                var isItemValid =
                    itemValue === "all" || rowItemName.endsWith(itemValue);

                if (
                    isDepartmentValid &&
                    isVenueValid &&
                    isItemValid &&
                    isDateValid
                ) {
                    return true; // Row matches the filter criteria
                }

                return false;
            });

            filterDepart.on("change", function () {
                table.draw();
            });
            venue.on("change", function () {
                table.draw();
            });

            item.on("change", function () {
                table.draw();
            });

            fromFilter.on("change", function () {
                table.draw();
            });

            toFilter.on("change", function () {
                table.draw();
            });

            table.draw();
        });

        $("#datatable_report1").each(function () {
            var datatable_report1 = $(this).DataTable({
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "print",
                        text: "Print",
                        title: "RESERVATION REPORT",
                        exportOptions: {
                            columns: ":not(.exclude-print)",
                        },
                        customize: function (win) {
                            $(win.document.body)
                                .find("table")
                                .addClass("display")
                                .css("font-size", "16px");
                            $(win.document.body)
                                .find("tr:nth-child(odd) td")
                                .each(function () {
                                    $(this).css("background-color", "#D0D0D0");
                                });
                            $(win.document.body)
                                .find("h1")
                                .css("text-align", "center")
                                .css("font-size", "16px");
                            $(win.document.body)
                                .find("h1")
                                .text("TRAVEL ORDER REPORT");
                            $(win.document.body).find("h1").after("<hr>");
                            $(win.document.body)
                                .find("thead")
                                .after(
                                    '<tfoot><tr><th colspan="5"></th></tr></tfoot>'
                                );
                            $(win.document.body)
                                .find("tfoot th")
                                .css("text-align", "left");

                            var totalRegistered = table
                                .rows({ search: "applied" })
                                .count();
                            $(win.document.body)
                                .find("tfoot th")
                                .text("Total Records: " + totalRegistered)
                                .css("font-weight", "bold");
                        },
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
                drawCallback: function (settings) {
                    var api = this.api();
                    var totalMyHours = api
                        .column(4, { page: "current" })
                        .data()
                        .reduce(function (acc, val) {
                            var parts = val.split(" and ");
                            var days = 0;
                            var hours = 0;
                            parts.forEach(function (part) {
                                if (part.includes("day")) {
                                    days += parseInt(part.match(/\d+/)[0]);
                                } else if (part.includes("hour")) {
                                    hours += parseInt(part.match(/\d+/)[0]);
                                }
                            });
                            return acc + days * 24 + hours;
                        }, 0);
                    console.log("TOTAL HOURS: " + totalMyHours + "hrs");
                },
            });

            var table = datatable_report1;
            var filterDepart = $("#hhdepartment");
            var venue = $("#hhvenue");
            var item = $("#hhitem");
            var fromFilter = $("#from-filter");
            var toFilter = $("#to-filter");

            $.fn.dataTable.ext.search.push(function (
                settings,
                data,
                dataIndex
            ) {
                var filterDepartValue = filterDepart.val().toLowerCase();
                var venueValue = venue.val().toLowerCase();
                var itemValue = item.val().toLowerCase();
                var fromFilterValue = fromFilter.val();
                var toFilterValue = toFilter.val();

                var rowData = table.row(dataIndex).data();
                var rowDepart = rowData[8];
                var rowVenue = rowData[9]; // Assuming venue data is in column index 9
                var rowItem = rowData[10];
                var myHours = parseInt(rowData[4]); // Parse the value to integer
                var rowDate = rowData[7];

                var fromDate = new Date(fromFilterValue);
                var toDate = new Date(toFilterValue);
                var rowDataDate = new Date(rowDate);

                // Check date range
                var isDateValid =
                    (isNaN(fromDate.getTime()) || rowDataDate >= fromDate) &&
                    (isNaN(toDate.getTime()) || rowDataDate <= toDate);

                // Check department
                var isDepartmentValid =
                    filterDepartValue === "all" ||
                    rowDepart === filterDepartValue;

                // Check venue
                var isVenueValid =
                    venueValue === "all" || rowVenueName.endsWith(venueValue);

                // Check item
                var isItemValid =
                    itemValue === "all" || rowItemName.endsWith(itemValue);

                if (
                    isDepartmentValid &&
                    isVenueValid &&
                    isItemValid &&
                    isDateValid
                ) {
                    return true; // Row matches the filter criteria
                }

                return false;
            });

            filterDepart.on("change", function () {
                table.draw();
            });
            venue.on("change", function () {
                table.draw();
            });

            item.on("change", function () {
                table.draw();
            });

            fromFilter.on("change", function () {
                table.draw();
            });

            toFilter.on("change", function () {
                table.draw();
            });

            table.draw();
        });
    });
});
