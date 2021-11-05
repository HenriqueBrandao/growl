<?php 
    echo '<div class="itemGrid"><a href="'.get_the_permalink().'">';
    echo '<div class="featuredImage">';
    the_post_thumbnail();
    echo '</div>';
    the_title('<h3>', '</h3>');


    $bookSingleCats  = wp_get_object_terms( $post->ID, 'book_categories', $args );
    foreach($bookSingleCats as $bookSingleCat) {
      ?>
            <a class="small catSmall"  >
            <?php echo $bookSingleCat->name; ?>
            </a> 
      <?php
    }
    echo '<div class="authorWrap">';
    $firstName = get_field('author_first_name'); 
    $familyName = get_field('author_family_name'); 
    if($firstName){
        echo '<span class="authorFirstName">'.$firstName.'</span>';
    }
    if($familyName){
        echo '<span class="authorLastName"> '.$familyName.'</span>';
    }
    echo '</div>';




    echo '</a></div>';
?>