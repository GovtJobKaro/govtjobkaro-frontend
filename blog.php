<?php
session_start();
$url_path = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$baseurl = $url_path . '/';
date_default_timezone_set("Asia/Calcutta");
$current_date = strtotime(date("r"));
/* -------------------------- string encryption start to pretend as differ page for htaccess ------------------------- */
// search-page : search = 'lpkuvpevpn'
// single-page: view = 'rrozunbrfe'
// sub-category all page : sub-all = 'nvcxchtjne'
// category-all page : all= 'idumjwgygb'
// preview-page : preview = 'kafqlhzwab'
/* --------------------------  string encryption start to pretend as differ page htaccess------------------------- */
if (!isset($_REQUEST['page'])) {
    $page = 1;
} else {
    $page = $_REQUEST['page'];
}
$page_type = 0;

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

//common content for each page start
$headerDesktop = CallApi('https://cms.quadbtech.com/article-dashboard/API/headerApi');
$response2 = CallApi('https://cms.quadbtech.com/article-dashboard/API/recentPost');
$responseAd = CallApi('https://cms.quadbtech.com/article-dashboard/API/sidebarImages.php');
$footerDesktop = CallApi('https://cms.quadbtech.com/article-dashboard/API/footerApi');
$navMobileBottom = CallApi('https://cms.quadbtech.com/article-dashboard/API/navMobileBottom');
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$gTagId = $response2[1][0]['gTagid'];
$rightSidebar = CallApi('https://cms.quadbtech.com/article-dashboard/API/rightSidebar');

//common content for each page end

/* ----------------------------- my code start ---------------------------- */

//main content which is change in every page start
if (isset($_REQUEST['s'])) {
    //for search the article with pagination
    $meta_title = 'Blog';
    $search = $_REQUEST['s'];
    $response = CallApi('https://cms.quadbtech.com/article-dashboard/API/searchApi?s=' . $search . '&page=' . $page);
    $number_of_result = $response['number_of_result'];
    $number_of_page = $response['total_pages'];
    $search_string = $response['search'];
    $meta_description = implode(' ', array_slice(explode(' ', 'With over 267 years of combined teaching expreience, GovtJobKaro is the perfect government exam test prepartion for you.'), 0, 15)) . "\n";
    $page_type = 5;
} else if (isset($_REQUEST['cat']) && (isset($_REQUEST['sub']) && (strpos($_SERVER['REQUEST_URI'], "nvcxchtjne") !== false))) {
    //for fetch all articles belongs in sub-category with pagination
    $category = $_REQUEST['cat'];
    $sub_category = $_REQUEST['sub'];
    $category = $_REQUEST['cat'];
    $response = CallApi('https://cms.quadbtech.com/article-dashboard/API/fetchAllSubBlog?cat=' . $category . '&sub=' . $sub_category . '&page=' . $page);
    $number_of_page = $response['total_pages'];
    $category_name = $response['category_name'];
    $sub_category_name = $response['sub_category_name'];
    $sub_category_description = $response['sub_category_description'];
    $meta_description = implode(' ', array_slice(explode(' ', $sub_category_description), 0, 15)) . "\n";
    $meta_title = $sub_category_name;
    $page_type = 4;
} else if (isset($_REQUEST['cat']) && (strpos($_SERVER['REQUEST_URI'], "idumjwgygb") !== false)) {
    //for fetch all articles belongs in category with pagination
    $category = $_REQUEST['cat'];
    $response = CallApi('http://cms.quadbtech.com/article-dashboard/API/fetchAllCatBlog?cat=' . $category . '&page=' . $page);
    $response2 = CallApi('https://cms.quadbtech.com/article-dashboard/API/recentPost');
    $number_of_page = $response['total_pages'];
    $category_name = $response['category_name'];
    $category_description = $response['category_description'];
    $meta_description = implode(' ', array_slice(explode(' ', $category_description), 0, 15)) . "\n";
    $meta_title = $response['category_name'];
    $page_type = 3;
} else if (isset($_REQUEST['cat'])) {
    //for fetch all sub category belongs in category or uncategorized
    $category = $_REQUEST['cat'];
    $response = CallApi('https://cms.quadbtech.com/article-dashboard//API/category?cat=' . $category);
    $response3 = CallApi('https://cms.quadbtech.com/article-dashboard/API/fetchAllCatBlog?cat=' . $category . '&page=' . $page);
    $category_name = $response['category_name'];
    $category_description = $response['category_description'];
    $meta_description = implode(' ', array_slice(explode(' ', $category_description), 0, 15)) . "\n";
    $total_cat_articles = $response3['total_articles'];
    $meta_title = $category_name;
    $page_type = 2;
} else {
    //for fetch all blog which in category and subcategory
    $meta_title = 'Blog';
    $category_description = 'With over 267 years of combined teaching expreience, GovtJobKaro is the perfect government exam test prepartion for you.';
    $meta_description = implode(' ', array_slice(explode(' ', $category_description), 0, 15)) . "\n";
    $mainPageDetails = CallApi('https://cms.quadbtech.com/article-dashboard/API/mainPageDetails');
    $response = CallApi('https://cms.quadbtech.com/article-dashboard/API/fetchAllBlog');
    $page_type = 1;
}
//main content which is change in every page end
// echo "Page-Type: " . $page_type;
/* ------------------------------ my code end ----------------------------- */
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
    <base href="<?php echo $baseurl; ?>">
    <title><?php echo $meta_title ?> | GovtJobKaro - Crack any Government Exams </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <link href="bg_util/style.css" rel="stylesheet"> -->
    <meta name="description" content="<?php echo ($meta_description); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Enter a keywords for the page in tag -->
    <meta name="Keywords" content="<?php echo ($meta_title); ?>">
    <!-- Enter Page title -->
    <meta property="og:title" content="<?php echo $meta_title ?> | GovtJobKaro - Crack any Government Exams " />
    <!-- Enter Page URL -->
    <meta property="og:url" content="<?php echo ($actual_link) ?>" />
    <!-- Enter page description -->
    <meta property="og:description" content="<?php echo ($meta_description); ?>...">
    <!-- Enter Logo image URL for example : http://cryptonite.finstreet.in/images/cryptonitepost.png -->
    <meta property="og:image" itemprop="image" content="https://partner.govtjobkaro.com/meta-img.jpg" />
    <meta property="og:image:secure_url" itemprop="image" content="https://partner.govtjobkaro.com/meta-img.jpg" />
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    <link href="https://cms.quadbtech.com/bg_util/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"
        integrity="sha512-Mo79lrQ4UecW8OCcRUZzf0ntfMNgpOFR46Acj2ZtWO8vKhBvD79VCp3VOKSzk6TovLg5evL3Xi3u475Q/jMu4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cms.quadbtech.com/bg_util/loader.css">

    <link rel="icon" href="https://cms.quadbtech.com/icons/india.png">
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



