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
        <div id="blog-post-101" class="blog-post">
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
        </div>
    </div>

    <div id="spinner">
        <img src="spinner.gif" width="80" height="80" />
    </div>

    <div id="load-more-container">
        <button id="load-more">Load More</button>
    </div>

    <script>

        var container = document.getElementById('blog-posts');
        var load_more = document.getElementById('load-more');
        var spinner = document.getElementById('spinner');

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

        function loadMore() {

            showSpinner();
            hideLoadMore();

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'blog_posts.php?page=1', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var result = xhr.responseText;
                    console.log('Result: ' + result);

                    hideSpinner();

                    //append results to end of blog posts
                    showLoadMore();
                }
            };
            xhr.send();
        }

        load_more.addEventListener("click", loadMore);

        // Load even the first page with Ajax
        loadMore();

    </script>
</body>
</html>
