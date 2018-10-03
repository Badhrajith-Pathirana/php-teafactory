var routes;
$(document).ready(function (eventData) {
    checkSession(eventData);
    getSuppliers();
    getRoutes();
    getTeaCollection();
    getCtypes();
    getCredits(eventData);
});

function getTeaCollection() {
    $.ajax({
        method:"GET",
        url:"api/teacollection.php",
        data:{
            action : "allToday"
        },
        async:true
    }).done(function (response) {
        if(response === null){
            return;
        }
        $("#tblTeaCollection tbody tr").remove();
        response.forEach(function (collection) {
            var code = "<tr>" +
                "<td>"+collection.purchase_id+"</td>" +
                "<td>"+collection.supplierid+"</td>"+
                "<td>"+collection.suppliername+"</td>"+
                "<td>"+collection.akg+"</td>" +
                "<td>"+collection.bkg+"</td>"+
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblTeaCollection tbody").append(code);
        })
        $("#tblTeaCollection tbody tr td i").click(deleteCollection);
    })
}

function getRoutes() {
    $.ajax({
        method:"GET",
        url:"api/route.php",
        data:{
            "action" : "all"
        },
        async:true
    }).done(function (response) {
        $("#routeList p").remove();
        var main = "<p class='dropdown-item'>Routes</p>";
        $("#routeList").append(main);
        routes = response;
        response.forEach(function (route) {
            var code = "<p class='dropdown-item'>"+ route.routename +"</p>";
            $("#routeList").append(code);

        })
        $(".dropdown-item").click(function (eventData) {
            var clickedItem = eventData.target;
            console.log(clickedItem);
            $("#dropdownMenuButton").text($(clickedItem).text());
        });
    });
}
function getCtypes() {
    $.ajax({
        method:"GET",
        url:"api/credit.php",
        data:{
            "action" : "types"
        },
        async:true
    }).done(function (response) {
        $("#credittypeList p").remove();
        var main = "<p class='dropdown-item'>Credit Types</p>";
        $("#credittypeList").append(main);
        response.forEach(function (ctype) {
            var code = "<p class='dropdown-item'>"+ ctype.type_name +"</p>";
            $("#credittypeList").append(code);

        })
        $("#credittypeList .dropdown-item").click(function (eventData) {
            var clickedItem = eventData.target;
            console.log(clickedItem);
            $("#dropDownCreditType").text($(clickedItem).text());
        });
    });
    /*$("#credittypeList p").remove();
    var main = "<p class='dropdown-item'>Credit Types</p>";
    $("#credittypeList").append(main);
    main = "<p class='dropdown-item'>PAYMENT</p>";
    $("#credittypeList").append(main);
    $("#credittypeList .dropdown-item").click(function (eventData) {
        var clickedItem = eventData.target;
        console.log(clickedItem);
        $("#dropDownCreditType").text($(clickedItem).text());
    });*/
}

function getSuppliers(){
    var ajaxConfig = {
        method:"get",
        url:"api/supplier.php",
        data: {
            "action": "all"
        },
        async: true
    };
    $.ajax(ajaxConfig).done(function (response) {
        $($("#creditsupplierList").children("p")).remove();
        $($("#supplierList").children("p")).remove();
        $($("#debsupplierList").children("p")).remove();
        var code = "<p class='dropdown-item'>Supplier</p>";
        $("#supplierList").append(code);

        $($("#tblSupplier tbody").children("tr")).remove();
        response.forEach(function (supplier) {
            // console.log("Hi I am calling");
            var code ="<tr>"+
                "<td>"+supplier.supplierno +"</td>"+
                "<td>"+supplier.name+"</td>"+
                "<td>"+supplier.route+"</td>"+
                "<td>"+supplier.phone+"</td>"+
                "<td>"+supplier.address+"</td>"+
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";
            var supid = "<p class='dropdown-item'>"+supplier.supplierno+"</p>";
            $("#supplierList").append(supid);
            $("#creditsupplierList").append(supid);
            $("#debsupplierList").append(supid);
            $("#tblSupplier tbody").append(code);
        });
        $("#tblSupplier tbody tr :nth-last-child(1) i").click(deleteCustomer);
        $("#supplierList .dropdown-item").click(function (eventData) {
            var clickedItem = eventData.target;
            console.log(clickedItem);
            $("#dropDownSupplier").text($(clickedItem).text());
        });$("#creditsupplierList .dropdown-item").click(function (eventData) {
            var clickedItem = eventData.target;
            console.log(clickedItem);
            $("#dropDownCreditSupplier").text($(clickedItem).text());
        });
        $("#debsupplierList .dropdown-item").click(function (eventData) {
            var clickedItem = eventData.target;
            console.log(clickedItem);
            $("#dropDownDebSupplier").text($(clickedItem).text());
            getSupplierDebits(eventData);
        });
    });

}
// $("#tblSupplier tbody tr :nth-last-child(1) i").off("click");

