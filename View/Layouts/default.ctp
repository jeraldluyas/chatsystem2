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
            <?php if(isset($title)) echo $title, ' - '; echo DEFAULT_TITLE; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        //echo $this->Html->css('cake.generic');
        echo $this->Html->css('/lib/bootstrap/css/bootstrap');
        echo $this->Html->css('/lib/bootstrap/css/bootstrap-theme');
        echo $this->Html->css('style');
        echo $this->Html->css('auth');
        echo $this->fetch('css');
        ?>
        <?php
        echo $this->Html->script('jquery-1.8.0');
        echo $this->Html->script('/lib/bootstrap/js/bootstrap');
        echo $this->Html->script('const');
        ?>
        <script type="text/javascript">
            Const.SITE_URL = '<?php echo Router::url('/'); ?>';
        </script>
        <?php
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

            </div>
        </div>
        <?php // echo $this->element('sql_dump'); ?>
    </body>
</html>
