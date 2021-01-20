<header>
<?php 
if (($_SERVER['REQUEST_URI'] === '/Trip-Count/login.php') || ($_SERVER['REQUEST_URI'] === '/Trip-Count/register.php')) {
    echo '<div class="header">
    <div class="tripcount">
      <a class="logo">TRIP-COUNT</a>
    </div>
    <div>';
    if(isset($_SESSION)){  
      echo '<span class="user">' . $_SESSION["name"] . '</span>';    
    }
    echo '
    </div>
  </div>';
} else {
  echo '<div class="header">
    <div class="tripcount">
      <a class="logo">TRIP-COUNT</a>
    </div>
    <div>';
    if(isset($_SESSION)){  
      echo '<a class="logo"><span class="user">' . $_SESSION["name"] . '</span></a>';    
    }
    echo '
    </div>
    <div class="header-right">
      <a class="button" href="home.php" accesskey="h"><span><u>H</u>ome</span></a>
    </div>
  </div>';
}
?>
</header>