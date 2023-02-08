var searchText = document.getElementById("search_text");
searchText.addEventListener("keydown", send_ajax_request, false);

//TODO: add code to register the "input" event on the search text box so that
//it sends ajax requests whenever a key is pressed