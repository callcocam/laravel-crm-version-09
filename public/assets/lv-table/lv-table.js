(function(jQuery) {
    jQuery.find('table th.sortable').on('click',function(e){
        jQuery.find('input[name="lvTableColumn"]').val(jQuery(this).data('column'));
        jQuery.find('input[name="lvTableOrder"]').val(jQuery(this).data('order'));
        jQuery("#lv-table-form").submit()
    });

})(jQuery);

function initRange(ranges){
    //Date range as a button
    jQuery('#daterange').daterangepicker(
        {
            ranges   : ranges,
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
        },
        function (start, end) {
            jQuery('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
    )
}