function getSupplierDebits(eventData) {
    var supplierid = ($("#dropDownDebSupplier").text()).trim();
    $.ajax({
        method:"GET",
        url:"api/debit.php?action=getSup&supplierid="+supplierid,
        async:true
    }).done(function (response) {
        $("#tblDebits tbody tr").remove();
        response.forEach(function (debit) {
            var code = "<tr>" +
                "<td>"+debit.debitid+"</td>"+
                "<td>"+debit.purchaseid+"</td>"+
                "<td>"+debit.debitdate+"</td>"+
                "<td>"+debit.amount+"</td>"+
                "</tr>"
            $("#tblDebits tbody").append(code);
        })
    })
}
function deleteCustomer(eventData){
    var trow = $($(eventData.target).parent()).parent();
    var idCol = $(trow).children("td").get(0);
    var supid =parseInt($(idCol).text());
    console.log(supid);
    if(!confirm("Are you sure that you want to delete the supplier "+supid+"?")){
        return;
    }
    var queryString = "id=" + supid;
    $.ajax({
        method:"DELETE",
        url: "api/supplier.php?" + queryString,
        async:true
    }).done(function (response) {
        if(response){
            alert("Supplier deleted successfully");
            $(trow).remove();
        }else{
            alert("Supplier deleting failed");
        }
    })

}

$("#routeList .dropdown-item").click(function (eventData) {
    var clickedItem = eventData.target;
    console.log(clickedItem);
    $("#dropdownMenuButton").text($(clickedItem).text());
});
$("#supplierList .dropdown-item").click(function (eventData) {
    var clickedItem = eventData.target;
    console.log(clickedItem);
    $("#dropDownSupplier").text($(clickedItem).text());
});
$("#creditsupplierList .dropdown-item").click(function (eventData) {
    var clickedItem = eventData.target;
    console.log(clickedItem);
    $("#dropDownCreditSupplier").text($(clickedItem).text());
});
$("#credittypeList .dropdown-item").click(function (eventData) {
    var clickedItem = eventData.target;
    console.log(clickedItem);
    $("#dropDownCreditType").text($(clickedItem).text());
});


