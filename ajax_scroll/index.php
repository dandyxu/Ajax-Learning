<?php
/**
 * Created by PhpStorm.
 * User: Wenqian
 * Date: 8/3/2017
 * Time: 9:39 AM
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Infinite Scroll</title>
    <style>
        #blog-posts {
            width: 700px;
        }

        .blog-post {
            border: 1px solid black;
            margin: 10px 10px 20px 10px;
            padding: 6px 10px;
        }

        #spinner {
            display: none;
        }
    </style>
</head>

<body>
    <div id="blog-posts">
        <!--<div id="blog-post-101" class="blog-post">
            <h3>Blog Post 101</h3>
            <p>This is Blog Post 101 content</p>
        </div>
        <div id="blog-post-102" class="blog-post">
            <h3>Blog Post 102</h3>
            <p>This is Blog Post 102 content</p>
        </div>
        <div id="blog-post-103" class="blog-post">
            <h3>Blog Post 103</h3>
            <p>This is Blog Post 103 content</p>
        </div>-->
    </div>

    <div id="spinner">
        <img src="spinner.gif" width="80" height="80" />
    </div>

    <div id="load-more-container">
        <button id="load-more" data-page="0">Load More</button>
    </div>

    <script>

        var container = document.getElementById('blog-posts');
        var load_more = document.getElementById('load-more');
        var spinner = document.getElementById('spinner');

        // Prevent Multiple Requests
        var request_in_progress = false;

        function showSpinner() {
            spinner.style.display = 'block';
        }

        function hideSpinner() {
            spinner.style.display = 'none';
        }

        function showLoadMore() {
            load_more.style.display = 'inline';
        }

        function hideLoadMore() {
            load_more.style.display = 'none';
        }

        function appendToDiv(div, new_html) {
            // Put the new HTML into a temp div
            // This causes browser to parse it as elements.
            var temp = document.createElement('div');
            temp.innerHTML = new_html;

            // Then we can find and work with those elements.
            // Use firstElementChild because of how DOM treats whitespace.
            var class_name = temp.firstElementChild.className;
            var items = temp.getElementsByClassName(class_name);
            var len = items.length;

            for (i=0; i < len; i++) {
                div.appendChild(items[0]);
            }
        }

        function setCurrentPage(page) {
            console.log('Incrementing page to: ' + page);
            load_more.setAttribute('data-page', page);
        }

        //Trigger Ajax on scroll
        function scrollReaction() {
            var content_height = container.offsetHeight;
            var current_y = window.innerHeight + window.pageYOffset;
            console.log(current_y + '/' + content_height);
            if(current_y >= content_height) {
                loadMore();
            }
        }

        function loadMore() {

            // Prevent Multiple Requests
            if (request_in_progress) { return;}
            request_in_progress = true;

            showSpinner();
            hideLoadMore();

            var page = parseInt(load_more.getAttribute('data-page'));
            var next_page = page + 1;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'blog_posts.php?page=' + next_page, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var result = xhr.responseText;
                    console.log('Result: ' + result);

                    hideSpinner();
                    setCurrentPage(next_page);

                    //append results to end of blog posts
                    appendToDiv(container, result);

                    showLoadMore();
                    request_in_progress = false;
                }
            };
            xhr.send();
        }

        load_more.addEventListener("click", loadMore);
        //Trigger Ajax
        window.onscroll = function() {
            scrollReaction();
        }

        // Load even the first page with Ajax
        loadMore();

    </script>
</body>
</html>
