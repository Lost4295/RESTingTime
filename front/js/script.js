/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

var isConnected = localStorage.getItem("connected");
var isadmin = localStorage.getItem("admin");
function checkConnection() {
    if (isConnected) {
        document.getElementById("connected").classList.remove("d-none");
        document.getElementById("not-connected").classList.add("d-none");
    } else {
        document.getElementById("not-connected").classList.remove("d-none");
        document.getElementById("connected").classList.add("d-none");
    }
}

function checkAdmin() {
    if (isadmin) {
        document.getElementById("admin").classList.remove("d-none");
    } else {
        document.getElementById("admin").classList.add("d-none");
    }
}


setInterval(checkConnection, 10);