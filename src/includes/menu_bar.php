<?php
function printmenu($active_component) {
	?>
<div id='cssmenu'>
	<ul>
		<li <?php if ($active_component=="indexpage") {?> class='active '
			<?php } ?>><a href='index.php'><span>Home</span></a></li>
		<li <?php if ($active_component=="passages") {?> class='active '
			<?php } ?>><a href='passages.php'><span>Passages</span></a></li>
		<li <?php if ($active_component=="author") {?> class='active '
			<?php } ?>><a href='login.php'><span>Author Section</span></a></li>
		<li <?php if ($active_component=="about") {?> class='active '
			<?php } ?>><a href='about.php'><span>About Us</span></a></li>
		<li <?php if ($active_component=="contactus") {?> class='active '
			<?php } ?>><a href='contactus.php'><span>Contact Us</span></a></li>
	</ul>
</div>
<?php
}
?>
