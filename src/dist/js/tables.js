$.table = function (count = true, doFooter = true) {
    if (count === true) {
        let i = 0;
        $("table tbody tr").each(function () {
            i++;
            $(this).find('td:first-child').html(i);
        });
    }
    $('table').each(function () {
        let $this = $(this);
        if ($.fn.DataTable.isDataTable($(this))) {
            $(this).DataTable().destroy();
        }
        let table = $($this);
        if ($(table).find('tfoot tr').length === 0) {
            let thead = $(table).find('thead').html();
            $(table).append('<tfoot>' + thead + '</tfoot>')
        }
        let thCount = $(this).find('thead tr th').length, tdCount = $(this).find('tbody tr:first-child td').length;
        if (thCount === tdCount) {
            let table = $(this).DataTable({
                "ordering": true,
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }],
                "language": {
                    "zeroRecords": "هیچ موردی یافت نشد",
                    "lengthMenu": "نمایش _MENU_ داده",
                    "loadingRecords": "درحال بارگزاری...",
                    "processing": "در حال پردازش...",
                    "search": "جستجو:",
                    "info": "در حال نمایش _PAGE_ صفحه از _PAGES_ صفحه",
                    "infoEmpty": "هیچ موردی وجود ندارد!",
                    "infoFiltered": "(از _MAX_ داده فیلتر شده)",
                    "paginate": {
                        "next": "بعدی",
                        "previous": "قبلی",
                    },
                },
            });
            $('table thead th').each(function () {
                if (!$(this).hasClass('no-sort')) {
                    let title = $(this).text();
                    if (title != 'عکس' && title != 'تصویر' && title != 'ردیف' && title != 'عملیات') {
                    $(this).text('');
                        $(this).attr("width", 75);
                        $(this).append('<input class="form-control" type="text" placeholder="' + title + '" />');
                    }
                }
            });
            table.columns().every(function () {
                let that = this;
                $('input', this.header()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });
};
