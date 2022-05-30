<?php
$url_path = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$baseurl = $url_path . '/';

session_start();
date_default_timezone_set("Asia/Calcutta");
$current_date = strtotime(date("r"));


$page_type = 0;
//curl start
function CallApi($url)
{
    $curl = curl_init($url);
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_CUSTOMREQUEST => 'GET'
    ]);
    $result = curl_exec($curl);
    curl_close($curl);
    $result = (json_decode($result, true));
    return $result;
}
//curl end
//common content for each page start
$headerDesktop = CallApi('https://cms.quadbtech.com/article-dashboard/API/headerApi');
$response2 = CallApi('https://cms.quadbtech.com/article-dashboard/API/recentPost');
$responseAd = CallApi('https://cms.quadbtech.com/article-dashboard/API/sidebarImages.php');
$footerDesktop = CallApi('https://cms.quadbtech.com/article-dashboard/API/footerApi');
$navMobileBottom = CallApi('https://cms.quadbtech.com/article-dashboard/API/navMobileBottom');
$gTagId = $response2[1][0]['gTagid'];
$rightSidebar = CallApi('https://cms.quadbtech.com/article-dashboard/API/rightSidebar');
$responseCategory = CallApi('https://cms.quadbtech.com/article-dashboard/API/fetchAllBlog');
//common content for each page end

/* ----------------------------- my code start ---------------------------- */

