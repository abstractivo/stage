<nav>
  <ul>
    <?php foreach( $items AS $name => $url ) : ?>
      <li> <a href="<?php echo $url?>"> <?php echo $name ?> </a></li>
    <?php endforeach; ?>
  </ul>
</nav>
