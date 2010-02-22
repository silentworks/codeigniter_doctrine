<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php echo isset($page_title) ? $page_title . ' | ' : ''; ?><?php echo $app_name; ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css" type="text/css" media="screen, projection" />
    </head>

    <body>
        <div id="header">
        	<div id="extra_nav">
				<ul>
					<li><a href=""><span><?php echo lang('general_help'); ?></span></a></li>
					<li class="last"><a href="<?php echo site_url('auth/logout'); ?>"><span><?php echo lang('general_logout'); ?></span></a></li>
				</ul>
			</div>
        </div>
        
        <div id="nav">
            <ul>
                <?php foreach (nav('active') as $nav): ?>
                    <li id="<?php echo $nav['cssid']; ?>" class="<?php echo $nav['align']; ?> <?php echo $nav['cssmode']; ?>">
                        <a href="<?php echo $nav['url']; ?>" title="Go to the <?php echo $nav['title']; ?> page"><?php echo $nav['title']; ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>

        <!-- Content -->
        <div id="content">
            
			<div id="main">
				<div class="inner">
					<h1 id="page_title"><?php echo $page_title; ?></h1>
					<?php echo $this->session->flashdata('success'); ?>
					<div id="wrapper">
						<?php echo $content_for_layout; ?>
					</div>
					
				</div>
			</div>
			
			<div id="sidebar"><?php if(isset($content_for_sidebar)) echo $content_for_sidebar; ?></div>
            
        </div>
        <!-- Content -->

        <div id="footer">
            <div class="pad">
                <div id="sister-sites" class="module">

                </div>

                <div id="contact" class="module">

                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/lib/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/base.js"></script>
    </body>
</html>