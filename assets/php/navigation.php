<!-------- navbar top ---------->
<header>
    <div class="container-nav">
        <div class="left">
            <i class='fas fa-bars toggleHeader'></i>
        </div>
        <div class="right">
            <a class="usernamee"><img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" alt="" class="profile" id="popup-btn" onclick="LogOutFunction()"></a>
            <a class="username1" id="popup-btn" onclick="LogOutFunction()"><?php echo $_SESSION['username'] ?></a>
        </div>
    </div>
</header>

<!-------- sidebar ---------->
<div class="sidebar-nav close">
    <nav>
        <div class="sidebar">
            <div class="sidebar-logo">
                <a href="./dashboard.php"><img src="./images/systems-plus-computer-college-logo.png" alt="" class="logo"></a>
            </div>
            <div class="sidebar-name">
                <span class="sidebar-name1">Systems Plus</span>
                <span class="sidebar-name1">Computer College</span>
            </div>
        </div>
        <i class='fas fa-bars toggle'></i>
    </nav>
    <div class="menu-bar">
        <div class="menu">
            <nav>
                <p><a href="./assets/php/directProfile.php" class="username"><img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" alt="" class="profile-side"><span><?php echo $_SESSION['username'] ?></span></a></p>
                <ul>
                    <?php sidebarIdentify() ?>
                </ul>
            </nav>
        </div>
    </div>
</div>