
const form = document.querySelector('form');
form.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
    event.preventDefault();

    const data = new FormData(event.target);
    // ''
    let username = data.get("inputUsername");
    let prenom =data.get('inputFirstName');
    let nom =data.get('inputLastName'); // METTRE DES NAMES DANS LES FORM INPUTS
    let email =data.get('inputEmail');
    let password =data.get('inputPassword');
    let Vpassword =data.get('inputPasswordConfirm');
    
    let error = false;
    let errlist = [];
    if (username == "" || password == "" || email == "" || nom == "" || prenom == "") {
        errlist.push("Veuillez remplir tous les champs.");
        error = true;
    }
    if (password.length < 8) {
        errlist.push("Votre mot de passe doit contenir au moins 8 caractères.");
        error = true;
    }
    if (password.search(/[a-z]/) < 0) {
        errlist.push("Votre mot de passe doit contenir au moins une lettre minuscule.");
        error = true;
    }
    if (password.search(/[A-Z]/) < 0) {
        errlist.push("Votre mot de passe doit contenir au moins une lettre majuscule.");
        error = true;
    }
    if (password.search(/[0-9]/) < 0) {
        errlist.push("Votre mot de passe doit contenir au moins un chiffre.");
        error = true;
    }
    if (username.length < 4) {
        errlist.push("Votre pseudo doit contenir au moins 4 caractères.");
        error = true;
    }
    if (username.search(/[a-zA-Z]/) < 0) {
        errlist.push("Votre pseudo doit contenir au moins une lettre.");
        error = true;
    }
    if (nom.length < 2) {
        errlist.push("Votre nom doit contenir au moins 2 caractères.");
        error = true;
    }
    if (prenom.length < 2) {
        errlist.push("Votre prénom doit contenir au moins 2 caractères.");
        error = true;
    }
    if (email.search(/[@]/) < 0) {
        errlist.push("Veuillez entrer une adresse email valide.");
        error = true;
    }
    if (password != Vpassword) {
        errlist.push("Les mots de passe ne correspondent pas.");
        console.log(password, Vpassword);
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
        for (let i = 0; i < errlist.length; i++) {
            let li = document.createElement("li");
            li.append(errlist[i]);
            ul.append(li);
        }
        errmess.append(ul);
        return;
    } else {
        errpanel.classList.add("d-none");
        spinner.classList.remove("d-none");
        button.setAttribute("disabled", "");
    }
    fetch('http://localhost:8081/index.php/connexion/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username, password: password, email: email, nom: nom, prenom: prenom})
    })
        .then(response => response.json())
        .then(data => {
            if (data.status == 200) {
                window.location.replace('http://localhost:8082/index.html');
            }
            else {
                alert("Erreur lors de l'inscription. Veuillez réessayer. Si cette erreur persiste, veuillez vérifier votre pseudo et votre email.");
            }
        }).finally(() => {
            spinner.classList.add("d-none");
        button.removeAttribute("disabled");
        });
}

let eye = document.getElementById("pwd-eye");
let confeye = document.getElementById("confpwd-eye");
let pwd = document.getElementById("inputPassword");
let confirmpwd = document.getElementById("inputPasswordConfirm");
console.log(eye);
eye.addEventListener("click", function () {
    if (pwd.type === "password") {
        pwd.type = "text";
        confirmpwd.type = "password";
        confeye.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
        eye.innerHTML = "<i class='fa-regular fa-eye'></i>";
    } else {
        pwd.type = "password";
        eye.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    }
})
confeye.addEventListener("click", function () {
    if (confirmpwd.type === "password") {
        confirmpwd.type = "text";
        confeye.innerHTML = "<i class='fa-regular fa-eye'></i>";
        pwd.type = "password";
        eye.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    } else {
        confirmpwd.type = "password";
        confeye.innerHTML = "<i class='fa-regular fa-eye-slash'></i>";
    }

})