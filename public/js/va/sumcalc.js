/**
 * @file sumcalc.js
 * @author Dimitris Vainanidis
 */


// calculates sum of column when a datatable gets filtered
// column cell elements must have: data-col="columnName"
// and sum element must have: data-sum="columnName"


$(window).on('load', function() {

    let sumOf = array => array.reduce((prev,curr)=>prev+(parseFloat(curr.replace(/,/g, ''))),0);    // remove "," ffrom numbers and sum them

    function calculateSumOfTable(){
        let columnNames = $("[data-sum]").toArray().map(x=>x.getAttribute("data-sum"));
        let euroFormat = (num) => num.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + " €";
    
        columnNames.forEach(function(columnName) {
                let columnSum = sumOf( $(`[data-col=${columnName}]`).toArray().map(x=>x.innerText) );
                $(`[data-sum=${columnName}]`).each(function(){      // $(this) must be inside each 
                    $(this).text( ($(this).attr("data-format")=="€") ? euroFormat(columnSum) : columnSum );
                });
        });
    } // end of calculateSumOfTable

    $(document).on('input', '.dataTables_filter input', calculateSumOfTable);       // caclulate sum on every search change

    calculateSumOfTable();  // calculate sum on page load

});