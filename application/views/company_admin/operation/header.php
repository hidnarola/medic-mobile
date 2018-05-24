<section class="select-services">
    <div class="container">
        <div class="row">
            <ul>
                <li class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All products
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">products 01</a>
                        <a class="dropdown-item" href="#">products 02</a>
                        <a class="dropdown-item" href="#">products 03</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select region
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php foreach ($this->regions as $region) { ?>
                            <a class="dropdown-item" href="#" data-href="<?php echo $region['regionGUID'] ?>"><?php echo $region['regionName'] ?></a>
                        <?php } ?>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select branch
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">products 01</a>
                        <a class="dropdown-item" href="#">products 02</a>
                        <a class="dropdown-item" href="#">products 03</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select group
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">products 01</a>
                        <a class="dropdown-item" href="#">products 02</a>
                        <a class="dropdown-item" href="#">products 03</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>