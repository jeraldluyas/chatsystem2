<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');
        echo $this->Html->css('style');
        echo $this->Html->css('auth');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div id="top_nav">
                    <?php echo $this->Html->link('HOME', array('controller' => 'home', 'action' => 'index')); ?> | 
                    <?php if ($auth->isAuthorized()) { ?>
                        Hello <span class="username"><?php echo $auth->user('username'); ?></span>
                        <?php echo $this->Html->link('Logout', array('controller' => 'auth', 'action' => 'logout')); ?>
                    <?php } else { ?>
                        <?php echo $this->Html->link('Login', array('controller' => 'auth', 'action' => 'login')); ?> |
                        <?php echo $this->Html->link('Register', array('controller' => 'auth', 'action' => 'register')); ?>
                    <?php } ?>
                </div>
            </div>
            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">
                <?php
                echo $this->Html->link(
                        $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)
                );
                ?>
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>
