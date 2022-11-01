<?php 
    $url = $_SERVER["REQUEST_URI"];
?>
<div style="padding-right: 10px;width: 45%">
    <ul class="naviagation">
        <li class="<?= ($url == "/" ? "active": "") ?>">
            <a href="/" style="text-decoration: none">
                <i class="fa-solid fa-house"></i> Home
            </a>
        </li>
        <li class="<?= ($url == "/dashboard.php" ? "active": "") ?>">
            <a href="/dashboard.php" style="text-decoration: none">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
        </li>
        <li class="<?= ($url == "/timeline.php" ? "active": "") ?>">
            <a href="/timeline.php" style="text-decoration: none">
                <i class="fa-regular fa-clock"></i> Timeline
            </a>
        </li>
        <li class="<?= ($url == "/gatra.php" ? "active": "") ?>">
            <a href="/gatra.php" style="text-decoration: none">
                <i class="fa-solid fa-gauge-high"></i> IKPM - Gatra
            </a>
        </li>
        <li class="<?= ($url == "/provinsi.php" ? "active": "") ?>">
            <a href="/provinsi.php" style="text-decoration: none">
                <i class="fa-solid fa-gauge-high"></i> IKPM - Provinsi
            </a>
        </li>
        <li class="<?= ($url == "/media.php" ? "active": "") ?>">
            <a href="/media.php" style="text-decoration: none">
                <i class="fa-solid fa-gauge-high"></i> IKPM - Media
            </a>
        </li>
        <li class="<?= ($url == "/sentiment.php" ? "active": "") ?>">
            <a href="/sentiment.php" style="text-decoration: none">
                <i class="fa-solid fa-heart"></i> Sentiment
            </a>
        </li>
        <li class="<?= ($url == "/map.php" ? "active": "") ?>">
            <a href="/map.php" style="text-decoration: none">
                <i class="fa-solid fa-map-location-dot"></i> Maps
            </a>
        </li>
        <li class="<?= ($url == "/top-issue.php" ? "active": "") ?>">
            <a href="/top-issue.php" style="text-decoration: none">
                <i class="fa-solid fa-fire"></i> Top Issues
            </a>
        </li>
        <li class="<?= ($url == "/trending.php" ? "active": "") ?>">
            <a href="/trending.php" style="text-decoration: none">
                <i class="fa-solid fa-star"></i> Trending Issue
            </a>
        </li>
        <li class="<?= ($url == "/report.php" ? "active": "") ?>">
            <a href="/report.php" style="text-decoration: none">
                <i class="fa-solid fa-chart-column"></i> Report
            </a>
        </li>
    </ul>
</div>