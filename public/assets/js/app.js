document.getElementById('openSideNav').addEventListener('click', function () {
    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */

    document.getElementById("mySidenav").style.width = "250px";
});

document.getElementById('closebtn').addEventListener('click', function (){
    document.getElementById("mySidenav").style.width = "0";
});


