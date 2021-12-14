//store details
let Order = {};
let RideDetails = {};
$('#btn_contact_details').on("click", function(){
    //console.log("contact button");
    RideDetails = {
        pdate : $('#pdate').val(),
        ptime : $('#ptime').val(),
        dlocation : $('#dlocation').val(),
        plocation : $('#plocation').val(),
    };
    $('.content-1').hide(); 
    $('.content-2').show();
    //console.log(RideDetails);
    $('#summary_from_to').val(RideDetails.plocation+" - "+RideDetails.dlocation);
    $('#summary_pickup_details').val(RideDetails.pdate+": "+RideDetails.ptime);
    //$('#summary_distance').val();
    //$('#summary_time').val();
    //$('#summary_vehicle').val();
    //$('#summary_selection_price').val();
    //$('#summary_total_price').val();
});


