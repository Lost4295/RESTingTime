const form = document.querySelector('form');
form.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
    event.preventDefault();

    const data = new FormData(event.target);


    const email =  data.get('inputEmail');
    const password = data.get('inputPassword');




    fetch('http://localhost:8081/connexion/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, password:password })
    })
        .then(response => response.json())
        .then(data => {
            window.location.replace('http://localhost:8082/index.html');
        });
}


let eye = document.getElementById("pwd-eye");
let pwd = document.getElementById("pwd");
console.log(eye);
eye.addEventListener("click", function () {
    if (pwd.type === "password") {
        pwd.type = "text";
        eye.innerHTML = "<i class='bi bi-eye-fill'></i>";
    } else {
        pwd.type = "password";
        eye.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
    }
})
