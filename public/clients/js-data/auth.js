

document.addEventListener("DOMContentLoaded", function() {

    document.querySelector('#registerBtnId').addEventListener('click',function (e){
        e.preventDefault();
        $('#loginModal').modal('hide');
        $('#registerModal').modal('show');
    });
    document.querySelector('#loginBtnId').addEventListener('click',function (e){
        e.preventDefault();
        $('#loginModal').modal('show');
        $('#registerModal').modal('hide');
    });




});

