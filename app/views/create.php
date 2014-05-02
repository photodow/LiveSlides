<?php

	if(Session::has('error')){
		$error = Session::get('error');
		$attempt = true;
		Session::forget('error');
	}else{
		$error = Validator::make(array(), array())->messages();
		$attempt = false;
	}
	
	if(Session::has('post')){
		$post = Session::get('post');
		Session::forget('post');
	}else{
		$post = $_POST;
	}
	
?>


<section class="create left">
    <h2><i class="icon-plus"></i> Create Slide</h2>
    <form method="POST" action="/create/process">
        <fieldset>
            <legend><i class="icon-info-circle"></i> Meta Data</legend>
            <p<?php if($error->has('title')){ echo ' class="input error"'; } ?>>
            	<label for="title">
                	Title
                    <span style="left:227px;">
                    	<?php if($error->has('title')){ echo $error->first('title'); }else if($attempt){ ?>
                        Look good!
                        <?php }else{ ?>
                    	Please give your presentation a title.
                        <?php } ?>
                    </span>
                </label>
                <input type="text" id="title" name="title" css="title" maxlength="32"<?php if(!empty($post['title'])){ echo ' value="' . $post['title'] . '"'; } ?> />
            </p>
            <p<?php if($error->has('description')){ echo ' class="input error"'; } ?>>
            	<label for="description">
                	Description
                    <span style="left: 599px;">
                    	<?php if($error->has('description')){ echo $error->first('description'); }else if($attempt){ ?>
                        Look good!
                        <?php }else{ ?>
                        Please write a short description about your presentation.
                        <?php } ?>
                	</span>
                </label>
                <textarea id="description" name="description" class="description" maxlength="280"><?php if(!empty($post['description'])){ echo $post['description']; } ?></textarea>
            </p>
            <p<?php if($error->has('keywords')){ echo ' class="input error"'; } ?>>
            	<label for="keywords">
                	Keywords
                    <span style="left:227px;">
                    	<?php if($error->has('keywords')){ echo $error->first('keywords'); }else if($attempt && !empty($post['keywords'])){ ?>
                        Look good!
                        <?php }else{ ?>
                    	Please seperate keywords by a comma (,).
                        <?php } ?>
                	</span>
                </label>
                <input type="text" id="keywords" name="keywords" class="keywords" maxlength="64"<?php if(!empty($post['keywords'])){ echo ' value="' . $post['keywords'] . '"'; } ?> />
            </p>
        </fieldset>
        <fieldset>
            <legend><i class="icon-code"></i> HTML and CSS</legend>
            <p<?php if($error->has('html')){ echo ' class="input error"'; } ?>>
                <label for="html">
                	HTML
                    <?php if($error->has('html')){ ?>
                    <span style="left:599px;">
                  	<?php echo $error->first('html'); ?>
                	</span>
                    <?php } ?>
                </label>
                <textarea id="html" name="html" class="html"><?php if(!empty($post['html'])){ echo $post['html']; }else{ ?><article data-in="" data-out="" data-speed="" data-delay="" data-easing="" class="active">
    <!-- Slide #1 -->
</article>
<article data-in="" data-out="" data-speed="" data-delay="" data-easing="">
    <!-- Slide #2 -->
</article><?php } ?></textarea>
            </p>
            <?php /*<p>
                <label for="css">CSS</label>
                <textarea id="css" name="css" class="css"></textarea>
            </p>*/ ?>
        </fieldset>
        <p>
            <button name="save" id="save" class="submit">Save <i class="icon-save"></i></button>
        </p>
    </form>
</section>

<?php echo $sidebar; ?>