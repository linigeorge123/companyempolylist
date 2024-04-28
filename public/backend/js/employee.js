(function ($) {
    "use strict";

    $(function () {
        var _url = window.location.origin;; // Replace 'http://example.com' with your actual base URL
        $('#employees-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: _url + '/empolyee/get_data_table',
            columns: [
                {
                    data: "first_name",
                    name: "first_name"
                },
                {
                    data: "last_name",
                    name: "last_name"
                },
                {
                    data: "email",
                    name: "email"
                },
                {
                    data: "phone",
                    name: "phone"
                },
                {
                    data: "company.name",
                    name: "company.name"
                },
               
                {
                    data: "action",
                    name: "action"
                }
            ],
            responsive: true,
            bStateSave: true,
            bAutoWidth: false,
            ordering: false,
            language: {
                decimal: "",
                emptyTable: "No data found",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Show _MENU_ entries",
                loadingRecords: "Loading...",
                pageLength: 10, // Set the number of records per page to 10
                processing: "Processing...",
                search: "Search:",
                zeroRecords: "No matching records found",
                paginate: {
                    first: '<i class="fe fe-chevrons-left fe-16"></i>',
                    last: '<i class="fe fe-chevrons-right fe-16"></i>',
                    previous: '<i class="fe fe-chevron-left fe-16"></i>',
                    next: '<i class="fe fe-chevron-right fe-16"></i>'
                }
            
            
                
               
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
            }
        });
    });

})(jQuery);
