<div class="left-nav">
    <ul>
        <li class="current-nav <?php if ($this->controller == 'service' && $this->action == 'index') echo 'active' ?>">
            <a href="<?php echo site_url('service') ?>">
                <i></i> <span>CURRENT</span>
            </a>
        </li>
        <li class="error-log <?php if ($this->controller == 'service' && $this->action == 'error') echo 'active' ?>">
            <a href="<?php echo site_url('service/error') ?>">
                <i></i> <span>Error Log</span>
            </a>
        </li>
        <li class="history-nav <?php if ($this->controller == 'service' && $this->action == 'history') echo 'active' ?>">
            <a href="<?php echo site_url('service/history') ?>">
                <i></i> <span>History</span>
            </a>
        </li>
    </ul>
</div>