//main content which is change in every page start
if ((isset($_REQUEST['cat'])) && ((isset($_REQUEST['name'])) && (strpos($_SERVER['REQUEST_URI'], "kafqlhzwab") !== false))) {
    $category_slug = $_REQUEST['cat'];
    $slug = $_REQUEST['name'];
    if (isset($_REQUEST['sub'])) {
        $sub_category_slug = $_REQUEST['sub'];
        $response = CallApi('https://cms.quadbtech.com/article-dashboard/API/singleArticleSubPreview?cat=' . $category_slug . '&sub=' . $sub_category_slug . '&name=' . $slug);
    } else {
        $response = CallApi('https://cms.quadbtech.com/article-dashboard/API/singleArticleCatPreview?cat=' . $category_slug . '&name=' . $slug);
    }
    $row2 = $response[0];
    $title = $row2[0]['title'];
    $author_name = $row2[0]['author_name'];
    $category_name = $row2[0]['category_name'];
    $hero_image = $row2[0]['hero_image'];
    $hero_image_alt = $row2[0]['hero_image_alt'];
    $date_of_posting = $row2[0]['date_of_posting'];
    $sub_category_name = $row2[0]['sub_category_name'];
    $keywords = $row2[0]['keywords'];
    $content = $row2[0]['content'];
    $meta_description = $row2[0]['meta_description'];
    $meta_title = $row2[0]['meta_title'];
    $meta_url = $row2[0]['meta_url'];
    $meta_image = $row2[0]['meta_image'];
    $article_id = $row2[0]['article_id'];
    $comments_type = $row2[0]['comments'];
    $total_comments = $row2[1]['total_comments'];
    $comments = $row2[2];
    $page_type = 3;
} else if ((isset($_REQUEST['cat'])) && ((isset($_REQUEST['sub'])) && (isset($_REQUEST['name'])))) {
    //single subcategory article view page
    $category_slug = $_REQUEST['cat'];
    $sub_category_slug = $_REQUEST['sub'];
    $slug = $_REQUEST['name'];
    $response = CallApi('https://cms.quadbtech.com/article-dashboard/API/signleArticleSub?cat=' . $category_slug . '&sub=' . $sub_category_slug . '&name=' . $slug);
    $row2 = $response[0];
    $title = $row2[0]['title'];
    $author_name = $row2[0]['author_name'];
    $category_name = $row2[0]['category_name'];
    $hero_image = $row2[0]['hero_image'];
    $hero_image_alt = $row2[0]['hero_image_alt'];
    $date_of_posting = $row2[0]['date_of_posting'];
    $sub_category_name = $row2[0]['sub_category_name'];
    $keywords = $row2[0]['keywords'];
    $content = $row2[0]['content'];
    $meta_description = $row2[0]['meta_description'];
    $meta_title = $row2[0]['meta_title'];
    $meta_url = $row2[0]['meta_url'];
    $meta_image = $row2[0]['meta_image'];
    $article_id = $row2[0]['article_id'];
    $comments_type = $row2[0]['comments'];
    $url_lines = $row2[0]['url_lines'] . '/rrozunbrfe';
    $total_comments = $row2[1]['total_comments'];
    $comments = $row2[2];
    $category_slug = $row2[0]['category_slug'];
    //$btn_link = $row2[0]['related_button_link'];
    $slug = $row2[0]['slug'];
    $meta_new_url = $baseurl . 'blog/' . $category_slug . '/' . $sub_category_slug . '/' . $slug;
    $page_type = 2;
} else if ((isset($_REQUEST['cat'])) && (isset($_REQUEST['name']))) {
    //single category article view page
    $category_slug = $_REQUEST['cat'];
    $slug = $_REQUEST['name'];
    $response = CallApi('https://cms.quadbtech.com/article-dashboard/API/singleArticleCat?cat=' . $category_slug . '&name=' . $slug);
    $row2 = $response[0];
    $title = $row2[0]['title'];
    $author_name = $row2[0]['author_name'];
    $category_name = $row2[0]['category_name'];
    $hero_image = $row2[0]['hero_image'];
    $hero_image_alt = $row2[0]['hero_image_alt'];
    $date_of_posting = $row2[0]['date_of_posting'];
    $sub_category_name = $row2[0]['sub_category_name'];
    $keywords = $row2[0]['keywords'];
    $content = $row2[0]['content'];
    $meta_description = $row2[0]['meta_description'];
    $meta_title = $row2[0]['meta_title'];
    $meta_url = $row2[0]['meta_url'];
    $meta_image = $row2[0]['meta_image'];
    $article_id = $row2[0]['article_id'];
    $comments_type = $row2[0]['comments'];
    $url_lines = $row2[0]['url_lines'] . '/rrozunbrfe';
    $total_comments = $row2[1]['total_comments'];
    $comments = $row2[2];
    //$btn_link = $row2[0]['related_button_link'];
    $meta_new_url = $baseurl . 'blog/' . $category_slug . '/' . $slug;
    $page_type = 1;
}
// echo $page_type;
//main content which is change in every page end
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '<?php echo $gTagId ?>');
    </script>
    <!-- End Google Tag Manager -->
    <title><?php echo $title; ?></title>
    <base href="<?php echo $baseurl; ?>">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- <link href="bg_util/style.css" rel="stylesheet"> -->
    <meta name="description" content="<?php echo ($meta_description); ?>">

    <!-- Enter a keywords for the page in tag -->
    <meta name="Keywords" content="<?php echo ($keywords); ?>">

    <!-- Enter Page title -->
    <meta property="og:title" content="<?php echo ($meta_title) ?>" />

    <!-- Enter Page URL -->
    <meta property="og:url" content="<?php echo ($meta_new_url) ?>" />

    <!-- Enter page description -->
    <meta property="og:description" content="<?php echo ($meta_description); ?>">

    <!-- Enter Logo image URL for example : http://cryptonite.finstreet.in/images/cryptonitepost.png -->
    <meta property="og:image" itemprop="image" content="<?php echo ($meta_image); ?>" />
    <meta property="og:image:secure_url" itemprop="image" content="<?php echo ($meta_image); ?>" />
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">

    <link href="https://cms.quadbtech.com/bg_util/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" integrity="sha512-Mo79lrQ4UecW8OCcRUZzf0ntfMNgpOFR46Acj2ZtWO8vKhBvD79VCp3VOKSzk6TovLg5evL3Xi3u475Q/jMu4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cms.quadbtech.com/bg_util/loader.css">

    <link rel="icon" href="https://cms.quadbtech.com/icons/india.png">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>



