function setModal(params) {
    params.headerSelector === null ? null : params.headerSelector.html(params.headerContent);
    params.bodySelector === null ? null : params.bodySelector.html(params.bodyContent);
    params.footerSelector === null ? null : params.footerSelector.html(params.footerContent);
    params.modalSelector.modal(params.modalState === "show" ? "show" : "hide");
}



const confirmPayment = (ref, p) => {
    let search = 'ss'
    let tx_ref = ref
    let pref= p
    $.post("classes/controller.php", {search, tx_ref, pref}, (data) => {
        console.log(data, "ddd")
        let d = data || false
        if (d) {
            console.log(JSON.parse(d), "ff") 
            // get userId and campId from database  with ref
            let dd = JSON.parse(d)[0]
            const userId = dd.userId
            const campId = dd.campId
            let qrcode = new QRCode('qrCode');
            qrcode.makeCode(userId + ':' + campId + ':' + tx_ref);
            setModal({
                headerSelector: $("#modalHeader"),
                headerContent: "<i class='fas fa-check-circle text-success'></i> Success",
                bodySelector: $("#modalBody"),
                bodyContent: "",
                footerSelector: null,
                footerContent: null,
                modalSelector: $("#qrModal"),
                modalState: "show"
            });
        } else {
            // if no data link is invalid 
            setModal({
                headerSelector: $("#modalHeader"),
                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
                bodySelector: $("#modalBody"),
                bodyContent: "Server error, try again!",
                footerSelector: null,
                footerContent: null,
                modalSelector: $("#regModal"),
                modalState: "show"
            });
    
            $("#rregisterLoader").hide('slow');
            $("#rregisterCampAnonymous").show('slow');
        }
    } )
}
const confirmBulkPayment = (ref, p) => {
    let searchbulk = 'sb'
    let tx_ref = ref
    let pref= p
    $.post("classes/controller.php", {searchbulk, tx_ref, pref}, (data) => {
        localStorage.removeItem("bulk")
        console.log(data, "ddd")
        let d = data || false
        if (d === "Registration Successful") {
            console.log(d, "ff") 
            // get userId and campId from database  with ref
            let dd = d
            const userId = dd?.userId
            const campId = dd?.campId
            let qrcode = new QRCode('qrCode');
            qrcode.makeCode(userId + ':' + campId + ':' + tx_ref);
            setModal({
                headerSelector: $("#modalHeader"),
                headerContent: "<i class='fas fa-check-circle text-success'></i> Success",
                bodySelector: $("#modalBody"),
                bodyContent: "",
                footerSelector: null,
                footerContent: null,
                modalSelector: $("#qrModal"),
                modalState: "show"
            });
        } else {
            console.log("err")
            // if no data link is invalid 
            setModal({
                headerSelector: $("#modalHeader"),
                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
                bodySelector: $("#modalBody"),
                bodyContent: "Server error, try again!",
                footerSelector: null,
                footerContent: null,
                modalSelector: $("#regModal"),
                modalState: "show"
            });
    
            $("#rregisterLoader").hide('slow');
            $("#rregisterCampAnonymous").show('slow');
        }
    } )
}

let url_string = window.location.href
var url = new URL(url_string);
var ref = url.searchParams.get("tx_ref");
var pref = url.searchParams.get("reference");
let bulk = localStorage.getItem('bulk')
if(ref && bulk == 'true'){
    console.log('bulk payment')
    confirmBulkPayment(ref, pref)
}else if (ref){
    console.log('single payment')
    confirmPayment(ref, pref)
}

