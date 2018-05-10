<div class="left-nav">
    <ul>
        <li class="current-nav <?php if ($this->controller == 'operation' && $this->action == 'index') echo 'active' ?>">
            <a href="<?php echo site_url('operation') ?>">
                <i></i> <span>STATS</span>
            </a>
        </li>
        <li class="trends-nav <?php if ($this->controller == 'operation' && $this->action == 'trends') echo 'active' ?>">
            <a href="<?php echo site_url('operation/trends') ?>">
                <i></i> <span>TRENDS</span>
            </a>
        </li>
        <li class="timeline-nav <?php if ($this->controller == 'operation' && $this->action == 'timeline') echo 'active' ?>">
            <a href="<?php echo site_url('operation/timeline') ?>">
                <i></i> <span>TIMELINE</span>
            </a>
        </li>
        <li class="map-nav <?php if (($this->controller == 'operation' && $this->action == 'map') || ($this->controller == 'dashboard' && $this->action == 'index')) echo 'active' ?>">
            <a href="<?php echo site_url('dashboard') ?>">
                <i></i> <span>MAP</span>
            </a>
        </li>
        <li class="operators-nav <?php if ($this->controller == 'operation' && $this->action == 'operators') echo 'active' ?>">
            <a href="<?php echo site_url('operation/operators') ?>">
                <i></i> <span>OPERATORS</span>
            </a>
        </li>
        <li class="machines-nav <?php if ($this->controller == 'operation' && $this->action == 'machines') echo 'active' ?>">
            <a href="<?php echo site_url('operation/machines') ?>">
                <i></i> <span>MACHINES</span>
            </a>
        </li>
        <li class="visits-nav <?php if ($this->controller == 'operation' && $this->action == 'visits') echo 'active' ?>">
            <a href="<?php echo site_url('operation/visits') ?>">
                <i></i> <span>VISITS</span>
            </a>
        </li>
    </ul>
</div>