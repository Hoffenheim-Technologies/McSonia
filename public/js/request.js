//store details
let Order = {};
let RideDetails = {};

const tabs = [
    {name: 'ride', fields: ['pdate', 'ptime', 'item', 'plocation', 'dlocation', 'paddress', 'daddress', 'pstate', 'dstate']},
    {name: 'contact', fields: ['firstname', 'lastname', 'email', /*'phone', 'billing', 'street', 'snumber', 'city', 'state', 'postal', 'country'*/]}
]
var errors
const validate = (index, status) => {
    errors = []
    console.log(status)
    if (status){
        tabs[index].fields.forEach( field => {
            if (!$(`[name=${field}]`).val()){
                errors.push({field: field, message: `${field} is compulsory`})
                $(`[name=${field}], .${field}.niceselect`).removeClass('ring ring-green-400').addClass('ring ring-red-500')
            } else {
                $(`[name=${field}], .${field}.niceselect`).removeClass('ring ring-red-500').addClass('ring ring-green-400')
            }
        })
    } else {
        return true
    }
    if(errors.length >  0) {
        return false
    }
    return true
}

$('#btn_contact_details').on("click", function(){
    //console.log("contact button");
    if (validate(0, true)) {
        RideDetails = {
            pdate : $('#pdate').val(),
            ptime : $('#ptime').val(),
            dlocation : $('#dlocation').val(),
            plocation : $('#plocation').val(),
        };
        $('.content-1').hide();
        $('.content-2').show();
    } else {
        console.log(errors)
        alert("Please fill all compulsory values")
    }
});

$('#button_booking_summary').on('click', () => {
    // if (validate(1, true)) {
    //     $('.content-2').hide()
    //     $('.content-3').show()
    // }
})


