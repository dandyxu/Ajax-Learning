// Note: IE8 doesn't support DOMContentLoaded

document.addEventListener('DOMContentLoaded', function() {

    var suggestions = document.getElementById("suggestions");
    var form = document.getElementById("search-form");
    var search = document.getElementById("search");

    function showSuggestions(json) {

    }

    function getSuggestions() {
        var q = search.value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'autosuggest.php?q=' + q, true);
        xhr.setRequestHeader('X-Reqeusted-Width', 'XMLHttpReqeust');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                console.log('Results: ' + result);

                var json = JSON.parse(result);
                showSuggestions(json);
            }
        };
        xhr.send();
    }

    // search.addEventListener("", getSuggestions, false);

});