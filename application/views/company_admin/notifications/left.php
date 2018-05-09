<div class="left-nav">
    <ul>
        <li class="current-nav <?php if ($this->controller == 'notifications' && $this->action == 'index') echo 'active' ?>">
            <a href="<?php echo site_url('notifications') ?>">
                <i></i> <span>CURRENT</span>
            </a>
        </li>
        <li class="visits-nav <?php if ($this->controller == 'notifications' && $this->action == 'log') echo 'active' ?>">
            <a href="<?php echo site_url('notifications/log') ?>">
                <i></i> <span>LOG</span>
            </a>
        </li>
    </ul>
</div>