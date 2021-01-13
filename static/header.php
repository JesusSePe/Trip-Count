<header>
  <div class="header">
    <div class="tripcount">
      <a class="logo">TRIP-COUNT</a>
    </div>
    <div>
    <?php if(isset($_SESSION)){  
      echo '<a class="logo"><span class="user">' . $_SESSION["uname"] . '</span></a>';    
    }
    ?>
    </div>
    <div class="header-right">
      <a class="button" href="home.php" accesskey="h"><span><u>H</u>ome</span></a>
    </div>
  </div>
</header>