$("#btnAddCustomer").click(function (eventData) {
    var display = $("#addSupplier").css("display");
    if(display === "none"){
        $("#addSupplier").css("display","block");
    }else{
        $("#addSupplier").css("display","none");
    }
});
$("#btnAddSupplier").click(function (eventData) {
    var supid = $("#txtSupID").val();
    var supname = $("#txtSupName").val();
    var address = $("#txtAddress").val();
    var contactno = $("#txtSupTel").val();
    var routename = ($("#dropdownMenuButton").text()).trim();
    var routeid = -1;


    var check = validateSupplier();
    if(!check){
        return;
    }

    routes.forEach(function (route) {

        if(route.routename === routename){
            routeid =  route.routeid;
        }
    });

    $.ajax({
        method: "POST",
        url:"api/supplier.php",
        data:{
            "id": supid,
            "name": supname,
            "address": address,
            "contact" : contactno,
            "routeid": routeid,
            "action":"save"
        },
        async:true
    }).done(function (response) {

        console.log(response);
        if(response){
            alert("Supplier added successfully!");
        }else{
            alert("Supplier not added!");
        }
    });
    getSuppliers();
});
function validateSupplier(){
    var bSupName = /^[A-Za-z. ]+$/.test($("#txtSupName").val());
    var bSupID = /^\d+$/.test($("#txtSupID").val());
    var bSupAddress = ($("#txtAddress").val() === null || $("#txtAddress").val() === "" || $("#txtAddress").val() === undefined)? false : true;
    var bSupContact = /^\d{10}$/.test($("#txtSupTel").val());
    var bcmbRoute = (($("#dropdownMenuButton").text()).trim() === "Route")? false:true;
    var check = true;
    if(!bcmbRoute){
        $("#dropdownMenuButton").focus();
        $("#dropdownMenuButton").css("border","1px red solid");
        check =false;
    }
    if(!bSupAddress){
        $("#txtAddress").focus();
        $("#txtAddress").css("border","1px red solid");
        $("#txtAddress").select();
        check = false;
    }
    if(!bSupContact){
        $("#txtSupTel").focus();
        $("#txtSupTel").css("border","1px red solid");
        $("#txtSupTel").select();
        check = false;
    }
    if(!bSupName){
        $("#txtSupName").focus();
        $("#txtSupName").css("border","1px red solid");
        $("#txtSupName").select();
        check = false;
    }
    if(!bSupID){
        $("#txtSupID").focus();
        $("#txtSupID").css("border","1px red solid");
        $("#txtSupID").select();
        check = false;
    }
    return check;
}
$("#btnAddCollection").click(saveTeaCollection);
function saveTeaCollection(eventData) {
    var check = checkTeaCol();
    console.log(check);
    if(!check){
        return;
    }
    // var queryStr = "?action=save&supid=3&akg=10&bkg=10";
    $.ajax({
        method: "POST",
        url:"api/teacollection.php",
        data:{
            action:"save",
            supid: ($("#dropDownSupplier").text()).trim(),
            akg: $("#txtAkg").val(),
            bkg: $("#txtBkg").val()
        },
        async:true
    }).done(function (response) {
        if(response){
            alert("Successfully added the tea collection");
            getTeaCollection();
        }else{
            alert("Adding tea collection failed!");
        }
    });
}
function checkTeaCol() {
    var check = true;
    var bakg = /^\d+[.\d{3}]?$/.test($("#txtAkg").val());
    var bbkg = /^\d+[.\d{3}]?$/.test($("#txtBkg").val());
    var bsupid = (($("#cmbSupplier").text()).trim() === "Supplier")? false: true;
    if(!bsupid){
        $("#cmbSupplier").focus();
        $("#cmbSupplier").css("border","1px red solid");
        $("#cmbSupplier").select();
        check = false;
    }
    if(!bbkg){
        $("#txtBkg").focus();
        $("#txtBkg").css("border","1px red solid");
        $("#txtBkg").select();
        check = false;
    }
    if(!bakg){
        $("#txtAkg").focus();
        $("#txtAkg").css("border","1px red solid");
        $("#txtAkg").select();
        check = false;
    }
    console.log(check);
    return check;

}
function deleteCredit(eventData) {
    if(!confirm("Are you sure that you want to delete the credit?")){
        return;
    }
    var selectedTr = $($(eventData.target).parent()).parent();
    var creditid = $($(selectedTr).children("tr :nth-child(1)")).text();
    var queryStr = "creditid="+creditid;
    $.ajax({
        method:"DELETE",
        url:"api/credit.php?"+queryStr,
        async:true
    }).done(function (response) {
        if(response){
            alert("Credit deleted successfully!");
            getCredits();
        }else{
            alert("Deleting credit failed!");
        }
    })
}
function checkSession(eventData) {
    $.ajax({
        method:"GET",
        url:"api/session.php?action=check",
        async:false
    }).done(function (response) {
        if(!response){
            window.location.replace("login.html");
        }
    })
}

function deleteCollection(eventData){
    if(!confirm("Are you sure that you want to delete this purchase??")){
        return;
    }
    var selectedTr = $($(eventData.target).parent()).parent();
    var purchaseid = $($(selectedTr).children("tr :nth-child(1)")).text();
    var queryStr = "purchaseid="+purchaseid;
    $.ajax({
        method:"DELETE",
        url:"api/teacollection.php?"+queryStr,
        async:true
    }).done(function (response) {
        if(response){
            alert("Purchase deleted successfully!");
            getTeaCollection();
            getSupplierDebits()
        }else{
            alert("Deleting purchase failed!");
        }
    })
}
function getCredits(eventData) {
    $.ajax({
        method:"GET",
        url:"api/credit.php?action=all",
        async: true
    }).done(function (response) {
        $("#tblCredits tbody tr").remove();
        response.forEach(function (credit) {
            var code = "<tr>" +
                "<td>" +credit.creditid+"</td>"+
                "<td>"+credit.supid+"</td>"+
                "<td>"+credit.supname+"</td>"+
                "<td>"+credit.ctype+"</td>"+
                "<td>"+credit.amount+"</td>"+
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>"
            $("#tblCredits tbody").append(code);
        })
        $("#tblCredits tbody tr i").click(deleteCredit);
    });
}
$("#btnAddCredit").click(saveCredit);
function saveCredit(eventData) {
    var supid = parseInt(($("#dropDownCreditSupplier").text()).trim());
    var credittype = ($("#dropDownCreditType").text()).trim();
    var amount = $("#txtAmount").val();
    // var qStr = "action=save&supid="+supid+"&credittype="+credittype+"&amount="+amount;
    $.ajax({
        method:"POST",
        url:"api/credit.php",
        data:{
            action:"save",
            supid:supid,
            credittype: credittype,
            amount: amount
        },
        async:true
    }).done(function (response) {
        if(response){
            alert("Added Credit successfully");
            getCredits(eventData);
        }else{
            alert("Adding credit failed!");
        }
    })
}