#view button {
    text-align: center;
    font-size: 14px;
    background-color: #f56962;
    border-radius: 4px;
    opacity: 1;
    font-family: Poppins Normal;
    color: #ffffff;
    width: 100%;
    margin-bottom: 10px;

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

.popular {
    margin-top: 80px;
}

.author img {
    width: 24px;
    height: 24px;
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

.sideline {
    margin-top: 5px;
}

/* .states1{
            
        columns: 2;
        -webkit-columns: 2;
        -moz-columns: 2;

        } */
.states {

    margin-bottom: 5px;

}

.articles1 {

    padding: 15px 15px 0 15px;
    list-style: none;
    border-top: 2px solid #f16622;
    background-color: #fff;
    display: inline-block;
    width: 100%;
    margin-bottom: 0;

}

.articles1 li {

    width: 48%;
    margin-right: 2%;
    float: left;
    position: relative;
}

.articles {
    overflow: hidden;
    text-overflow: -o-ellipsis-lastline;
    text-overflow: ellipsis;
    display: block;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;

}


.articles2 {

    padding: 15px 15px 0 15px;
    list-style: none;
    border-top: 2px solid #f16622;
    background-color: #fff;
    display: inline-block;
    width: 100%;
    margin-bottom: 0;

}

/* .articles2 li {
        margin-bottom: 10px;
      
    } */



.articles3 {
    overflow: hidden;
    text-overflow: -o-ellipsis-lastline;
    text-overflow: ellipsis;
    display: block;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;

}

.posted {
    font-size: 12px;
    color: #000000b8;
    margin-top: 5px;
    margin-bottom: 0px;

}

.blogs {
    height: 90px;

}

.page-link {
    background-color: #f56962;
    color: #ffffff;
}

.page-link:hover {
    background-color: #f56962;
    color: #000000;
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #f56962;
    outline: 0;
    box-shadow: 0 0 0 0.1rem rgb(255 24 0 / 25%);
}

.start {
    margin-top: 100px;
}

@media (max-width: 1200px) {
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
        bottom: 125px;
    }

    .popular button {
        margin-top: 40px;
        width: 100%;
    }

    .arrow-r {
        padding: 0px;
    }
}

