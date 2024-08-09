function generateResponse() {
    const userInput = document.getElementById('userInput').value;
    const responseDiv = document.getElementById('responseDiv');

    fetch('response.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ text: userInput })
    })
    .then(response => response.text())
    .then(data => {
        responseDiv.innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}