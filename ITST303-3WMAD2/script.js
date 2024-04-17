
document.getElementById('predictButton').addEventListener('click', predictDishes);

function predictDishes() {
    const ingredientsInput = document.getElementById('ingredientsInput').value;
    const ingredients = ingredientsInput.split(',').map(item => item.trim());

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ ingredients })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const predictionResults = document.getElementById('predictionResults');
        predictionResults.innerHTML = '';
        if (data.predicted_dishes && data.predicted_dishes.length > 0) {
            const resultList = document.createElement('ul');
            data.predicted_dishes.forEach(dish => {
                const listItem = document.createElement('li');
                listItem.textContent = dish;
                resultList.appendChild(listItem);
            });
            predictionResults.appendChild(resultList);
        } else {
            predictionResults.textContent = 'No dishes found with these ingredients.';
        }
    })
    .catch(error => console.error('Error predicting dishes:', error));
}