<?php

/**
 * Block template file: blocks/hero.php
 *
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Load values and assign defaults.
$style = get_field('style');
$align = get_field('align');
$title = get_field('title') ?: 'Your title goes here...';
$content = get_field('content') ?: 'Your content goes here...';
$image = get_field('image') ?: '256';

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block hero ' . $style . ' ' . $align;
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

?>

<?php if (isset($block['data']['preview_image_help'])) : ?>
  <img src="<?php echo $block['data']['preview_image_help']; ?>">
<?php else : ?>

  <section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="wrapper">
      <?php include(locate_template('blocks/components/stamps.php')); ?>
      <div class="row">
        <div class="col">
          <div class="content" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
            <h1 class="label"></h1>
            <h2 class="title"><?php echo $title; ?></h2>
            <?php echo $content; ?>
          </div>
        </div>
        <div class="col">
          <div class="image" data-aos="fade-up" data-aos-duration="900" data-aos-delay="100">
            <?php echo wp_get_attachment_image($image, 'full'); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>