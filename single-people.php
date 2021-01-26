<?php
/**
 * The template for displaying all single People CPT
 *
 * @package FoundationPress
 * @since   FoundationPress 1.0.0
 */
get_header(); ?>
  <?php 
    $program_slug = get_the_program_slug($post);
    $program_name = get_the_program_name($post); ?>

<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
            <?php do_action('ksasacademic_before_content'); ?>
            <?php
            if (have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                ?>
                <article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="article-header">
                    <h1 class="entry-title single-title" itemprop="headline" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>
                </header>
                <div class="grid-x grid-margin-x bio">
                    <?php if (has_post_thumbnail() ) : ?>
                        <div class="small-12 medium-4 cell">
                            <?php
                            the_post_thumbnail(
                                'full', array(
                                'class' => 'headshot',
                                'alt' => esc_html ( get_the_title() ),
                                )
                            );
                            ?>
                        </div>
                    <?php endif;?>
                        <div class="small-12 medium-8 cell">
                        <?php if (get_post_meta($post->ID, 'ecpt_position', true) ) : ?>
                            <h2><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h2>
                        <?php endif; ?>
                        <p class="listing">
                            <span class="fa fa-flag"></span> Program: <?php echo $program_name; ?><br>
                            <?php if (get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
                            <span class="fa fa-map-marker-alt" aria-hidden="true"></span> <?php echo get_post_meta($post->ID, 'ecpt_office', true); ?><br>
                            <?php endif; ?>
                            
                            <?php if (get_post_meta($post->ID, 'ecpt_hours', true) ) : ?>
                            <span class="fa fa-calendar" aria-hidden="true"></span> <?php echo get_post_meta($post->ID, 'ecpt_hours', true); ?><br>
                            <?php endif; ?>
                            
                            <?php if (get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
                            <span class="fa fa-phone-square" aria-hidden="true"></span> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?><br>
                            <?php endif; ?>
                            
                            <?php if (get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
                            <span class="fa fa-fax" aria-hidden="true"></span>  <?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?><br>
                            <?php endif; ?>
                            
                            <?php
                            if (get_post_meta($post->ID, 'ecpt_email', true) ) :
                                $email = get_post_meta($post->ID, 'ecpt_email', true);
                            ?>
                            <span class="fa fa-envelope" aria-hidden="true"></span> <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;<?php echo email_munge($email); ?>">
                            
                        <?php echo email_munge($email); ?> </a><br>
                            <?php endif; ?>
                            <?php if (get_post_meta($post->ID, 'ecpt_cv', true) ) : ?>
                        <span class="fas fa-file-pdf" aria-hidden="true"></span> <a href="<?php echo get_post_meta($post->ID, 'ecpt_cv', true); ?>">Curriculum Vitae</a><br>
                            <?php endif; ?>
                        
                            <?php if (get_post_meta($post->ID, 'ecpt_website', true) ) : ?>
                        <span class="fa fa-globe" aria-hidden="true"></span> <a href="<?php echo get_post_meta($post->ID, 'ecpt_website', true); ?>" target="_blank">Personal Website</a><br>
                            <?php endif; ?>
                            <?php if (get_post_meta($post->ID, 'ecpt_lab_website', true) ) : ?>
                        <span class="fa fa-globe" aria-hidden="true"></span> <a href="<?php echo get_post_meta($post->ID, 'ecpt_lab_website', true); ?>" target="_blank">Group/Lab Website</a><br>
                            <?php endif; ?>
                            <?php if (get_post_meta($post->ID, 'ecpt_google_id', true) ) : ?>
                        <span class="fab fa-google"></span> <a href="http://scholar.google.com/citations?user=<?php echo get_post_meta($post->ID, 'ecpt_google_id', true); ?>" target="_blank">Google Scholar Profile</a><br>
                            <?php endif; ?>
                            <?php if (get_post_meta($post->ID, 'ecpt_microsoft_id', true) ) : ?>
                        <span class="fab fa-windows"></span> <a href="https://academic.microsoft.com/#/detail/<?php echo get_post_meta($post->ID, 'ecpt_microsoft_id', true); ?>" target="_blank"> Microsoft Academic Profile</a>
                            <?php endif; ?>
                            <?php if (get_post_meta($post->ID, 'ecpt_orcid_id', true) ) : ?>
                        <a href="http://orcid.org/<?php echo get_post_meta($post->ID, 'ecpt_orcid_id', true); ?>" target="_blank"><span class="fas fa-user"></span> ORCID Profile</a>
                            <?php endif; ?>
                            <?php if (get_post_meta($post->ID, 'ecpt_twitter', true) ) : ?>
                        <span class="fab fa-twitter"></span> <a href="https://twitter.com/<?php echo get_post_meta($post->ID, 'ecpt_twitter', true); ?>" target="_blank"> @<?php echo get_post_meta($post->ID, 'ecpt_twitter', true); ?></a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <?php if (has_term('', 'role') && ! has_term('job-market-candidate', 'role') ) : ?>
                    <ul class="tabs margin10" data-tabs id="profile-tabs">
                        <?php if (get_post_meta($post->ID, 'ecpt_bio', true) ) : ?>
                        <li class="tabs-title is-active"><a href="#bioTab">Biography</a></li>
                        <?php endif; ?>
                        <?php if (get_post_meta($post->ID, 'ecpt_research', true) ) : ?>
                        <li class="tabs-title"><a href="#researchTab">Research</a></li>
                        <?php endif; ?>
                        
                        <?php if (get_post_meta($post->ID, 'ecpt_teaching', true) ) : ?>
                        <li class="tabs-title"><a href="#teachingTab">Teaching</a></li>
                        <?php endif; ?>
                        
                        <?php if (get_post_meta($post->ID, 'ecpt_publications', true) ) : ?>
                        <li class="tabs-title"><a href="#publicationsTab">Publications</a></li>
                        <?php endif; ?>
                        <?php if (get_post_meta($post->ID, 'ecpt_books_cond', true) == 'on' ) : ?>
                        <li class="tabs-title"><a href="#booksTab">Books</a></li>
                        <?php endif; ?>
                        <?php if (get_post_meta($post->ID, 'ecpt_extra_tab_title', true) ) : ?>
                        <li class="tabs-title"><a href="#extraTab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab_title', true); ?></a></li>
                        <?php endif; ?>
                        <?php if (get_post_meta($post->ID, 'ecpt_extra_tab_title2', true) ) : ?>
                        <li class="tabs-title"><a href="#extra2Tab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab_title2', true); ?></a></li>
                        <?php endif; ?>
                    </ul>
                    
                    <div class="tabs-content people-content" data-tabs-content="profile-tabs">
                        <?php if (get_post_meta($post->ID, 'ecpt_bio', true) ) : ?>
                        <div class="tabs-panel is-active" id="bioTab" itemprop="articleBody">
                            <?php echo get_post_meta($post->ID, 'ecpt_bio', true); ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (get_post_meta($post->ID, 'ecpt_research', true) ) : ?>
                        <div class="tabs-panel" id="researchTab"><?php echo get_post_meta($post->ID, 'ecpt_research', true); ?></div>
                        <?php endif; ?>
                        
                        <?php if (get_post_meta($post->ID, 'ecpt_teaching', true) ) : ?>
                        <div class="tabs-panel" id="teachingTab"><?php echo get_post_meta($post->ID, 'ecpt_teaching', true); ?></div>
                        <?php endif; ?>
                        
                        <?php if (get_post_meta($post->ID, 'ecpt_publications', true) ) : ?>
                        <div class="tabs-panel" id="publicationsTab">
                            <?php
                            if (get_post_meta($post->ID, 'ecpt_publications', true) ) :
                                echo get_post_meta($post->ID, 'ecpt_publications', true);
                            endif;
                            ?>
                        </div>
                        <?php endif; ?>
                        <?php
                        if (get_post_meta($post->ID, 'ecpt_books_cond', true) == 'on' ) :
                            locate_template('template-parts/faculty-books.php', true, false);
                        endif;
                        ?>
                        <?php if (get_post_meta($post->ID, 'ecpt_extra_tab', true) ) : ?>
                        <div class="tabs-panel"  id="extraTab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab', true); ?></div>
                        <?php endif; ?>
                        
                        <?php if (get_post_meta($post->ID, 'ecpt_extra_tab2', true) ) : ?>
                        <div class="tabs-panel" id="extra2Tab"><?php echo get_post_meta($post->ID, 'ecpt_extra_tab2', true); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </article>
                <?php endwhile; ?>
            <?php endif; ?>
        </main>
        <?php do_action('ksasacademic_after_content'); ?>
        <div class="sidebar">
            <aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation-people">
                <div class="sidebar-menu">
                    <h1 class="sidebar-menu-title" id="sidebar-navigation-people">Explore all <a href="<?php echo get_home_url();?>/people/" aria-label="Sidebar Menu: People Heading">People</a></h1>
                    <?php
                        wp_nav_menu( array( 
                            'theme_location' => 'top-bar-r', 
                            'menu_class' => 'nav', 
                            'submenu' => 'People',
                            'depth' => 2,
                            'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Department People Menu">%3$s</ul>',
                        ));?>
                </div>
            </aside>
            <?php if (has_term('', 'role') && ! is_single('earle-havens') ) : ?>
            <aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
                <div class="sidebar-menu <?php echo $program_slug;?>">
                    <h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo site_url('/') . $program_slug; ?>" aria-label="<?php echo $program_name; ?> Program Menu Heading"><?php echo $program_name; ?> Program</a></h1>
                    <?php
                        wp_nav_menu( array( 
                            'menu_class' => 'nav', 
                            'menu' => $program_name,
                            'depth' => 1,
                            'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Program Menu">%3$s</ul>',
                        ));?>
                </div>
            </aside>
            <?php endif;?>   
        </div>
    </div>
</div>
<?php
get_footer();
