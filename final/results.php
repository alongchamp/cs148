<?php

$results = $thisDatabaseReader->select($query, $data, 1, $count - 1, 0, 0, FALSE, FALSE);
//Generates the coupon search results!
foreach ($results as $record) {
    $companyName = $record['fldCompanyName'];
    $desc = $record['fldCouponDescription'];
    $desc = substr($desc, 0, 100) . '...';
    $valid = $record['fldValid'];
    $couponName = $record['fldCouponName'];
    $category = $record['fldCategory'];
    echo '<div class="coupon"><a href="individualCoup.php?id=' . $record['pmkCouponID'] . '">';
    echo '<h1 class="couponCompany">' . $companyName . '</h1>';
    echo '<p class="couponName"><strong>' . $couponName . '</strong></p>';
    echo '<p>' . $desc . '</p>';
    echo '<p> Valid Until: ' . $valid . '</p>';
    echo '</a></div>';
}