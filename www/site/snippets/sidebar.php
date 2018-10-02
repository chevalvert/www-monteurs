<aside class="sidebar">
  <div data-stickable class='sidebar__content'>
    <nav class="sidebar__nav">
      <?php if (isset($actions)) : ?>
      <div class="sidebar__nav-actions">
        <ul class="sidebar__nav-actions-items">
        <?php foreach ($actions as $action) : ?>
          <li class="sidebar__nav-actions-item">
            <?= $action ?>
          </li>
        <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>
      <?php if (isset($toc)) echo $toc ?>
      <?php if (isset($filters)) snippet('sidebar-filter', compact('filters'));
      ?>
    </nav>

    <footer class="sidebar__footer">
      <?php if (isset($years)) snippet('sidebar-pagination', compact('years', 'current_year')) ?>

      <?php if (isset($attachments)) : ?>
      <div class="sidebar__footer-attachments">
        <ul class="sidebar__footer-attachments-items">
        <?php foreach ($attachments as $attachment) : ?>
        <?php if ($link = attachmentToLink($page, $attachment)) : ?>
          <li class="sidebar__footer-attachments-item">
            <a class="sidebar__footer-attachments-item-link" href="<?= $link['url'] ?>" target="_blank">
              <?= $link['title'] ?>
            </a>
          </li>
        <?php endif ?>
        <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>
    </footer>
  </div>
</aside>
