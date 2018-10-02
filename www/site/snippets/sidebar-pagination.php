<nav class="pagination">
  <ul class="pagination-items">
  <?php foreach ($years as $year) : ?>
    <li class="pagination-item">
      <a
        class="pagination-item-link <?= r($current_year == $year, 'is-active', '') ?>"
        href="<?= buildParamURL([c::get('params.names')['pagination'] => $year]) ?>">
        <?= $year ?>
      </a>
    </li>
  <?php endforeach ?>
  </ul>
</nav>
