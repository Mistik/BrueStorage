<?php
require("includes/core_security_check.php");
global $core, $user;
?>

				<div id="main_menu">
                	<a href="index.php" <?php if($core->inFile("index.php")) { $core->Output("class=\"menu_active\""); } ?>>Upload</a>
                    <a href="tos.php" <?php if($core->inFile("tos.php")) { $core->Output("class=\"menu_active\""); } ?>>ToS</a>
                    <a href="faq.php" <?php if($core->inFile("faq.php")) { $core->Output("class=\"menu_active\""); } ?>>FAQ</a>
					<a href="contact.php" <?php if($core->inFile("contact.php")) { $core->Output("class=\"menu_active\""); } ?>>Contact</a>
                    
                    <?php if(!$user->LoggedOn()) { ?>
                    	<a href="login.php" <?php if($core->inFile("login.php")) { $core->Output("class=\"menu_active\""); } ?>>Login</a>
                    	<a href="register.php" <?php if($core->inFile("register.php")) { $core->Output("class=\"menu_active\""); } ?>>Register</a>
                    <?php } else { ?>
                    	<a href="usercp.php" <?php if($core->inFile("usercp.php")) { $core->Output("class=\"menu_active\""); } ?>>User CP</a>
                    	<?php if($user->AccessLevel(2, true)) { ?>
                            <a href="staffcp.php" <?php if($core->inFile("staffcp.php")) { $core->Output("class=\"menu_active\""); } ?>>Staff CP</a>
                        <?php } ?>
                        <a href="index.php?action=logout">Logout</a>
                    <?php } ?>
                </div>