<div class="setting-nav">
    <ul class="d-flex">
        <li class="<?php if ($this->controller == 'settings') echo "active"; ?>"><a href="<?php echo site_url('settings') ?>">General</a></li>
        <?php if ($this->isAdmin || $this->tier != 4) { ?>
            <li class="<?php if ($this->controller == 'company') echo "active"; ?>"><a href="<?php echo site_url('manage_company') ?>">Manage Subsidiary Companies</a></li>
            <li class="<?php if ($this->controller == 'regions') echo "active"; ?>"><a href="<?php echo site_url('regions') ?>">Manage regions</a></li>
            <li class="<?php if ($this->controller == 'users') echo "active"; ?>"><a href="<?php echo site_url('users') ?>">Manage Users</a></li>
            <li class="<?php if ($this->controller == 'vehicles') echo "active"; ?>"><a href="<?php echo site_url('vehicles') ?>">Manage Vehicles</a></li>
            <li class="<?php if ($this->controller == 'operators') echo "active"; ?>"><a href="<?php echo site_url('operators') ?>">Manage Operators</a></li>
        <?php } ?>
    </ul>
</div>