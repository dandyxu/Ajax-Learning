<?php
/**
 * Created by PhpStorm.
 * User: Wenqian
 * Date: 7/17/2017
 * Time: 10:19 AM
 */

session_start();

if (!isset($_SESSION['favourites'])) {
    $_SESSION['favourites'] = [];
}

function is_favourite($id) {
    return in_array($id, $_SESSION['favourites']);
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="uft-8">
        <title>Asynchronous Button</title>
        <style>
            #blog-posts {
                width: 700px;
            }
            .blog-post {
                border: 1px solid black;
                margin: 10px 10px 20px 10px;
                padding: 6px 10px;
            }
            button.favourite-button, button.unfavourite-button {
                background: #0000FF;
                color: white;
                text-align: center;
            }
            button.favourite-button:hover, button.unfavourite-button:hover {
                background: #000099;
            }

            button.favourite-button {
                display: inline;
            }

            .favourite button.favourite-button {
                display: none;
            }

            button.unfavourite-button {
                display: none;
            }

            .favourite button.unfavourite-button {
                display: inline;
            }

            .favourite-heart {
                color: red;
                font-size: 2em;
                float: right;
                display: none;
            }

            .favourite .favourite-heart {
                display: block;
            }

        </style>

    </head>
<body>
    <?php //echo join(', ', $_SESSION['favourites']); ?>

    <div id="blog-posts">
        <div id="blog-post-101" class="blog-post <?php if(is_favourite(101)) { echo 'favourite';} ?>">
            <span class="favourite-heart">&hearts;</span>
            <h3>Blog Post 101</h3>
            <p>This is Blog Post 101 Paragraph.</p>
            <button class="favourite-button">Favourite</button>
            <button class="unfavourite-button">UnFavourite</button>
        </div>
        <div id="blog-post-102" class="blog-post <?php if(is_favourite(102)) { echo 'favourite';} ?>">
            <span class="favourite-heart">&hearts;</span>
            <h3>Blog Post 102</h3>
            <p>This is Blog Post 102 Paragraph.</p>
            <button class="favourite-button">Favourite</button>
            <button class="unfavourite-button">UnFavourite</button>
        </div>
        <div id="blog-post-103" class="blog-post <?php if(is_favourite(103)) { echo 'favourite';} ?>">
            <span class="favourite-heart">&hearts;</span>
            <h3>Blog Post 103</h3>
            <p>This is Blog Post 103 Paragraph.</p>
            <button class="favourite-button">Favourite</button>
            <button class="unfavourite-button">UnFavourite</button>
        </div>
    </div>

<script>
    function favourite() {
        // div id: blog-post-101, blog-post-102, blog-post-103
        var parent = this.parentElement;

        //xhr code block
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'favourite.php', true);

        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                console.log('Result: ' + result);
                //Add CSS Class - .favourite
                if (result == 'true'){
                    parent.classList.add("favourite");
                }
            }
        };
        xhr.send("id=" + parent.id);
    }

    var buttons = document.getElementsByClassName("favourite-button");
    for (i=0; i < buttons.length; i++) {
        buttons.item(i).addEventListener("click", favourite);
    }

    function unfavourite() {
        // div id: blog-post-101, blog-post-102, blog-post-103
        var parent = this.parentElement;

        //xhr code block
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'unfavourite.php', true);

        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                console.log('Result: ' + result);
                //Add CSS Class - .favourite
                if (result == 'true'){
                    parent.classList.remove("favourite");
                }
            }
        };
        xhr.send("id=" + parent.id);
    }

    var buttons = document.getElementsByClassName("unfavourite-button");
    for (i=0; i < buttons.length; i++) {
        buttons.item(i).addEventListener("click", unfavourite);
    }

</script>

</body>


</html>