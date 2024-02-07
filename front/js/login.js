const form = document.querySelector('form');
form.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
    event.preventDefault();

    const data = new FormData(event.target);

    const email = data.get('inputEmail');
    const password = data.get('inputPassword');
    let error = false;
    let errlist = [];
    if (password == "" || email == "") {
        errlist.push("Identifiants incorrects.");
        error = true;
    }
    let errmess = document.getElementById("error-message");
    let errpanel = document.getElementById("error-panel");
    let spinner = document.getElementById("spinner");
    let button = document.getElementById("submit");
    errmess.innerHTML = "";
    if (error) {
        errpanel.classList.remove("d-none");
        let ul = document.createElement("ul");

        let li = document.createElement("li");
        li.append(errlist[i]);
        ul.append(li);

        errmess.append(ul);
        return;
    } else {
        errpanel.classList.add("d-none");
        spinner.classList.remove("d-none");
        button.setAttribute("disabled", "");
    }
    fetch('http://localhost:8081/index.php/connexion/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, password: password })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status == 200) {
                sessionStorage.setItem("name", data.message.name);
                sessionStorage.setItem("connected", true);

                window.location.replace('http://localhost:8082/index.html');
            }
            else {
                errlist.push("Identifiants incorrects.");
                errpanel.classList.remove("d-none");
                let ul = document.createElement("ul");
                let li = document.createElement("li");
                li.append(errlist[0]);
                ul.append(li);
                errmess.append(ul);
            }
        }).finally(() => {
            spinner.classList.add("d-none");
            button.removeAttribute("disabled");
        });
}


let eye = document.getElementById("pwd-eye");
let pwd = document.getElementById("inputPassword");
console.log(eye);
eye.addEventListener("click", function () {
    if (pwd.type === "password") {
        pwd.type = "text";
        eye.innerHTML = "<i class='fa-regular fa-eye'></i>";
    } else {
        pwd.type = "password";
        eye.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    }
})
