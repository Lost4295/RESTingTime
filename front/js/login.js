function handleSubmit(event) {
    event.preventDefault();

    const data = new FormData(event.target);

    const value = data.get('description');

    fetch('http://localhost:8081/connexion/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ description: value })
    })
        .then(response => response.json())
        .then(data => {
            window.location.replace('http://localhost:8082/index.html');
        });
}

const form = document.querySelector('form');
form.addEventListener('submit', handleSubmit);