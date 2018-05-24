<?php $this->load->view('company_admin/operation/header') ?>
<section class="home-content padding-none">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <?php $this->load->view('company_admin/operation/left') ?>
                <div class="right-panel">
                    <div class="more-option">
                        <ul>
                            <li class="export-li">
                                <a href="service-empty.html">
                                    <i></i>
                                    <span>EXPORT</span>
                                </a>
                            </li>
                            <li class="print-li">
                                <a href="service-errolog.html">
                                    <i></i>
                                    <span>PRINT</span>
                                </a>
                            </li>
                            <li class="email-li">
                                <a href="service-history.html">
                                    <i></i>
                                    <span>E-MAIL</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="services-table">
                        <div class="services-table-head">
                            <i class="question-red"></i>
                            <h4>Your machines</h4>
                            <h6></h6>
                        </div>
                        <div class="srh-table">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Serial number</th>
                                        <th>Product category</th>
                                        <th>Service date</th>
                                        <th>Last active</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($machines) > 0) {
                                        foreach ($machines as $key => $machine) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="srh-machine">
                                                        <div class="track-icon"></div>
                                                        <h4><?php echo $machine['registration'] ?></h4>
                                                        <p>Group 1</p>
                                                    </div>
                                                </td>
                                                <td><?php echo $machine['deviceGUID'] ?></td>
                                                <td><?php echo $machine['type'] ?></td>
                                                <td><?php echo $machine['lastServiceDate'] ?></td>
                                                <td></td>
                                                <td>
                                                    <div class="srh-location-srh"></div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'><center>No vehicles added yet.</center></td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>