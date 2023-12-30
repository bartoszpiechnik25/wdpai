const search = document.querySelector('input[placeholder="Search"]');

const findButton = document.getElementById('findButton');
const clearButton = document.getElementById('clear-filters');
const categoryButton = document.getElementById('category-button');
const dietButton = document.getElementById('diet-button');


const dropdownCategories = document.getElementById('category-dropdown');
const dropdownDiet = document.getElementById('diet-dropdown');

const recipesContainer = document.querySelector('.recipes-container');

let selectedCategory = null;
let selectedDiet = null;


function searchRecipes() {
    const requestData = {search: search.value, category: selectedCategory, diet: selectedDiet};

    clearFilters();

    fetch("/search", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    }).then(function(response){
        return response.json();
    }).then(
        function(recipes) {
            recipesContainer.innerHTML = "";
            loadRecipes(recipes);
        }
    )
}

function loadRecipes(recipes) {
    recipes.forEach(element => {

        createRecipe(element);
    });
}

function createRecipe(recipe) {
    const template = document.querySelector("#recipe-template");

    const clone = template.content.cloneNode(true);

    clone.querySelector('.image').style.backgroundImage = `url('public/uploads/${recipe.image_url}')`;
    clone.querySelector('.recipe-text').textContent = recipe.name;

    recipesContainer.appendChild(clone);
}

function clearFilters() {
    selectedCategory = null;
    selectedDiet = null;
}

function handleDropdownButtonClick(event) {
    event.currentTarget.nextElementSibling.style.display = 'block';
}

categoryButton.addEventListener('click', handleDropdownButtonClick);
dietButton.addEventListener('click', handleDropdownButtonClick);

clearButton.addEventListener('click', function(){clearFilters();});

search.addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        searchRecipes();
    }
});

findButton.addEventListener('click', searchRecipes);

dropdownCategories.addEventListener('click', function(event){
    selectedCategory = event.target.innerText;
    event.target.parentElement.style.display = 'none';
    event.target.parentElement.style.display = '';
});

dropdownDiet.addEventListener('click', function(event){
    selectedDiet = event.target.innerText;
    event.target.parentElement.style.display = 'none';
    event.target.parentElement.style.display = '';
});