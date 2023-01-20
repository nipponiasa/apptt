
{{-- date picker --}}


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



{{--option2 --}}


<div class="row">
   <div class="col-md-3 mb-5">
        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
    </div>

    <div class="col-md-9 mb-5">
    <form method="get" action="/current_dealer_recalculate">
        @csrf
        <input type="hidden" name="start" id="start" value="Hello" onchange="myFunction(this.value)">
        <input type="hidden" name="end" id="end" value="Hello" onchange="myFunction(this.value)">
        <input type="hidden" name="dealerid" id="dealerid" value= {!! $dealerid !!}>
        <button type="submit" class="btn btn-primary">Recalculate</button>
</form>
    </div>


</div>






<script type="text/javascript">
$(function() {
   var start = moment("2020-06-30", "YYYY-MM-DD");
   
    var end = moment();
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                   
                    document.getElementById("end").value = moment(end). format('YYYY-MM-DD');
                    document.getElementById("start").value = moment(start). format('YYYY-MM-DD');

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
           'This Year': [moment().startOf('year'), moment().endOf('year')],
           'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        }
   
    }, cb);
       cb(start, end);
});
</script>

