<ul class="nav" id="side-menu">
    <li>
        <a href="<?php echo base_url(); ?>zadmin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
    </li>
    <li>
        <a href="#">
        	<i class="fa fa-bar-chart-o fa-fw"></i> 
        	Users<span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo base_url(); ?>user/user_add">Add New User</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>user/user_list">User List</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">
        	<i class="fa fa-wrench fa-fw"></i> 
        	Posts<span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo base_url(); ?>admin/category_add">Add New Category</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/category_list">Category List</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/tags">Tags</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/post_add">Add New Post</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/post_list">Post List</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/post_comment_list">Post Comment List</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">
        	<i class="fa fa-wrench fa-fw"></i> 
        	Pages<span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo base_url(); ?>admin/page_add">Add New Page</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/page_list">Page List</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">
        	<i class="fa fa-wrench fa-fw"></i> 
        	Galleries<span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo base_url(); ?>admin/gallery_add">Add New Gallery</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/gallery_list">Gallery List</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="#">
        	<i class="fa fa-wrench fa-fw"></i> 
        	Videos<span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level">
            <li>
                <a href="<?php echo base_url(); ?>admin/video_category_add">Add New Category</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/video_category_list">Category List</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/video_add">Add New Video</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/video_list">Video List</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/video_comment_list">Video Comment List</a>
            </li>
        </ul>
        <!-- /.nav-second-level -->
    </li>
    <li>
        <a href="<?php echo base_url(); ?>admin/subscribe_list"><i class="fa fa-wrench fa-fw"></i> Subscribe List</a>
    </li>
</ul>