let participants = [];

    $("#rregisterCamp").click(function(e){

        let firstname = $("#rfirstname").val();

        let lastname = $("#rlastname").val();

        let phone = $("#rphone").val();

        let email = $("#remail").val();

        let ageGroup = $("#rageGroup").val();

        let gender = $("#rgender").val();

        let kidsComing = '';

        let kidsNumber = '';

        let member = $("#rmember").val();

        let district = $("#rdistrict").val();

        let arrivalDate = '';

        let houseAccess = '';

        let anyAmount = $("#anyAmount").val()=='' ? 0 : $("#anyAmount").val();

        let regularFee = $("#regularFee").text();

        let paymentSum = parseInt(anyAmount) + parseInt(regularFee)

        let participantPayment  = paymentSum;

        let regularReg = "rr";

        let regType = 'regular';



        let qrData = $("#qrData").text();

        let userId = qrData.split(":")[0];

        let campId = qrData.split(":")[1];



        //alert(userId+":"+campId);

        

        console.log({ firstname, lastname, phone, email, ageGroup, gender, kidsComing, kidsNumber, member, district, arrivalDate, houseAccess, anyAmount, userId, campId, anyAmount, regularFee, participantPayment, regType });



        if(firstname === ""){

            setModal({

                headerSelector: $("#modalHeader"), 

                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",

                bodySelector: $("#modalBody"),

                bodyContent:  "First name is required!",

                footerSelector: null,

                footerContent: null,

                modalSelector: $("#regModal"),

                modalState: "show"

            });

        }else if(lastname === ""){

            setModal({

                headerSelector: $("#modalHeader"), 

                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",

                bodySelector: $("#modalBody"),

                bodyContent:  "Last name is required!",

                footerSelector: null,

                footerContent: null,

                modalSelector: $("#regModal"),

                modalState: "show"

            });

        }else if(phone === ""){

            setModal({

                headerSelector: $("#modalHeader"), 

                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",

                bodySelector: $("#modalBody"),

                bodyContent:  "Phone numner is required!",

                footerSelector: null,

                footerContent: null,

                modalSelector: $("#regModal"),

                modalState: "show"

            });

        }else if(ageGroup === ""){

            setModal({

                headerSelector: $("#modalHeader"), 

                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",

                bodySelector: $("#modalBody"),

                bodyContent:  "Age group is required!",

                footerSelector: null,

                footerContent: null,

                modalSelector: $("#regModal"),

                modalState: "show"

            });

        }else if(gender == ""){

            setModal({

                headerSelector: $("#modalHeader"), 

                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",

                bodySelector: $("#modalBody"),

                bodyContent: "Gender is required!",

                footerSelector: null,

                footerContent: null,

                modalSelector: $("#regModal"),

                modalState: "show"

            });

        }else if(member == ""){

            setModal({

                headerSelector: $("#modalHeader"), 

                headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",

                bodySelector: $("#modalBody"),

                bodyContent: "Are you a foursquare member?!",

                footerSelector: null,

                footerContent: null,

                modalSelector: $("#regModal"),

                modalState: "show"

            });

        }else{

            $("#rregisterLoader").show('slow');

            $("#rregisterCamp").hide('slow');

            let participant = { firstname, lastname, phone, email, ageGroup, gender, kidsComing, kidsNumber, member, district, arrivalDate, houseAccess, anyAmount,  participantPayment, regType };
            participants.push(participant);
            let totalVal = $("#total").text();
            totalVal = parseInt(totalVal) + participantPayment;
            $("#total").text(totalVal);
            console.log(participants);

            $("#rfirstname").val("");
            $("#rlastname").val("");
            $("#rphone").val("");
            $("#remail").val("");
            $("#rageGroup").val("");
            $("#rgender").val("");
            $("#rmember").val("");
            $("#rdistrict").val("");
            $("#anyAmount").val("");


            let tableRow = 
            '<tr>' +
                '<th scope="row">1</th>' +
                '<td>'+participant.firstname+'</td>' +
                '<td>'+participant.lastname+'</td>' +
                '<td>'+participant.phone+'</td>' +
                '<td>'+participant.email+'</td>' +
                '<td>'+participant.ageGroup+'</td>' +
                '<td>'+participant.gender+'</td>' +
                '<td>'+participant.member+'</td>' +
                '<td>'+participant.district+'</td>' +
                '<td>'+participant.regType+'</td>' +
                '<td>'+participant.participantPayment+'</td>' +
            '</tr>'
            $("#participantTable").append(tableRow);


            $("#rregisterLoader").hide('slow');
            $("#rregisterCamp").show('slow');


            /*e.preventDefault();

            let handler = PaystackPop.setup({

            // key: 'pk_live_b3e5d1863418258bc93d723b28364de61e043bc1',

            key: 'pk_test_4697a3a0abdf2c4173337a341a907588df55a51e',

            email: email == "" ? 'subscribers@foursquareyouthcamp.com' : email,

            amount: anyAmount == "" ? regularFee * 100 : (parseInt(anyAmount) + parseInt(regularFee)) * 100,

            ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

            // label: "Optional string that replaces customer email"

            onClose: function(){

                setModal({

                    headerSelector: $("#modalHeader"), 

                    headerContent: "<i class='fas fa-exclamation-triangle text-warning'></i> Alert",

                    bodySelector: $("#modalBody"),

                    bodyContent: "You just cancelled the ongoing payment!",

                    footerSelector: null,

                    footerContent: null,

                    modalSelector: $("#regModal"),

                    modalState: "show"

                });



                $("#rregisterLoader").hide('slow');

                $("#rregisterCamp").show('slow');

            },

            callback: function(response){

                console.log(response);

                //let message = 'Payment complete! Reference: ' + response.reference;

                //alert(message);

                let ref = response.reference;

                $.post("../../classes/controller.php", { regularReg, firstname, lastname, phone, email, ageGroup, gender, kidsComing, kidsNumber, member, district, arrivalDate, houseAccess, anyAmount, ref, userId, campId }, function(data){

                    console.log(data);

                    if(data === "Registration Successful"){

                        let qrcode = new QRCode('qrCode');

                        qrcode.makeCode(userId + ':' + campId + ':' + ref + ':bulk');



                        setModal({

                            headerSelector: $("#modalHeader"), 

                            headerContent: "<i class='fas fa-check-circle text-success'></i> Success",

                            bodySelector: $("#modalBody"),

                            bodyContent:  "",

                            footerSelector: null,

                            footerContent: null,

                            modalSelector: $("#qrModal"),

                            modalState: "show"

                        });

                    

                    }else{

                        setModal({

                            headerSelector: $("#modalHeader"), 

                            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",

                            bodySelector: $("#modalBody"),

                            bodyContent:  "Server error, try again!",

                            footerSelector: null,

                            footerContent: null,

                            modalSelector: $("#regModal"),

                            modalState: "show"

                        });

                        

                        $("#rregisterLoader").hide('slow');

                        $("#rregisterCamp").show('slow');

                    }

                });

            }

            });

            handler.openIframe();*/



        }



    });


