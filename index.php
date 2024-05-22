<?php 
include('values/site.php');
 
include('components/header.php'); 
 
function get_image_urls($folder) {
  $images = array();
  if (is_dir($folder)) {
    $scandir = scandir($folder);
    foreach ($scandir as $item) {
      if (in_array($item, array('.', '..'))) continue;
      $path = $item; // Use only the filename within the folder
      if (is_file($path) && getimagesize($path) !== false) {
        $images[] = array(
          'url' => $path,
          'alt' => pathinfo($path, PATHINFO_FILENAME)
        );
      }
    }
  }
  return $images;
}

$images = get_image_urls('/src/assets/images'); // Assuming 'src/assets/images' is relative

if ( !empty($images) ) :
  foreach ($images as $image) : ?>
    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
  <?php endforeach;
endif; 

include('components/video.php'); 

include('components/content.php'); 

include('components/footer.php');

?>