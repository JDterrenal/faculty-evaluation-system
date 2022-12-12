<div class="popup-logout pop" id="popup">
    <div class="popup-logout-first">
        <img src="./images/uploads/<?php echo $_SESSION['photo'] ?>" alt="" class="popup-profile">
        <p class="popup-name"><?php echo $_SESSION['username'] ?></p>
        <p class="popup-student-number"><?php echo $_SESSION['login_id'] ?></p>
    </div>
    <div class="popup-logout-last">
        <a href="./assets/php/directProfile.php" class="popup-profile-button">Profile</a>
        <a href="?logout=true" class="popup-profile-logout">Sign Out</a>
    </div>
</div>