const pbulkRegisterCamp = () => {
    console.log('bulk reg')
    localStorage.setItem("bulk", true)
    let qrData = $("#qrData").text();
    let userId = qrData.split(":")[0];
    let campId = qrData.split(":")[1];
    if(participants == ""){
        setModal({
            headerSelector: $("#modalHeader"), 
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Make sure amount of participant is registered before you can process!!!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    }else{
        let firstname = "Foursquare"
        let lastname = "Foursquare"
        let totalAmount = parseInt($("#total").text());
        let payedBulk = 'pbr';
        let email = $("#userEmail").text();
        let tx_ref = 'KC-' + new Date().getTime()
        console.log(totalAmount);
        let arrayParticipant = JSON.stringify(participants);
        console.log(arrayParticipant);
        $.post("../../classes/controller.php", { payedBulk, arrayParticipant, tx_ref, userId, campId }, function(data){
            console.log(data);
            if(data === "Registration Successful"){
                let data = window.btoa(JSON.stringify({ amount: totalAmount, email: email == "" ? `nym4squareng+${+ new Date().getTime()}@gmail.com` : email, name: firstname + lastname, tx_ref: tx_ref }))
                frame(data)
            
            }else{
                setModal({
                    headerSelector: $("#modalHeader"), 
                    headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
                    bodySelector: $("#modalBody"),
                    bodyContent:  "Server error, try again!",
                    footerSelector: null,
                    footerContent: null,
                    modalSelector: $("#regModal"),
                    modalState: "show"
                });
                
                $("#rregisterLoader").hide('slow');
                $("#rregisterCampAnonymous").show('slow');
            }

            // let qrcode = new QRCode('qrCode');
            // qrcode.makeCode(userId + ':' + campId + ':' + ref + ':bulk');

            // setModal({
            //     headerSelector: $("#modalHeader"), 
            //     headerContent: "<i class='fas fa-check-circle text-success'></i> Success",
            //     bodySelector: $("#modalBody"),
            //     bodyContent:  "Registration Successful!!!",
            //     footerSelector: null,
            //     footerContent: null,
            //     modalSelector: $("#qrModal"),
            //     modalState: "show"
            // });
            //$("#participantTable").empty();
        });

    }
}

const rregisterCampAnonymous = () => {
    localStorage.removeItem("bulk")

    let firstname = $("#rfirstname").val();
    let lastname = $("#rlastname").val();
    let phone = $("#rphone").val();
    let email = $("#remail").val();
    let ageGroup = $("#rageGroup").val();
    let gender = $("#rgender").val();
    let kidsComing = $("#rkidsComing").val();
    let kidsNumber = $("#rkidsNumber").val();
    let member = $("#rmember").val();
    let district = $("#rdistrict").val();
    let arrivalDate = $("#rarrivalDate").val();
    let houseAccess = $("#rhouseAccess").val();
    let anyAmount = $("#anyAmount").val();
    let regularFee = $("#regularFee").text();
    let pregularRegAnonymous = "rr";
    let payment_status = 0
    let tx_ref = 'KC-' + new Date().getTime()
    let qrData = $("#qrData").text();
    let campId = qrData;
    let userId = '' + Math.floor((Math.random() * 1000000000) + 1);


    if (firstname === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "First name is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (lastname === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Last name is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (phone === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Phone numner is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (ageGroup === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Age group is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (gender == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Gender is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (kidsComing == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Are you coming with kids?!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (member == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Are you a foursquare member?!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (arrivalDate == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Arrival date is a required field!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (houseAccess == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Do you have access to a house in camp?!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else {
        $("#rregisterLoader").show('slow');
        $("#rregisterCampAnonymous").hide('slow');
        // save data to database 
        $.post("classes/controller.php", { pregularRegAnonymous, firstname, lastname, phone, email, ageGroup, gender, kidsComing, kidsNumber, member, district, arrivalDate, houseAccess, anyAmount, ref, userId, campId, payment_status, tx_ref }, function(data){
            console.log(data);
            if(data === "Registration Successful"){
                let data = window.btoa(JSON.stringify({ amount: anyAmount == "" ? regularFee : parseInt(anyAmount) + parseInt(regularFee),email: email == "" ? `nym4squareng+${+ new Date().getTime()}@gmail.com` : email, name: firstname + lastname, tx_ref: tx_ref }))
                frame(data)
            
            }else{
                setModal({
                    headerSelector: $("#modalHeader"), 
                    headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
                    bodySelector: $("#modalBody"),
                    bodyContent:  "Server error, try again!",
                    footerSelector: null,
                    footerContent: null,
                    modalSelector: $("#regModal"),
                    modalState: "show"
                });
                
                $("#rregisterLoader").hide('slow');
                $("#rregisterCampAnonymous").show('slow');
            }
        });
       


    }
} 

const pregisterCampAnonymousfunc = () => {
    localStorage.removeItem("bulk")
    let firstname = $("#pfirstname").val();
    let lastname = $("#plastname").val();
    let phone = $("#pphone").val();
    let email = $("#pemail").val();
    let ageGroup = $("#pageGroup").val();
    let gender = $("#pgender").val();
    let member = $("#pmember").val();
    let district = $("#pdistrict").val();
    let arrivalDate = $("#parrivalDate").val();
    let houseAccess = $("#phouseAccess").val();
    let premiumAmount = $("#premiumAmount").val() === "more" ? $("#otherAmount").val() : $("#premiumAmount").val();
    let ppremiumRegAnonymous = "pr";
    let payment_status = 0
    let tx_ref = 'KC-' + new Date().getTime()
    let qrData = $("#qrData").text();
    let campId = qrData;
    let userId = '' + Math.floor((Math.random() * 1000000000) + 1);
    if (firstname === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "First name is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (lastname === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Last name is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (phone === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Phone numner is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (ageGroup === "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Age group is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (gender == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Gender is required!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (member == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Are you a foursquare member?!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (arrivalDate == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Arrival date is a required field!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (houseAccess == "") {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Do you have access to a house in camp?!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else if (premiumAmount == "" || premiumAmount < 30000) {
        setModal({
            headerSelector: $("#modalHeader"),
            headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
            bodySelector: $("#modalBody"),
            bodyContent: "Registration category is required, make sure amount is not lower than N30,000!",
            footerSelector: null,
            footerContent: null,
            modalSelector: $("#regModal"),
            modalState: "show"
        });
    } else {
        console.log("heerrr", firstname, lastname, phone, email, ageGroup, gender, member, district, premiumAmount,  userId, campId, payment_status, tx_ref)
        $("#pregisterLoader").show('slow');
        $("#pregisterCampAnonymous").hide('slow');
        $.post("classes/controller.php", { ppremiumRegAnonymous , firstname, lastname, phone, email, ageGroup, gender, member, district, arrivalDate, houseAccess, ref, userId, campId, payment_status, tx_ref }, function(data){
            console.log(data);
            if(data === "Registration Successful"){
                let data = window.btoa(JSON.stringify({ amount: parseInt(premiumAmount), email: email == "" ? `nym4squareng+${+ new Date().getTime()}@gmail.com` : email, name: firstname + lastname, tx_ref: tx_ref }))
                frame(data)
            
            }else{
                setModal({
                    headerSelector: $("#modalHeader"), 
                    headerContent: "<i class='fas fa-exclamation-triangle text-danger'></i> Error",
                    bodySelector: $("#modalBody"),
                    bodyContent:  "Server error, try again!",
                    footerSelector: null,
                    footerContent: null,
                    modalSelector: $("#regModal"),
                    modalState: "show"
                });
                
                $("#rregisterLoader").hide('slow');
                $("#rregisterCampAnonymous").show('slow');
            }
        });

    }

}

const frame = (d) => {
    // let link = `https://app.payedin.co/pay/MTE0MQ==?data=${d}` // PRODUCTION
    let link = `https://staging.payedin.co/pay/NTM=?data=${d}` // STAGING 
    // let link = `https://staging.payedin.co/pay/NTM=?data=${d}` // TEST
    window.open(link, "_self")
}




console.log("Payedin load ")