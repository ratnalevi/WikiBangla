<?php  echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
 <channel>    
  <title><?php echo $feed_name; ?></title>
  <link><?php echo $feed_url; ?></link>
  <description><?php echo $page_description; ?></description>
  <language><?php echo $page_language; ?></language>	 
  <?php foreach($posts as $post): ?>     
  <item>
   <title><?php echo xml_convert($post->title_bn); ?></title>
   <link><?php echo site_url('p/' . $post->slug) ?></link>
   <guid><?php echo site_url('p/' . $post->slug) ?></guid>
   <description><![CDATA[ <?php echo character_limiter($post->description_bn, 200); ?> ]]></description>
   <pubDate><?php echo $post->created; ?></pubDate>
   <author>Wiki Bangla</author>
   
   <?php
   $content = '';
   $content .= '<!doctype html>';
	$content .= '<html lang="en" prefix="op: http://media.facebook.com/op#">';
	  $content .= '<head>';
	    $content .= '<meta charset="utf-8">';
	    $content .= '<link rel="canonical" href="'.site_url('p/' . $post->slug).'">';
	    $content .= '<link rel="stylesheet" title="default" href="#">';
	    $content .= '<title>'.$post->title_bn.'</title>';
	    $content .= '<meta property="fb:article_style" content="">';
	  $content .= '</head>';
	$content .= '<body>';
	  $content .= '<article>';
	    $content .= '<header>';
	      
	      $content .= '<!-- The title and subtitle shown in your article -->';
	      $content .= '<h1>'.$post->title_bn.'</h1>';

	      $content .= '<!-- The published and last modified time stamps -->';
	       $content .= '<time class="op-published" dateTime="'.$post->created.'">'.$post->created.'</time>';
	      $content .= '<time class="op-modified" dateTime="'.$post->updated.'">'.$post->updated.'</time>';
	    $content .= '</header>';
	    
	    $parts = $this->d_model->table_row('posts_parts','post_id',$post->id)->result();
	    foreach($parts as $part){
			$content .= '<h1>'.$part->part_title_bn.'</h1>';
			$sections = $this->d_model->table_row('posts_parts_sections','post_part_id',$part->id)->result();
			foreach($sections as $section){
				
				$content .= '<figure data-feedback="fb:likes, fb:comments">
								<img src="'.base_url(UPLOAD_POST.'/'.$section->image).'" />
                  					</figure>';
                $content .= $section->section_description_bn;
			}
		}
	    
	    $content .= '<footer>';
	      $content .= '<ul class="op-related-articles">';
		    $content .= '<li><a href="http://instantarticles.fb.com"></a></li>';
		    $content .= '<li><a href="http://instantarticles.fb.com"></a></li>';
		  $content .= '</ul>';
		        $content .= '<!-- Copyright details for your article -->';
		        $content .= '<small>© Facebook</small>';

		    $content .= '</footer>';

		  $content .= '</article>';
		$content .= '</body>';
	$content .= '</html>';
	  
   ?>
   <content:encoded><![CDATA[ <?php echo $content; ?> ]]></content:encoded>
  </item>         
  <?php endforeach; ?>     
 </channel>
</rss>