<body>
<header>
    <button on="tap:sidebar.toggle" class="ampstart-btn caps m2 header-icon-1 header-sub-menu"><i class="fa fa-navicon"></i></button>
    <a href="" class="header-logo"></a>

    <a href="#" class="header-icon-2 header-icon-3">Register | </i></a>
    <a href="#" class="header-icon-2">Login</i></a>
</header>

<div class="sub-header">
    <form target="_blank" action="/test">
        <input type="text" name="search" placeholder="Search..">
    </form>
</div>

<amp-sidebar id="sidebar" layout="nodisplay" side="left">
    <div class="sidebar-header"><a class="sidebar-logo" href="#"></a></div>

    <ul class="menu">

        <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
        <?php
        foreach($sub_cats as $cat){
            $m_link = base_url('c/'.$cat_info->slug.':'.$cat->slug);
            ?>
            <li>
                <a href="<?php echo $m_link; ?>"><?php echo $cat->category_name; ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="sidebar-deco"></div>
    <ul class="menu">
        <li><a href="https://twitter.com/iEnabled"><i class="fa fa-twitter"></i>Twitter</a></li>
        <li><a href="https://www.facebook.com/enabled.labs/"><i class="fa fa-facebook"></i>Facebook</a></li>
        <li><a href="https://plus.google.com/u/2/105775801838187143320"><i class="fa fa-google-plus"></i>Google +</a></li>
    </ul>
    <div class="sidebar-deco"></div>
    <em class="sidebar-copyright">Copyright Enabled. All Rights Reserved</em>
</amp-sidebar>

<div class="page-content">