@media (max-width: 991px) {
    .search {
        display: none;
    }

    .start {
        margin-top: 160px;
    }
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
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gTagId ?>" height="0" width="0"
            style="display:none;visibility:hidden">
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
    <div class="start container poppins-regular">
        <div class="row">
            <?php if ($page_type === 1) { ?>
            <div class="col-lg-8 mb-3">
                <h4 class="mt-2" style="font-weight:bold;"><?php echo $mainPageDetails[0]['title'] ?></h4>
                <p class="mt-4 mb-5"><?php echo $mainPageDetails[0]['description'] ?></p>
                <?php
                    foreach ($response as $key1 => $row) {
                    ?>
                <h4 class="poppins-medium container p-0 mt-3" style="margin-bottom: 20px; ">
                    <?php echo $row[0]['category']; ?></h4>

                <ul class="articles1 p-2 mt-2">
                    <?php
                            $count1 = 0;
                            foreach ($row[1] as $key2 => $row1) {
                                date_default_timezone_set('Asia/Calcutta');
                                if (strtotime($row[1][$key2]['date_of_posting']) < time()) {
                            ?>
                    <li class="blogs pt-2">
                        <div class="row">
                            <div class="col-1 arrow-r">
                                <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 15px;"></i>
                            </div>
                            <div class="col-10">
                                <a class="articles" href="<?php echo $row[1][$key2]['url_lines'] . '/rrozunbrfe' ?>">
                                    <?php echo $row[1][$key2]['title'] ?>
                                </a>
                                <p class="posted">
                                    <?php echo date("F jS, Y", strtotime($row[1][$key2]['date_of_posting'])); ?>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php

                                    $count1 += 1;
                                }
                            } ?>
                </ul>
                <?php
                        if ($row[0]['total_articles'] >= 8) { ?>
                <div id="view">
                    <button class="btn"
                        onclick="location.href='<?= $baseurl ?>blog/<?php echo ($row[0]['category_slug']); ?>'">View
                        all</button>
                </div>
                <?php
                        }
                    }
                    ?>


            </div>
            <?php } else if ($page_type === 2) { ?>
            <div class="col-lg-8 mb-3">
                <nav aria-label="breadcrumb" style="display: block;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="blog" target="_self">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo ($category_name); ?></li>
                    </ol>
                </nav>
                <h4 class="mt-2" style="font-weight:bold;"><?php echo ($category_name); ?></h4>
                <p class="mt-4 mb-5"><?php echo ($category_description); ?></p>

                <?php
                    $count1 = 0;
                    foreach ($response[0] as $key1 => $row) {
                        if (count($row[1]) > 0) {

                    ?>
                <h4 class="poppins-medium container p-0 mt-3" style="margin-bottom: 20px; ">
                    <?php echo ($row[0]['sub_category_name']); ?></h4>
                <ul class="articles1 p-2">
                    <?php

                                foreach ($row[1] as $key2 => $row1) { ?>
                    <li class="blogs mt-2">
                        <div class="row">
                            <div class="col-1 arrow-r">
                                <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 15px;"></i>
                            </div>
                            <div class="col-11">
                                <a class="articles" href="<?php echo $row1['url_lines'] . '/rrozunbrfe' ?>">
                                    <?php echo $row1['title'] ?>
                                </a>
                                <p class="posted">
                                    <?php echo date("F jS, Y", strtotime($row1['date_of_posting'])); ?>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php
                                } ?>
                </ul>
                <?php

                        }
                        $count1 = $count1 + 1;

                        if (($row[0]['total_articles']) >= 8) { ?>
                <div id="view">
                    <button class="btn"
                        onclick="location.href='<?= $baseurl ?>blog/<?php echo ($category); ?>/<?php echo ($row[0]['sub_category_slug']); ?>/nvcxchtjne'">View
                        all</button>
                </div>
                <?php
                        }
                    }
                    if ((count($response3[0])) > 0) {
                        ?>
                <h4 class="poppins-medium container p-0 mt-3" style="margin-bottom: 20px; ">Others</h4>
                <ul class="articles1 p-2">
                    <?php
                            foreach ($response3[0] as $key22 => $row11) { ?>
                    <li class="blogs mt-2">
                        <div class="row">
                            <div class="col-1 arrow-r">
                                <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 15px;"></i>
                            </div>
                            <div class="col-11">
                                <a class="articles" href="<?php echo $row11['url_lines'] . '/rrozunbrfe' ?>">
                                    <?php echo $row11['title'] ?>
                                </a>
                                <p class="posted">
                                    <?php echo date("F jS, Y", strtotime($row11['date_of_posting'])); ?>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php
                            } ?>
                </ul>
                <?php
                        if ($total_cat_articles > 8) { ?>
                <div id="view">
                    <button class="btn"
                        onclick="location.href='<?= $baseurl ?>blog/<?php echo ($category); ?>/idumjwgygb'">View
                        all</button>
                </div>
                <?php
                        }
                    }
                    ?>
            </div>
            <?php } else if ($page_type === 3) { ?>
            <div class="col-lg-8 mb-3">
                <nav aria-label="breadcrumb" style="display: block;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="blog" target="_self">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $category_name ?></li>
                    </ol>
                </nav>
                <h4 class="mt-2" style="font-weight:bold;"><?php echo $category_name; ?></h4>
                <p class="mt-4 mb-5"><?php echo $category_description; ?></p>
                <ul class="articles1 p-2">
                    <?php
                        foreach ($response[0] as $key => $row) {
                            if (strtotime($row['date_of_posting']) < time()) {
                        ?>
                    <li class="blogs mt-2">
                        <div class="row">
                            <div class="col-1 arrow-r">
                                <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 15px;"></i>
                            </div>
                            <div class="col-11">
                                <a class="articles" href="<?php echo $row['url_lines'] . '/rrozunbrfe'; ?>">
                                    <?php echo $row['title'] ?>
                                </a>
                                <p class="posted">
                                    <?php echo date("F jS, Y", strtotime($row['date_of_posting'])); ?>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php
                            }
                        }
                        ?>
                </ul>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                            for ($page = 1; $page <= $number_of_page; $page++) {
                                echo ('<li class="page-item"><a class="page-link" href = "blog/' . $category . '/' . $page . '/idumjwgygb">' . $page . '</a></li>');
                            ?>
                        <?php
                            }
                            ?>
                    </ul>
                </nav>
            </div>
            <?php } else if ($page_type === 4) { ?>
            <div class="col-lg-8 mb-3">
                <nav aria-label="breadcrumb" style="display: block;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="blog" target="_self">Home</a></li>
                        <li class="breadcrumb-item"><a href="blog/<?= $category ?>"
                                target="_self"><?= $category_name ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $sub_category_name ?></li>
                    </ol>
                </nav>
                <h4 class="mt-2" style="font-weight:bold;"><?php echo ($sub_category_name); ?></h4>
                <p class="mt-4 mb-5"><?php echo $sub_category_description; ?></p>
                <ul class="articles1 p-2">
                    <?php
                        foreach ($response[0] as $key => $row) {
                            if (strtotime($row['date_of_posting']) < time()) {
                        ?>
                    <li class="blogs mt-2">
                        <div class="row">
                            <div class="col-1 arrow-r">
                                <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 15px;"></i>
                            </div>
                            <div class="col-11">
                                <a class="articles" href="<?php echo $row['url_lines'] . '/rrozunbrfe'; ?>">
                                    <?php echo $row['title'] ?>
                                </a>
                                <p class="posted">
                                    <?php echo date("F jS, Y", strtotime($row['date_of_posting'])); ?>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php
                            }
                        }
                        ?>
                </ul>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                            for ($page = 1; $page <= $number_of_page; $page++) {
                                echo ('<li class="page-item"><a class="page-link" href = "blog/' . $category . '/' . $sub_category . '/' . $page . '/nvcxchtjne">' . $page . '</a></li>');
                            ?>

                        <?php
                            }
                            ?>
                    </ul>
                </nav>
            </div>
            <?php } else if ($page_type === 5) { ?>
            <div class="col-lg-8 mb-3">
                <div class="row">
                    <div class="col-12">
                        <h6>Search Results for <span style="color: #f16622;"><?php echo $search_string; ?></span></h6>
                        <hr>
                    </div>
                </div>
                <?php
                    if ($number_of_result > 0) {
                        foreach ($response[0] as $key => $row) {
                    ?>
                <div>
                    <h4><a href="<?php echo $row['url_lines'] . '/rrozunbrfe' ?>"><?php echo ($row['title']); ?></a>
                    </h4>
                    <a href="<?php echo $row['url_lines'] . '/rrozunbrfe' ?>"><img
                            src="<?php echo $row['hero_image'] ?>" alt="<?php echo $row['hero_image_alt'] ?>"
                            alt="about" style="width:100%;" class="mt-2 mb-3"></a>
                    <div class="article-info">
                        <p style="font-size: 14px;color:#827676;display:inline-block">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <?php echo $row['author_name'] ?>
                        </p>
                        <p style="font-size: 14px;display:inline-block;color:#827676" class="ml-2">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?php echo date("F jS, Y", strtotime($row['date_of_posting'])); ?>
                        </p>
                        <p style="font-size: 14px;display:inline-block;color:#827676" class="ml-2">
                            <i class="fa fa-tag" aria-hidden="true"></i>
                            <?php echo ($row['keywords']); ?>
                        </p>
                    </div>
                </div>
                <hr>
                <?php
                        }
                        ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                                for ($page = 1; $page <= $number_of_page; $page++) {
                                    echo ('<li class="page-item"><a class="page-link" href = "blog/' . $search . '/' . $page . '/lpkuvpevpn">' . $page . '</a></li>');
                                ?>
                        <?php
                                }
                                ?>
                    </ul>
                </nav>
                <?php

                    } else {
                    ?>
                <h5>Nothing Found.</h5>
                <?php
                    }
                    ?>
            </div>
            <?php } ?>
            <div class="col-lg-4 mb-4">
                <!-- <form class="form-inline my-2 my-lg-0" role="search" method="get" action="<?php echo ($baseurl . 'blog') ?>" style="width:100%;">
                    <div class="input-group pl-3 search" style="width: 100%;">

                        <input type="text" class="form-control" type="search" placeholder="Search" aria-label="Search" name="s" placeholder="Search This blog" style="height: 45px;">
                        <div class="input-group-append">
                            <button class="btn btn-md" title="Search this blog" type="submit" style="height: 45px;">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="p-3">
                    <h4 class="poppins-medium">Recent posts</h4>
                    <ul class="articles2 p-0 m-0 pt-3 ">
                        <?php
                        foreach ($response2[0] as $key1 => $row) {
                        ?>
                            <li>
                                <div class="row ">
                                    <div class="col-1 pr-0 mr-0">
                                        <i class="fa fa-arrow-right pr-0 mr-0" aria-hidden="true" style="font-size: 15px;"></i>
                                    </div>
                                    <div class="col-10">
                                        <a class="articles3" href="<?= $row['url_lines'] . '/rrozunbrfe' ?>">
                                            <?php echo $row['title'] ?>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div>
                    <?php
                    if (count($responseAd) > 0) {
                        foreach ($responseAd as $key1 => $row) {
                    ?>
                            <div class="d-flex justify-content-center pt-4">
                                <a href="<?php echo ($row['image_link']) ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo ($row['image']) ?>" alt="govtjobkaro-product" style="width:320px;"></a>
                                <br>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div> -->
               
                
                <!-- right sidebar start-->
                <?php echo ($rightSidebar[0]['sidebar']); ?>
                <!-- right sidebar end-->
                

            </div>
        </div>
    </div>
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


function logout() {
    $.ajax({
        type: "POST",
        url: "php/logout.php",
        dataType: "json",
        data: {
            type: "logout",
        },
        success: function(obj) {
            if (obj.status == "success") {
                function delete_cookie(name) {
                    document.cookie =
                        name +
                        "=; Domain=govtjobkaro.com; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                }
                delete_cookie("token");
                $(".logbtn").html("Login to view courses");
                $(".logbtn").attr("onclick", 'window.location="login-register"');
                window.location = "course-logout";
                // location.reload();
            } else {
                alert("try again");
            }
        },
    });
}

// logout 
$('.logout').on('click', () => {
    $.ajax({
        type: 'POST',
        url: 'php/logout.php',
        dataType: "json",
        data: {
            type: "logout"
        },
        success: function(obj) {
            if (obj.status == 'success') {
                function delete_cookie(name) {
                    document.cookie = name +
                        '=; Domain=govtjobkaro.com; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                }
                delete_cookie('token');
                window.location = "login-register";
            } else {
                alert("try again");
            }
        }
    });
});
</script>

</html>