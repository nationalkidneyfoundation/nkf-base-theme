<?php
/**
 * Returns the HTML for a sticky header on scroll.
 *
 * Available Variables
 * - $sub_nav_title
 * - $sub_nav_actions: array
 */

?>
<div class="md--show">
  <div class="nav-sub hide animate animate--fade-in position--fixed md--top right left bottom height--sm z-index--300 <?php print $th['header'];?>">
    <div class="container">
      <div class="grid height--sm">
        <div class="height--sm grid-cell hide md--display--inline-block padding-right--xs">
          <img class="height--sm padding--xxs" src="/profiles/kidneys_distro/themes/custom/nkf_base/img/logo__bean--white.png">
        </div>
        <div class="height--sm grid-cell hide md--display--inline-block caps font-size--sm">
          <span class="padding-y--sm padding-x--xxs display--inline-block caps font-size--sm">
            <?php print $sub_nav_title; ?>
          </span>
          <!--/

          <a href="#" class="padding-y--sm padding-x--xxs display--inline-block bold caps font-size--sm color--white">

          </a>/-->
          <?php if($sub_nav_actions) :?>
          <?php foreach ($sub_nav_actions as $key => $action): ?>
            <a href="<?php print $action['href']; ?>" class="padding-left--xxs display--inline-block bold  font-size--sm">
              <i class="<?php print $action['icon'];?>  bg--white--o30 color--white width--xs height--xs line-height--xs display--inline-block rounded text-align--center"></i>
            </a>
          <?php endforeach;?>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</div>
