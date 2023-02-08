
document.getElementById("recipe_name").addEventListener("input", counter, false);
document.getElementById("Recipe").addEventListener("submit", validation_post, false);

document.getElementById("recipe_name").addEventListener("focus", setMessage);
document.getElementById("ingredients").addEventListener("focus", setMessage);
document.getElementById("instructions").addEventListener("focus", setMessage);

document.getElementById("recipe_name").addEventListener("blur", clearMessage);
document.getElementById("ingredients").addEventListener("blur", clearMessage);
document.getElementById("instructions").addEventListener("blur", clearMessage);
