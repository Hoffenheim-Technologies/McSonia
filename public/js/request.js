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
});


