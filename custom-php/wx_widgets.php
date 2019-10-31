<?php


function tm_dione_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'tm-dione'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Area of right side', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Top Details', 'tm-dione'),
        'id' => 'top-details-sidemenu',
        'description' => esc_html__('Area of Menu right side, not support sub-menu', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s top-details">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Top Social Details', 'tm-dione'),
        'id' => 'top-social-sidemenu',
        'description' => esc_html__('Area of Menu right side, not support sub-menu', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s top-details">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

//	register_sidebar(array(
//        'name' => esc_html__('Footer 1 Widget Area', 'tm-dione'),
//        'id' => 'footer',
//        'description' => esc_html__('Area of Footer-column-1', 'tm-dione'),
//        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//        'after_widget' => '</aside>',
//        'before_title' => '<h5 class="widget-title"><span>',
//        'after_title' => '</span></h5>',
//    ));
//
//    register_sidebar(array(
//        'name' => esc_html__('Footer 2 Widget Area', 'tm-dione'),
//        'id' => 'footer2',
//        'description' => esc_html__('Area of Footer-column-2', 'tm-dione'),
//        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//        'after_widget' => '</aside>',
//        'before_title' => '<h5 class="widget-title"><span>',
//        'after_title' => '</span></h5>',
//    ));
//
//    register_sidebar(array(
//        'name' => esc_html__('Footer 3 Widget Area', 'tm-dione'),
//        'id' => 'footer3',
//        'description' => esc_html__('Area of Footer-column-3', 'tm-dione'),
//        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//        'after_widget' => '</aside>',
//        'before_title' => '<h5 class="widget-title"><span>',
//        'after_title' => '</span></h5>',
//    ));
//
//    register_sidebar(array(
//        'name' => esc_html__('Footer 4 Widget Area', 'tm-dione'),
//        'id' => 'footer4',
//        'description' => esc_html__('Area of Footer-column-4', 'tm-dione'),
//        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//        'after_widget' => '</aside>',
//        'before_title' => '<h5 class="widget-title"><span>',
//        'after_title' => '</span></h5>',
//    ));
    
    
    register_sidebar(array(
        'name' => esc_html__('Sidebar Contact Us Only', 'tm-dione'),
        'id' => 'contactus-sidebar',
        'description' => esc_html__('Area of Sidebar Contact Us Only', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title"><span>',
        'after_title' => '</span></h5>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Products Sidebar', 'tm-dione'),
        'id' => 'products-sidebar',
        'description' => esc_html__('Area of Sidebar Products Only', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title"><span>',
        'after_title' => '</span></h5>',
    ));
    

//    
//    register_sidebar(array(
//        'name' => esc_html__('Market Place Sidebar', 'tm-dione'),
//        'id' => 'marketplace-sidebar',
//        'description' => esc_html__('Area of Sidebar Market Place Only', 'tm-dione'),
//        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//        'after_widget' => '</aside>',
//        'before_title' => '<h5 class="widget-title"><span>',
//        'after_title' => '</span></h5>',
//    ));
    
    
    register_sidebar(array(
        'name' => esc_html__('Products Tags', 'tm-dione'),
        'id' => 'products-tag-sidebar',
        'description' => esc_html__('Area of Sidebar Product Place Only', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title"><span>',
        'after_title' => '</span></h5>',
    ));
    
    
    register_sidebar(array(
        'name' => esc_html__('Footer menu', 'tm-dione'),
        'id' => 'footer-menu-sidebar',
        'description' => esc_html__('Area of Sidebar Product Place Only', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title"><span>',
        'after_title' => '</span></h5>',
    ));
    
    
    register_sidebar(array(
        'name' => esc_html__('Media Sidebar', 'tm-dione'),
        'id' => 'our_media',
        'description' => esc_html__('Area of Sidebar Product Place Only', 'tm-dione'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title"><span>',
        'after_title' => '</span></h5>',
    ));

    
    
}

add_action('widgets_init', 'tm_dione_widgets_init');



?>