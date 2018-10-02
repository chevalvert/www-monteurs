  <footer class="footer" role="main">
    <nav class="footer__social">
      <ul class="footer__social-items">
      <?php foreach ($site->social()->toStructure() as $item) : ?>
        <li class="footer__social-item">
          <a class="footer__social-item-link" href="<?= $item->url() ?>" <?= r($item->blank()->bool(), 'target="_blank"', '')?>>
            <?= $item->text()->html() ?>
          </a>
        </li>
      <?php endforeach ?>
      </ul>
    </nav>
    <nav class="footer__misc">
      <ul class="footer__social-items">
      <?php foreach ($site->misc()->toStructure() as $item) : ?>
        <li class="footer__social-item">
          <a class="footer__social-item-link" href="<?= $item->url() ?>" <?= r($item->blank()->bool(), 'target="_blank"', '')?>>
            <?= $item->text()->html() ?>
          </a>
        </li>
      <?php endforeach ?>
      </ul>
    </nav>
  </footer>

  <?php echo js('assets/builds/bundle.js') ?>
  </body>
</html>
