<?php 
    $url = $_SERVER["REQUEST_URI"];
?>
<div style="padding-right: 10px;width: 20%">
    <ul class="naviagation">
        <a class="<?= ($url == "/" ? "active": "") ?>" href="/" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-house"></i> Home
            </li>
        </a>
        <a class="<?= ($url == "/dashboard.php" ? "active": "") ?>" href="/dashboard.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </li>
        </a>
        <a class="<?= ($url == "/timeline.php" ? "active": "") ?>" href="/timeline.php" style="text-decoration: none">
            <li>
                <i class="fa-regular fa-clock"></i> Timeline
            </li>
        </a>
        <a class="<?= ($url == "/gatra.php" ? "active": "") ?>" href="/gatra.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-gauge-high"></i> IKPM - Gatra
            </li>
        </a>
        <a class="<?= ($url == "/provinsi.php" ? "active": "") ?>" href="/provinsi.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-gauge-high"></i> IKPM - Provinsi
            </li>
        </a>
        <a class="<?= ($url == "/media.php" ? "active": "") ?>" href="/media.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-gauge-high"></i> IKPM - Media
            </li>
        </a>
        <a class="<?= ($url == "/sentiment.php" ? "active": "") ?>" href="/sentiment.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-heart"></i> Sentiment
            </li>
        </a>
        <a class="<?= ($url == "/map.php" ? "active": "") ?>" href="/map.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-map-location-dot"></i> Maps
            </li>
        </a>
        <a class="<?= ($url == "/top-issue.php" ? "active": "") ?>" href="/top-issue.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-fire"></i> Top Issues
            </li>
        </a>
        <a class="<?= ($url == "/trending.php" ? "active": "") ?>" href="/trending.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-star"></i> Trending Issue
            </li>
        </a>
        <a class="<?= ($url == "/report.php" ? "active": "") ?>" href="/report.php" style="text-decoration: none">
            <li>
                <i class="fa-solid fa-chart-column"></i> Report
            </li>
        </a>
        <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){ ?>
            <a onClick="showDropDown()" class="<?= (str_contains($url, "/users_management/")  ? "active": "") ?>" style="text-decoration: none">
                <li>
                    <i class="fa-solid fa-chart-column"></i> Administration site
                </li>
            </a>
            <ul id="dropdown-list" class="hide">
                <a href="/users_management/">
                    <li>Users management</li>
                </a>
                <a href="/users_management/crawler.php">
                    <li>Crawler management</li>
                </a>
                <a href="/users_management/dataset/?page=1">
                    <li>Dataset management</li>
                </a>
            </ul>
        <?php } ?>
        <a href="/logout.php" style="text-decoration: none">
            <li>
                <i class="fa fa-sign-out"></i> Logout
            </li>
        </a>
    </ul>
</div>

<script>
    let url = '<?= $url ?>';
    if(url.includes("/users_management/")){
        showDropDown();
    }
    function showDropDown(){
        let dropdownId = document.getElementById("dropdown-list");
        let state = document.getElementById("dropdown-list").className;
        if(state == "hide"){
            dropdownId.classList.remove("hide")
        }else{
            dropdownId.classList.add("hide")
        }
    }
</script>