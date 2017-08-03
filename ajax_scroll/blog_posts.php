<?php
/**
 * Created by PhpStorm.
 * User: Wenqian
 * Date: 8/3/2017
 * Time: 9:47 AM
 */

function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

// this would be a call to a database
function find_blog_posts($page)
{
    $first_post = 101;
    $per_page = 3;
    //How many pages you want to skip
    $offset = (($page - 1) * $per_page) + 1;

    $blog_posts = [];

    // This is our "fake" database
    for($i=0; $i < $per_page; $i++) {
        $id = $first_post - 1 + $offset + $i;
        $blog_post = [
            'id' => $id,
            'title' => "Blog Post #{$id}",
            'content' => "This is the content of Blog Post #{$id}",
        ];
        $blog_posts[] = $blog_post;
    }
    return $blog_posts;
}

    if (!is_ajax_request()) {
        exit;
    }

    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

    $blog_posts = find_blog_posts($page);

    ?>

    <?php foreach($blog_posts as $blog_post) { ?>
        <div id="blog-post-<?php echo $blog_post['id']; ?>" class="blog-post">
            <h3><?php echo $blog_post['title']; ?></h3>
            <p><?php echo $blog_post['content']; ?></p>
        </div>
<?php } ?>
