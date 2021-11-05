<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">

<div class="booksContainer">
    <div class="filterTop">
        <h2>Quickly find your book!</h2>

        <div class="row">
            <div class="col-md-6">
                <?php
                if( $bookCategories = get_terms( array(
                    'taxonomy' => 'book_categories', 
                    'orderby' => 'name',
                ) ) ) : 
                    echo '<div class="filterWrap categories">';
                    echo '<div class="checkmarkWrap"><input type="checkbox" id="allCategories" class="allFilters" name="allCategories" value="" checked>';
                    echo '<label for="allCategories">All categories</label></div>';
                    foreach ( $bookCategories as $bookCategory ) :
                        echo '<div class="checkmarkWrap"><input class="filterCategories filters" type="checkbox" id="book_category_' . $bookCategory->term_id . '" name="book_category_' . $bookCategory->term_id . '" value="book_category_' . $bookCategory->term_id  . '">';
                        echo '<label for="book_category_' . $bookCategory->term_id . '">' . $bookCategory->name . '</label></div>';
                    endforeach;
                    echo '</div>';

                endif;


                if( $bookColors = get_terms( array(
                    'taxonomy' => 'colors', 
                    'orderby' => 'name',
                ) ) ) : 
                    echo '<div class="filterWrap colors">';
                    echo '<div class="checkmarkWrap"><input type="checkbox" id="allBooks" class="allFilters" name="allBooks" value="" checked>';
                    echo '<label for="allBooks">All Colors</label></div>';
                    foreach ( $bookColors as $bookColor ) :
                        echo '<div class="checkmarkWrap"><input class="filterColors filters" type="checkbox" id="color_' . $bookColor->term_id . '" name="color_' . $bookColor->term_id . '" value="color_' . $bookColor->term_id . '">';
                        echo '<label for="color_' . $bookColor->term_id . '">' . $bookColor->name . '</label></div>';
                    endforeach;
                    echo '</div>';

                endif;
                ?>




            </div>


            <div class="col-md-6">
                <div class="flexAlignSort">
                    <span>Sort results on</span>
                    <select name="sortBooks">
                        <option value="lastAdded">Last added</option>
                        <option value="AuthorFamilyName">Author family name</option>
                        <option value="BookTitle">Book Title</option>
                    </select>
                </div>
            </div>


        </div>


    </div>

    <div class="gridBooks">
        <div class="row" id="gridPaginated">

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(  
                'post_type' => 'books',
                'post_status' => 'publish',
                'posts_per_page' => 9, 
                'orderby'=> 'date',
                'order' => 'DESC', 
                'paged' => $paged,
            );

            $loop = new WP_Query( $args ); 
                
            while ( $loop->have_posts() ) : $loop->the_post(); 
                get_template_part( 'template-parts/book', 'loop' );
            endwhile;
            wp_reset_postdata(); 

            // Pagination 
            $pagination = 1;
            $paginationTotal = $loop->max_num_pages;
            $currentPage = 1;

            echo '<div id="paginacao">';
            while($pagination <= $paginationTotal ){
                if($pagination >= $currentPage && $pagination <= ($currentPage +2)  ){
                    if($pagination == $currentPage) {
                        echo '<div><input checked class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
                        echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
                    } else{
                        echo '<div><input class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
                        echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
                    }
                } elseif ( $pagination == $paginationTotal) {
                    echo '<span>...</span>';
                    echo '<div><input class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
                    echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
                } 
                $pagination++;
            }
            echo '</div>';

            ?>
        </div>
    </div>
</div>
<input type="hidden" name="action" value="myfilter">
</form>