const dietDropdown = document.getElementById("diet-dropdown");
const categoryDropdown = document.getElementById("category-dropdown");

let selectedDiet = null;
let selectedCategory = null;

categoryDropdown.addEventListener('click', function(event){
    selectedCategory = event.target.innerText;
    document.getElementById('selectedCategory').value = selectedCategory;
    event.target.parentElement.style.display = 'none';
    event.target.parentElement.style.display = '';
    console.log(selectedCategory, selectedDiet);
});

dietDropdown.addEventListener('click', function(event) {
    selectedDiet = event.target.innerText;
    document.getElementById('selectedDiet').value = selectedDiet;
    event.target.parentElement.style.display = 'none';
    event.target.parentElement.style.display = '';
    console.log(selectedCategory, selectedDiet);
});