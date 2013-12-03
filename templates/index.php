<script src="./public/script.js"></script>
<h1>Hello new User.</h1>
<h2>This is a first of "skinny micro php framework". </h2>

<br/>
<br/>
Basic usage sample.<br/>
<a href="<?php echo !empty($_SERVER["PATH_INFO"])? "":  $_SERVER["SCRIPT_URI"]."/"; ?>./hello?name=enter_your_name" >hello</a> <br/>

<br/><br/>
Extra usage sample.<br/>
<a href="./simple_page.php" >One page form</a>

<br/>
<br/>
<br/>

<?php if( empty($_SERVER["PATH_INFO"]) ) :?>
<h2> modify .htaccess </h2>
<div>
first of all you should modify RewriteBase in .htaccess.<br/>

<div>enter this line to .htaccess</div>
<textarea cols=100 >
RewriteBase <?php echo dirname($_SERVER["SCRIPT_URL"]);?>/
</textarea>
<br/>
</div>
<?php endif;?>




