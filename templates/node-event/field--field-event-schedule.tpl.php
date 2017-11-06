<ul class="list--reset margin--none">
  <?php foreach($rows as $row): ?>
    <li class="padding-bottom--xxs">
      <span class="bold float--left padding-right--xs"><?php print $row['field_schedule_time']; ?></span>
      <span class=""><?php print $row['field_schedule_description']; ?></span>
    </li>
  <?php endforeach;?>
</ul>
