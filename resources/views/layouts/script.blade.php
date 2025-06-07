
@php
    $start_date = $start_date ?? \Carbon\Carbon::now()->toDateString();
    $end_date = $end_date ?? \Carbon\Carbon::now()->toDateString();
@endphp

<!-- Moment.js -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<!-- Daterangepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Select2 JS -->
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#sku_search').select2({
            placeholder: "Search SKU...",
            allowClear: true
        });
    });
</script>


<script>
    var start = moment('{{ $start_date }}');
    var end = moment('{{ $end_date }}');

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $("#date_range").val(start.format('YYYY-MM-DD') + '_' + end.format('YYYY-MM-DD'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 3 Months': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
            'Last 6 Months': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        }
    }, cb);

    cb(start, end);

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        cb(picker.startDate, picker.endDate);
    });

    $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).find('span').html('{{ \Carbon\Carbon::parse($start_date)->format('F d, Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('F d, Y') }}');
        $("#date_range").val('');
    });
</script>