<?php

/**
 * Block template file: block.php
 *
 * Example Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'example-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block example' . setting_classes();

if (!empty($block['className'])) {
  $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $classes .= ' align' . $block['align'];
}

?>

<?php if (block_is_empty()) : ?>
  <?php block_preview($block); ?>
<?php else : ?>

  <?php
  /**
   * This is where you will create markup and use ACF functions
   * to output data. Make sure that you have the ACF Theme Code Pro plugin 
   * installed so that you can easily copy and paste the code that it generates
   * into this file. This will reduce errors and speed up development.
   * 
   * When you're ready to begin styling, go to src/scss/blocks/
   * 
   * Once you're setup, delete this comment section.
   */
  ?>

  <section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <div class="row">
      <div class="col">

        <?php
        /**
         * Below are functions to help you with some of the 
         * most common types of data, markup, and classes
         * that we use in blocks.
         * 
         * You can hover over each function in VS Code to get 
         * more details about each function or visit the 
         * inc/helpers.php file to see all of our helper functions 
         * and how they work.
         * 
         * Follow the HTML guidelines below as you begin creating 
         * markup for the block.
         * https://prolificdigital.notion.site/HTML-Guidelines-7a3a6c05886b4bde9a11fd0fe93e6601
         * 
         * Once you're setup, delete this comment section.
         */
        ?>

        <?php block_title(); ?>
        <?php block_headline(); ?>
        <?php block_content(); ?>
        <?php block_background(); ?>
        <?php block_image(); ?>
        <?php block_link(); ?>
      </div>
    </div>
  </section>

<?php endif; ?>