<style>
    @charset "utf-8";
    /* CSS Document */

    @font-face {
        font-family: Poppins Medium;
        src: url(https://govtjobkaro.com/fonts/Poppins-Medium.ttf);
        font-weight: 100;
        font-display: swap;
    }

    @font-face {
        font-family: Poppins Normal;
        src: url(https://govtjobkaro.com/fonts/Poppins-Regular.ttf);
        font-weight: 100;
        font-display: swap;
    }

    .poppins-regular {
        font-family: Poppins Normal;
    }

    .poppins-medium {
        font-family: Poppins Medium;
    }

    .top button {
        text-align: center;
        margin: 0;
        font-size: 14px;
        background-color: #f56962;
        border-radius: 4px;
        opacity: 1;
        font-family: Poppins Normal;
        color: #ffffff;
    }

    .category {
        z-index: 1;
        position: absolute;
        height: 40px;
        text-align: center;
        vertical-align: center;
        background-color: #ffffff;
        color: #000000;
        padding: 8px;
        right: 0;
        bottom: 120px;
    }

    .subcategory {
        list-style-type: none;
        padding: 8px 50px;
        border-bottom: 1px solid #ebecedc5;
        cursor: pointer;
    }

    .subcategory a {
        color: #544e7a;
    }

    .maincat {
        list-style-type: none;
        padding: 15px 25px;
        border-bottom: 1px solid #ebecedc5;
        cursor: pointer;
    }

    .learn {
        text-align: center;
        font-size: 14px;
        height: 40px;
        background-color: #f56962;
        border-radius: 4px;
        opacity: 1;
        font-family: Poppins Normal;
        color: #ffffff;
    }



    .blog-image {
        margin-top: 20px;
    }

    .blog-image img {
        width: 800px;
    }

    .blog-text {
        width: 900px;
    }

    .popular {
        margin-top: 80px;
    }

    .sub-comment-right {
        margin-left: 100px;
        padding-left: 20px;

    }

    a {
        color: #000000;
    }

    a:hover {
        color: #f56962;
        text-decoration: underline;
    }

    li {
        list-style-type: none;
    }

    #view button {
        text-align: center;
        font-size: 14px;
        background-color: #f56962;
        border-radius: 4px;
        opacity: 1;
        font-family: Poppins Normal;
        color: #ffffff;
    }

    .reply {
        text-align: center;
        font-size: 14px;
        background-color: #f56962;
        border-radius: 4px;
        opacity: 1;
        font-family: Poppins Normal;
        color: #ffffff;
    }

    .submit {
        text-align: center;
        font-size: 14px;
        background-color: #f56962;
        border-radius: 4px;
        opacity: 1;
        font-family: Poppins Normal;
        color: #ffffff;
    }

    .author img {
        width: 24px;
        height: 24px;
    }

    .comment-main {
        list-style-type: none;
    }

    .sub_comment {
        width: 100%;
        height: 120px;
        padding: 20px;
    }

    .yourcomment {
        width: 100%;
        height: 140px;

        padding: 20px;

    }

    .articles3 {
        overflow: hidden;
        text-overflow: -o-ellipsis-lastline;
        text-overflow: ellipsis;
        display: block;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;

    }

    @media (max-width: 991px) {
        .popular button {
            margin-top: 40px;
            width: 100%;
        }

        .sub-comment-right {
            margin-left: 20px;
            padding-left: 0px;
        }

        .blog-image {
            position: relative;
            top: 0px;
        }

        .learn {
            text-align: center;
            font-size: 14px;
            width: 100%;
            background-color: #f56962;
            border-radius: 4px;
            opacity: 1;
            font-family: Poppins Normal;
            color: #ffffff;
        }

        /* .sub-comment-right { */
        /* margin-left: 80px; */
        /* padding-left: 20px; */

        /* } */
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #f56962;
        outline: 0;
        box-shadow: 0 0 0 0.1rem rgb(255 24 0 / 25%);
    }

    .search button {
        text-align: center;
        font-size: 14px;
        background-color: #f56962;
        border-radius: 4px;
        opacity: 1;
        font-family: Poppins Normal;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .start {
        margin-top: 100px;
    }

    @media (max-width: 991px) {
        .search {
            display: none;
        }

        .start {
            margin-top: 40px;
        }
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 0;
        width: 100vw;
        height: 100vh;
        background-color: #000;
    }

    .modal-backdrop.show {
        opacity: 0;
    }


    .breadcrumb {
        background-color: #f9f9f9;
        margin-top: 1rem;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .breadcrumb {
            font-size: 12px;
        }
    }

    .breadcrumb-item a {
        color: #999999;
    }

    .breadcrumb-item.active {
        color: #F56962;
    }

    a:hover {
        text-decoration: none;
    }

    .back-to-top-sm {
        position: fixed;
        bottom: 30px;
        right: calc(10% - 6%);
        display: none;
        background-color: #F56962;
        color: #fff;
        padding: 0px 10px 2px 10px;
        width: 41px;
        height: 40px;
        cursor: pointer;
        bottom: 10%;
        z-index: 1023;
        border-radius: 50%;
        border: 2px solid #F56962;

    }

    @media (max-width: 991px) {

        .back-to-top-sm {
            bottom: 20%;
        }
    }
</style>

<body onload="loader()">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gTagId ?>" height="0" width="0" style="display:none;visibility:hidden">
        </iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="header">
        <?php echo ($headerDesktop[0]['headerDesktop']); ?>
    </div>
    <button id="back-to-top-sm" class="btn btn-lg back-to-top-sm text-white">▲</button>
    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Robot Verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- dyanmic page start here  -->
    <?php if ($page_type === 1) { ?>
        <div class="start container-fluid poppins-regular" style="background-color: #FEF0EF;">
            <div class="blog-content container py-5">
                <div class="row">
                    <div class="col-lg-8">
                        <p>By
                            <?php echo $author_name; ?> in <span style="color: #f56962;;"> <?php echo $category_name; ?></span></p>
                        <h3 class="blog-title poppins-medium">
                            <?php echo $title; ?>
                        </h3>
                        <!-- <p>
                        Choose from over 40,000 new learning courses start now
                    </p> -->

                    </div>
                    <!-- <div class="col-lg-4 d-flex justify-content-end mt-5">
                    <button class="btn learn" onclick="window.location.href='<?php //echo $btn_link; 
                                                                                ?>';">Start Learning Now</button>

                </div> -->
                </div>
            </div>
        </div>
        <div class="container poppins-regular">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb" style="display: block;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="blog">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $category_name ?></li>
                        </ol>
                    </nav>
                    <div class="container">

                        <img src="<?php echo $hero_image; ?>" alt="<?php echo $hero_image_alt; ?>" class="blog-image d-flex justify-content-center" alt="about" style="width:100%;">
                        <div class="blog-title2 mt-4">
                            <h3 class="blog-title poppins-medium">
                                <?php echo $title; ?>
                            </h3>

                        </div>
                        <div class="blog-date d-flex justify-content-start poppins-medium">
                            <p>Posted on
                                <?php echo date("F jS, Y", strtotime($date_of_posting)); ?> </p>
                            <p style="margin-left: 15px;">By <span style="color: #f56962;"><?php echo $author_name; ?></span></p>


                        </div>
                        <div class="category-list poppins-medium">
                            <p style="font-size:12px;">Under <span style="color: #f56962;"><?php echo $category_name ?></span></p>

                        </div>
                        <div class="category-list poppins-medium">
                            <p style="font-size:12px;">Tags: <span style="color: #f56962;"><?php echo $keywords ?></span></p>

                        </div>




                        <hr>
                        <div class="pt-0 mt-0 container  poppins-regular imgContent">
                            <?php echo $content ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <!-- right sidebar start-->
                    <?php echo ($rightSidebar[0]['sidebar']); ?>
                    <!-- right sidebar end-->
                    
                </div>
            </div>
        </div>
        <div class="container poppins-regular mt-4 pb-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
                    // $article_id = $blog['article_id'];
                    // $result2 = mysqli_query($link, "SELECT * FROM `comments` WHERE `article_id` =  '$article_id' ");
                    // if (mysqli_num_rows($result2) != 0 && $blog['comments'] == 'true') {
                    ?>
                    <h4 class="poppins-medium pt-3">COMMENTS</h4>
                    <?PHP
                    if ($total_comments == null) {
                        $total_comments = 0;
                    }
                    ?>
                    <p>There are <strong><?php echo $total_comments ?></strong> comments on this post.</p>
                    <ul class="p-2">
                        <?php
                        // $i = 1;
                        if ($total_comments !== 0) {
                            foreach ($comments as $key => $row5) {

                        ?>
                                <li class="comment-main">
                                    <div class="comment-right">

                                        <hr>

                                        <div class="comment-info">
                                            <div style="display: flex;">
                                                <p class="poppins-medium mb-2" style="margin:0px;padding:0px;font-size: 18px;">
                                                    <?php echo ($row5[0]['name']);
                                                    echo "<br>"; ?></p>

                                                <p class="mb-2" style="color:#9f9f9f;margin: auto 0;padding: 0px 0 0 17px;font-size: 14px;">
                                                    <?php echo ($row5[0]['time']); ?>
                                                </p>
                                            </div>
                                            <p style="font-size: 16px;">
                                                <?php echo ($row5[0]['comments']); ?>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="sub-comment-right mt-4">
                                        <?php
                                        // $comment_id = $row1['comment_id'];
                                        // $result3 = mysqli_query($link, "SELECT * FROM `sub_comment` WHERE `comment_id` = '$comment_id'");
                                        // if (mysqli_num_rows($result3) != 0) {

                                        ?>
                                        <?php
                                        $abc = ($row5[1]);
                                        // print_r($abc[0]);
                                        foreach ($abc as $key => $value) {
                                            // echo count($abc);
                                            // print_r($value['sub_name']);

                                        ?>
                                            <div class="container mt-3" style="border-left: solid 1px #8d8d92">
                                                <div style="display: flex;">
                                                    <p class="poppins-medium mb-2" style="margin:0px;padding:0px;font-size: 15px;">
                                                        <?php echo ($value['sub_name']) ?>
                                                    </p>

                                                    <p class="mb-2" style="color:#9f9f9f;margin: auto 0;padding: 0px 0 0 17px;font-size: 12px;">
                                                        <?php echo ($value['sub_time']); ?>
                                                    </p>
                                                </div>
                                                <p style="font-size: 15px;">
                                                    <?php echo ($value['sub_comments']); ?>
                                                </p>
                                            </div>
                                        <?php
                                        }
                                        // }
                                        ?>
                                    </div>
                                    <div>
                                        <button class="btn btn-md reply" data-toggle="collapse" href="#multiCollapseExample<?php echo ($row5[0]['number']);  ?>" role="button" aria-expanded="false" aria-controls="multiCollapseExample<?php echo ($row5[0]['number']); ?>"><i class="fa fa-share"></i> reply</button>
                                        <div class="collapse multi-collapse" id="multiCollapseExample<?php echo ($row5[0]['number']);  ?>">

                                            <form class="comment-form mt-4" style="padding:0px;padding-right:20px;" method="post" action="https://cms.quadbtech.com/article-dashboard/API/addSubcomment" onsubmit="return Validate()" target="_self">
                                                <input id="article_id" name="article_id" type="hidden" value="<?php echo $article_id; ?>" required>
                                                <input type="hidden" name="comment_id" value="<?php echo ($row5[0]['comment_id']); ?> " required>
                                                <input id="url_lines" name="url_lines" type="hidden" value="<?php echo $url_lines; ?>" required>
                                                <input id="robot" name="response" type="hidden">
                                                <div class="row">
                                                    <div class="col-lg-6 mt-3">
                                                        <input class="form-control" type="text" placeholder="Name*" name="name" required>
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <input class="form-control" type="text" placeholder="Email*" name="email" required>
                                                    </div>
                                                </div>
                                                <p class="comment-form-comment"><textarea class="form-control mt-2" id="sub_comment<?php echo ($row5[0]['number']); ?>" class="sub_comment" name="comment" placeholder="your message..." required></textarea></p>
                                                <input type="submit" class="add-sub-comment reply btn btn-md mt-4" value="Reply">
                                            </form>

                                        </div>
                                    </div>
                                </li>
                        <?php
                            }
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <hr>
                    <div class="poppins-regular">
                        <?php

                        if ($comments_type == 'false') {
                        ?>
                            <form id="commentform" class="comment-form">
                                <h4 class="mt-2" class="comment-notes">Comments are disabled on this post</h4>

                            </form>
                        <?php
                        } else {
                        ?>
                            <h4 class="poppins-medium">ADD YOUR COMMENT</h4>
                            <form class="comment-form mt-2" method="post" action="https://cms.quadbtech.com/article-dashboard/API/addComments" onsubmit="return Validate()" target="_self">
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <input id="user_name" type="text" class="form-control" placeholder="Name*" name="name" required>

                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <input id="user_email" type="email" class="form-control" placeholder="Email*" name="email" required>

                                    </div>
                                </div>
                                <input id="article_id" name="article_id" type="hidden" value="<?php echo $article_id; ?>" required>
                                <input id="url_lines" name="url_lines" type="hidden" value="<?php echo $url_lines; ?>" required>
                                <input id="robot" name="response" type="hidden">
                                <p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="your message..." class="yourcomment form-control mt-3" required></textarea></p>
                                <p class="form-submit mt-4 mb-4"><input name="submit" type="submit" class="submit btn btn-md" value="COMMENT"></p>
                            </form>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } else if ($page_type === 2) { ?>
        <div class="start container-fluid poppins-regular" style="background-color: #FEF0EF;">
            <div class="blog-content container py-5">
                <div class="row">
                    <div class="col-lg-8">
                        <p>By
                            <?php echo $author_name; ?> in <span style="color: #f56962;;"> <?php echo $category_name; ?></span></p>
                        <h3 class="blog-title poppins-medium">
                            <?php echo $title; ?>
                        </h3>
                        <!-- <p>
                        Choose from over 40,000 new learning courses start now
                    </p> -->


                    </div>
                    <!-- <div class="col-lg-4 d-flex justify-content-end mt-5">
                    <button class="btn learn" onclick="window.location.href='<?php //echo $btn_link; 
                                                                                ?>';">Start Learning Now</button>
                </div> -->
                </div>
            </div>
        </div>
        <div class="container poppins-regular">
            <nav aria-label="breadcrumb" style="display: block;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="blog" target="_self">Home</a></li>
                    <li class="breadcrumb-item"><a href="blog/<?= $category_slug ?>" target="_self"><?= $category_name ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $sub_category_name ?></li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-lg-8">
                    <div class="container">
                        <img src="<?php echo $hero_image ?>" alt="<?php echo $hero_image_alt ?>" class="blog-image d-flex justify-content-center" alt="about" style="width:100%;">
                        <div class="blog-title2 mt-4">
                            <h3 class="blog-title poppins-medium">
                                <?php echo $title; ?>
                            </h3>
                        </div>
                        <div class="blog-date d-flex justify-content-start poppins-medium">
                            <p>Posted on
                                <span style="color: #f56962;"><?php echo date("F jS, Y", strtotime($date_of_posting)); ?>
                                </span>
                            </p>
                            <p style="margin-left: 15px;">By <span style="color: #f56962;"><?php echo $author_name; ?></span></p>


                        </div>
                        <div class="category-list poppins-medium">
                            <p style="font-size:12px;">Under <span style="color: #f56962;"><?php echo $category_name ?>,<?php echo $sub_category_name ?></span></p>

                        </div>
                        <div class="category-list poppins-medium">
                            <p style="font-size:12px;">Tags: <span style="color: #f56962;"><?php echo $keywords ?></span></p>
                        </div>
                        <hr>
                        <div class="pt-0 mt-0 container  poppins-regular imgContent">
                            <?php echo $content ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <!-- right sidebar start-->
                    <?php echo ($rightSidebar[0]['sidebar']); ?>
                    <!-- right sidebar end-->

                    

                   


                    
                </div>
            </div>
        </div>
        <div class="container poppins-regular mt-4 pb-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?PHP
                    if ($total_comments == null) {
                        $total_comments = 0;
                    }
                    ?>
                    <h4 class="poppins-medium pt-3">COMMENTS</h4>
                    <p>There are <strong><?php echo $total_comments ?></strong> comments on this post.</p>
                    <ul class="p-2">
                        <?php
                        if ($total_comments !== 0) {
                            foreach ($comments as $key => $row5) {
                                // $i = 1;
                                // while ($row51 = mysqli_fetch_array($result2)) {
                                // print_r($row5[0]['sub_name']);
                                //    echo($row5[0]['number']);


                        ?>
                                <li class="comment-main">
                                    <div class="comment-right">

                                        <hr>

                                        <div class="comment-info">
                                            <div style="display: flex;">
                                                <p class="poppins-medium mb-2" style="margin:0px;padding:0px;font-size: 18px;">
                                                    <?php echo ($row5[0]['name']);
                                                    echo "<br>"; ?></p>

                                                <p class="mb-2" style="color:#9f9f9f;margin: auto 0;padding: 0px 0 0 17px;font-size: 14px;">
                                                    <?php echo ($row5[0]['time']); ?>
                                                </p>
                                            </div>
                                            <p style="font-size: 16px;">
                                                <?php echo ($row5[0]['comments']); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="sub-comment-right mt-4">
                                        <?php
                                        // $comment_id = $row1['comment_id'];
                                        // $result3 = mysqli_query($link, "SELECT * FROM `sub_comment` WHERE `comment_id` = '$comment_id'");
                                        // if (mysqli_num_rows($result3) != 0) {

                                        ?>
                                        <?php
                                        $abc = ($row5[1]);
                                        // print_r($abc[0]);
                                        foreach ($abc as $key => $value) {
                                            // echo count($abc);
                                            // print_r($value['sub_name']);

                                        ?>
                                            <div class="container mt-3" style="border-left: solid 1px #8d8d92">
                                                <div style="display: flex;">
                                                    <p class="poppins-medium mb-2" style="margin:0px;padding:0px;font-size: 15px;">
                                                        <?php echo ($value['sub_name']) ?>
                                                    </p>

                                                    <p class="mb-2" style="color:#9f9f9f;margin: auto 0;padding: 0px 0 0 17px;font-size: 12px;">
                                                        <?php echo ($value['sub_time']); ?>
                                                    </p>
                                                </div>
                                                <p style="font-size: 15px;">
                                                    <?php echo ($value['sub_comments']); ?>
                                                </p>
                                            </div>
                                        <?php
                                        }
                                        // }
                                        ?>

                                    </div>
                                    <div>
                                        <button class="btn btn-md reply" data-toggle="collapse" href="#multiCollapseExample<?php echo ($row5[0]['number']);  ?>" role="button" aria-expanded="false" aria-controls="multiCollapseExample<?php echo ($row5[0]['number']); ?>"><i class="fa fa-share"></i> reply</button>
                                        <div class="collapse multi-collapse" id="multiCollapseExample<?php echo ($row5[0]['number']);  ?>">

                                            <form class="comment-form mt-4" style="padding:0px;padding-right:20px;" method="post" action="https://cms.quadbtech.com/article-dashboard/API/addSubcomment" onsubmit="return Validate()" target="_self">
                                                <input id="article_id" name="article_id" type="hidden" value="<?php echo $article_id; ?>" required>
                                                <input type="hidden" name="comment_id" value="<?php echo ($row5[0]['comment_id']); ?> " required>
                                                <input id="url_lines" name="url_lines" type="hidden" value="<?php echo $url_lines; ?>" required>
                                                <input id="robot" name="response" type="hidden">
                                                <div class="row">
                                                    <div class="col-lg-6 mt-3">
                                                        <input class="form-control" type="text" placeholder="Name*" name="name" required>
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <input class="form-control" type="text" placeholder="Email*" name="email" required>
                                                    </div>
                                                </div>
                                                <p class="comment-form-comment"><textarea class="form-control mt-2" id="sub_comment<?php echo ($row5[0]['number']); ?>" class="sub_comment" name="comment" placeholder="your message..." required></textarea></p>
                                                <input type="submit" class="add-sub-comment reply btn btn-md mt-4" value="Reply">
                                            </form>

                                        </div>
                                    </div>
                                </li>
                        <?php
                            }
                        } ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <hr>
                    <div class="poppins-regular">
                        <?php
                        if ($comments_type == 'false') {
                        ?>
                            <form id="commentform" class="comment-form">
                                <h4 class="mt-2" class="comment-notes">Comments are disabled on this post</h4>
                            </form>
                        <?php
                        } else {
                        ?>
                            <h4 class="poppins-medium">ADD YOUR COMMENT</h4>
                            <form class="comment-form mt-2" method="post" action="https://cms.quadbtech.com/article-dashboard/API/addComments" onsubmit="return Validate()" target="_self">
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <input id="user_name" type="text" class="form-control" placeholder="Name*" name="name" required>

                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <input id="user_email" type="email" class="form-control" placeholder="Email*" name="email" required>

                                    </div>
                                </div>
                                <input id="article_id" name="article_id" type="hidden" value="<?php echo $article_id; ?>" required>
                                <input id="url_lines" name="url_lines" type="hidden" value="<?php echo $url_lines; ?>" required>
                                <input id="robot" name="response" type="hidden">
                                <p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="your message..." class="yourcomment form-control mt-3" required></textarea></p>
                                <p class="form-submit mt-4 mb-4"><input name="submit" type="submit" class="submit btn btn-md" value="COMMENT"></p>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    <?php } else if ($page_type === 3) { ?>
        <div class="start container-fluid poppins-regular" style="background-color: #FEF0EF;">
            <div class="blog-content container py-5">
                <div class="row">
                    <div class="col-lg-8">
                        <p>By
                            <?php echo $row2[0]['author_name']; ?> in <span style="color: #f56962;;"> <?php echo $row2[0]['category_name']; ?></span></p>
                        <h3 class="blog-title poppins-medium">
                            <?php echo $row2[0]['title']; ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container poppins-regular pb-5">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb" style="display: block;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="blog">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Preview</li>
                        </ol>
                    </nav>
                    <div class="container">
                        <img img src="<?php echo $row2[0]['hero_image'] ?>" alt="<?php echo $row2[0]['hero_image_alt'] ?>" class="blog-image d-flex justify-content-center" alt="about" style="width:100%;">
                        <div class="blog-title2 mt-4">
                            <h3 class="blog-title poppins-medium">
                                <?php echo $row2[0]['title']; ?>
                            </h3>

                        </div>
                        <div class="blog-date d-flex justify-content-start poppins-medium">
                            <p>Posted on
                                <?php echo date("F jS, Y", strtotime($row2[0]['date_of_posting'])); ?> </p>
                            <p style="margin-left: 15px;">By <span style="color: #f56962;"><?php echo $row2[0]['author_name']; ?></span></p>
                        </div>
                        <div class="category-list poppins-medium">
                            <p style="font-size:12px;">Under <span style="color: #f56962;"><?php echo $row2[0]['category_name'] ?>,
                                    <?php if (isset($_GET['sub'])) {
                                        echo $row2[0]['sub_category_name'];
                                    } ?></span></p>

                        </div>
                        <hr>
                        <div class="pt-0 mt-0 container  poppins-regular imgContent">
                            <?php echo $row2[0]['content'] ?>
                        </div>
                    </div>
                    <div class="container mb-4">
                        <div class="row">
                            <?php
                            $keywords = [];
                            $keywords = explode(",", $row2[0]['keywords']);
                            foreach ($keywords as $key => $value) {
                            ?>
                                <div class="poppins-regular col-2  p-0 mr-2" style="background-color: #e0e2f3;">
                                    <p class="text-center p-0 mt-3">
                                        <?php echo ($value); ?>
                                    </p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <hr>
                    </div>
                    <div class="poppins-regular container mb-4">
                        <div class="col-5">
                            <div class="row">
                                <div class="col-6 d-flex justify-content-center">
                                    <img class="author-image" src="<?php echo $row2[0]['author_profile_image']; ?>" style="height: 60px;width: 60px;">
                                </div>
                                <div class="col-6  poppins-regular">
                                    <p class="mb-0" style="color: #8d8d92;">Written By</p>
                                    <p style="font-weight: bold;">
                                        <?php echo $row2[0]['author_name']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    
                    <!-- right sidebar start-->
                    <?php echo ($rightSidebar[0]['sidebar']); ?>
                    <!-- right sidebar end-->
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- dyanmic page end here  -->
    <div class="footer mt-3 ">
        <?php echo ($footerDesktop[0]['footerApi']); ?>
    </div>
    <div class="d-lg-none position-relative">
        <div class="header-mobile"></div>
        <div class="navbar-bottom fixed-bottom">
            <?php echo ($navMobileBottom[0]['footerMobileApi']); ?>
        </div>
    </div>
</body>
<script type="text/javascript " src="https://cms.quadbtech.com/bg_util/jquery-3.4.1.min.js "></script>
<script type="text/javascript " src="https://cms.quadbtech.com/bg_util/bootstrap.min.js "></script>
<script type="text/javascript" src="https://cms.quadbtech.com/bg_util/loader.js"></script>
<script type="text/javascript" src="https://cms.quadbtech.com/bg_util/headerMobile.js"></script>
<script type="text/javascript" src="https://cms.quadbtech.com/bg_util/navMobileBottom.js"></script>
<script>
    function removeIt() {
        if (window.matchMedia("(max-width: 991px)").matches) {
            $('.header').removeClass('fixed-top');
            $('.header').removeClass('fixed');
            $('.header').removeClass('shadow');
            $('.start').css('margin-top', '40px');
        } else {
            $('.header').addClass('fixed-top');
            $('.start').css('margin-top', '100px');
        }
    }
    removeIt();

    $(window).scroll(function() {

        var sticky = $('.header'),
            scroll = $(window).scrollTop();

        if (scroll >= 50) {
            sticky.addClass('fixed shadow fixed-top');
        } else {
            sticky.removeClass('fixed shadow');
        }
        removeIt();
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top-sm').fadeIn();
        } else {
            $('#back-to-top-sm').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top-sm').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });


    function Validate() {
        var response = grecaptcha.getResponse();
        if (response == "") {
            $("#myModal").modal('show');
            return false;
        } else {
            $('#robot').val(response);
            return true;
        }
        return false;
    }
    $("table").addClass("table");
    $(document).ready(function() {
        $(".table").css("width", "100%");
        $(".table").addClass("table-responsive");
        $(".table tbody").addClass("table-bordered");
        $(".table thead").addClass("table-bordered");
        $(".imgContent img").css('max-width', '100%');
        $(".imgContent img").css('height', 'auto');
        $(".imgContent ol>li").css('list-style-type', 'decimal');
        $(".imgContent ul>li").css('list-style-type', 'disc');
    });
</script>

</html>