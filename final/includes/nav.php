<!-- ######################     Main Navigation   ########################## -->
<div class="sideMenu">
    <img class ="logo" src="img/logo_v7.png" alt="BVT Online Couponing">
    <nav>
        <ul>
            <?php
            if ($PATH_PARTS['filename'] == "index") {
                print '<li class="activePage">Home</li>';
            } else {
                print '<li><a href="index.php">Home</a></li>';
            }
            if ($PATH_PARTS['filename'] == "browse") {
                print '<li class="activePage">Browse</li>';
            } else {
                print '<li><a href="browse.php">Browse</a></li>';
            }
            if ($PATH_PARTS['filename'] == "favorite") {
                print '<li class="activePage">Favorites</li>';
            } else {
                print '<li><a href="favorite.php">Favorites</a></li>';
            }
            if ($PATH_PARTS['filename'] == "account") {
                print '<li class="activePage">Account</li>';
            } else {
                print '<li><a href="account.php">Account</a></li>';
            }
            if ($PATH_PARTS['filename'] == "aboutus") {
                print '<li class="activePage">About us</li>';
            } else {
                print '<li><a href="aboutus.php">About us</a></li>';
            }
            ?>
            <!-- Dropdown menu using javascript, only viewable on mobile screens -->
            <li class ="dropdown">
                <a href="javascript:void(0)" class="dropbtn" onclick="myFunction()">Menu</a>
                <div class="dropdown-content" id="myDropdown">
                    <?php
                    if ($PATH_PARTS['filename'] == "index") {
                        print '<a href="javascript:void(0)" class="activePage">Home</a>';
                    } else {
                        print '<a href="index.php">Home</a>';
                    }
                    if ($PATH_PARTS['filename'] == "browse") {
                        print '<a href="javascript:void(0)" class="activePage">Browse</a>';
                    } else {
                        print '<a href="browse.php">Browse</a>';
                    }
                    if ($PATH_PARTS['filename'] == "favorite") {
                        print '<a href="javascript:void(0)" class="activePage">Favorites</a>';
                    } else {
                        print '<a href="favorite.php">Favorites</a>';
                    }
                    if ($PATH_PARTS['filename'] == "account") {
                        print '<a href="javascript:void(0)" class="activePage">Account</a>';
                    } else {
                        print '<a href="account.php">Account</a>';
                    }
                    if ($PATH_PARTS['filename'] == "aboutus") {
                        print '<a href="javascript:void(0)" class="activePage">About us</a>';
                    } else {
                        print '<a href="aboutus.php">About us</a>';
                    }
                    print '<a href="login.php">Logout</a>';
                    ?>
                </div>
            </li>
        </ul>
        <ul class="btnLogout">
            <li><a href="login.php">Logout</a></li>
        </ul>
    </nav>
</div>
<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function (e) {
        if (!e.target.matches('.dropbtn')) {

            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var d = 0; d < dropdowns.length; d++) {
                var openDropdown = dropdowns[d];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
<!-- #################### Ends Main Navigation    ########################## -->

