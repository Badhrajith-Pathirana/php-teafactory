$(document).ready(function (eventData) {
    // validateLogin(eventData);
});
$("#btnLogin").click(getAuthantication);
function getAuthantication(eventData) {
    var username = $("#txtUsername").val();
    var password = $("#txtPassword").val();
    var queryStr = "action=authenticate&username="+username+"&password="+password;
    $.ajax({
        method:"POST",
        url:"api/user.php",
        data:{
            action:"authenticate",
            username:username,
            password:password
        },
        async:true
    }).done(function (response) {
        if(response === 1){
            window.location.replace("index.html");
        }else if(response === 0){
            alert("Invalid Password!");
        }else{
            alert("Invalid Username");
        }
    })
}
