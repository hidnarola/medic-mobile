<script type="text/javascript" src="assets/js/moment.min.js"></script>
<script type="text/javascript" src="assets/js/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/daterangepicker.css" />
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
                        <a class="dropdown-item" href="#">products 01</a>
                        <a class="dropdown-item" href="#">products 02</a>
                        <a class="dropdown-item" href="#">products 03</a>
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

<section class="home-content padding-none">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <?php $this->load->view('company_admin/operation/left') ?>
                <div class="right-panel">
                    <div class="more-option">
                        <ul>
                            <li class="export-li">
                                <a href="javascript:void(0)">
                                    <i></i>
                                    <span>EXPORT</span>
                                </a>
                            </li>
                            <li class="print-li">
                                <a href="javascript:void(0)">
                                    <i></i>
                                    <span>PRINT</span>
                                </a>
                            </li>
                            <li class="email-li">
                                <a href="service-history.html" data-toggle="modal" data-target="#individual-overview">
                                    <i></i>
                                    <span>E-MAIL</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="map-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Live map</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Stops</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="map-content">
                                    <div class="map" id="map" style="height: 540px"></div>
                                    <div id="accordion" class="map-accordion">
                                        <h2>MY FLEET (<?php echo count($vehicle_latlong); ?>) <i></i></h2>
                                        <?php foreach ($vehicle_latlong as $k => $v) { ?>
                                            <div class="card">
                                                <div class="card-header" id="heading<?php echo $k ?>">
                                                    <div data-toggle="collapse" data-target="#collapse<?php echo $k ?>" aria-expanded="true" aria-controls="collapsethree"  class="collapsed">
                                                        <div class="card-header-body">
                                                            <div class="card-header-img"><i></i></div>
                                                            <h3><?php echo $v['deviceGUID']; ?> <br/> 2 products</h3>
                                                            <p>Operator: John Doe</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapse<?php echo $k ?>" class="collapse" aria-labelledby="heading<?php echo $k ?>" data-parent="#accordion">
                                                    <div class="card-body card-content">
                                                        <div class="last-active">
                                                            <p>Last active: About a minute ago <br/> No active alerts.</p>
                                                            <a href="">See stops »</a>
                                                        </div>
                                                        <div class="alert-btm">
                                                            <h4>Alerts:</h4>
                                                            <p>10.8.2017, 11:41 - Truck driving with crane up</p>
                                                            <h4>Notifications:</h4>
                                                            <p>10.8.2017, 11:41 - Emergency stop not used</p>
                                                            <p>10.8.2017, 11:41 - Emergency stop not used</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="map-content">
                                    <div class="map stop-map" id="map2" style="height: 540px">
                                        <img src="assets/images/map.jpg" alt="" />
                                    </div>
                                    <div class="map-accordion stops">
                                        <h2>Stops <i></i></h2>
                                        <div class="card">
                                            <div class="card-header-body">
                                                <div class="card-header-img"><i></i></div>
                                                <h3>50-BBB-9/34935 <br> 2 products</h3>
                                                <p>Operator: John Doe</p>
                                            </div>
                                            <div class="date-here">
                                                <p>22.7.–26.7.2017</p>
                                                <i></i>
                                            </div>
                                            <div class="date-list">
                                                <ul id="content-8">
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <h6>23.7.2017</h6>
                                                <ul>
                                                    <li>
                                                        <div class="date-list-box">
                                                            <h3>STOP 1: Westham road 234, Warminster</h3>
                                                            <p>Entry time: 8.45</p>
                                                            <p>Exit time: 8.58</p>
                                                            <p>Duration: 0.11 h</p>
                                                            <p>Cycles: 4</p>
                                                        </div>
                                                    </li>
                                                </ul>	
                                            </div>
                                        </div>	
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>
<!-- Modal -->
<div class="modal fade individual-overview" id="individual-overview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="trucks-nav active"><a href=""> <i></i> <span>TRUCK</span></a></li>
                        <li class="newtrack-nav"> <a href=""> <i></i> <span>LOADER <br/> CRANE</span></a></li>
                        <li class="newtrack-nav"><a href=""> <i></i> <span>DEMOUNT-ABLE</span> </a></li>
                    </ul>
                </div>
                <div class="right-panel">
                    <div class="close-div">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> Close </span></button>
                    </div>	
                    <div class="user-popup">
                        <img src="assets/images/loader-track.png">
<!--                        <span class="bdr-red">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="44" viewBox="0 0 53 34">
                            <g fill="none" fill-rule="evenodd">
                            <path fill="#989898" d="M48.818 10.793H38.159V22.8H.231v4.332c0 2.052 1.7 3.724 3.785 3.724h2.549a4.562 4.562 0 0 0 4.325 3.117c2.009 0 3.785-1.292 4.326-3.117h25.258a4.562 4.562 0 0 0 4.326 3.117c2.008 0 3.785-1.292 4.326-3.117H52.448V14.441c.155-1.976-1.545-3.648-3.63-3.648zM10.968 32.53c-1.776 0-3.166-1.369-3.166-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.39 3.117-3.167 3.117zm33.988 0c-1.777 0-3.167-1.369-3.167-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.468 3.117-3.167 3.117zm6.256-11.325h-2.549v-4.636h2.55v4.636zm0-6.004H48.2c-.54 0-.927.38-.927.912v5.548c0 .532.386.912.927.912h3.012v6.84h-1.7c0-2.508-2.007-4.484-4.556-4.484-2.55 0-4.558 1.976-4.558 4.484H15.526c0-2.508-2.008-4.484-4.557-4.484-2.55 0-4.558 1.976-4.558 4.484H4.017c-1.313 0-2.395-1.064-2.395-2.356v-3.04h37.85V12.085h9.268c1.314 0 2.395 1.064 2.395 2.356l.077.76z"/>
                            <path fill="#FFF" d="M29.97 21.737H4.248V9.12H29.97v12.617zM5.64 20.445H28.58v-9.88H5.639v9.88z"/>
                            <path fill="#D52B1F" d="M37.463 21.737V7.068L28.58 1.672 16.298.152v5.7L12.9 9.12h2.008l2.008-2.052 2.24 2.052h2.163L17.766 5.7l.077-3.952 10.35 1.672 6.335 5.7v12.617z"/>
                            <ellipse cx="10.969" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                            <ellipse cx="44.956" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                            </g>
                            </svg>
                        </span>-->
                        <h3><div id="vehicle_title">91-BJD-1/35264</div></h3>
                        <p>Carrying 2 equipment</p>
                        <h6 class="online">Online</h6>

                        <div class="activation-info">
                            <table class="table">
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Last active</td>
                                                <td>Less than a minute ago</td>
                                            </tr>
                                            <tr>
                                                <td>Operator</td>
                                                <td>John Doe</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Serial number</td>
                                                <td>BL211HP00348</td>
                                            </tr>
                                            <tr>
                                                <td>Model</td>
                                                <td>211E-3_HIPRO_CD</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>System type</td>
                                                <td>22</td>
                                            </tr>
                                            <tr>
                                                <td>Program serial number</td>
                                                <td>7011</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>	
                    <div class="popup-tabs mappopup-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li><a id="popuphome-tab" data-toggle="tab" href="#popuphome" role="tab" aria-controls="home" aria-selected="true">Overview</a></li>
                            <li><a id="popupoperations-tab" data-toggle="tab" href="#popupoperations" role="tab" aria-controls="profile" aria-selected="false">Trends</a></li>
                            <li><a class="active" id="popupsafety-tab" data-toggle="tab" href="#popupsafety" role="tab" aria-controls="contact" aria-selected="false">Map</a></li>
                            <li><a id="popupmap-tab" data-toggle="tab" href="#popupmap" role="tab" aria-controls="contact" aria-selected="false">Service</a></li>
                            <li><a id="popupnotifications-tab" data-toggle="tab" href="#popupnotifications" role="tab" aria-controls="contact" aria-selected="false">Notifications</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="popuphome" role="tabpanel" aria-labelledby="popuphome-tab">
                                <div class="active-notification active-table-info">
                                    <h2>Active notifications</h2>
                                    <div class="active-notification-inr">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <i class="question-red"></i> <strong>Urgent Operation Alert</strong>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="question-yellow"></i> <strong>Urgent Operation Alert</strong>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>	
                                </div>	
                                <div class="loader-box service-info">
                                    <ul class="d-flex flex-wrap">
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Engine running</h4>
                                                <h3>6.51</h3>
                                                <h4>hours</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Engine idle</h4>
                                                <h3>1.02</h3>
                                                <h4>hours</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Engine PTO on</h4>
                                                <h3>2.50</h3>
                                                <h4>hours</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Idling %</h4>
                                                <h3>21.5</h3>
                                                <h4>percents</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Total fuel<br/> consumption</h4>
                                                <h3>32.00</h3>
                                                <h4>liters</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Fuel consumption idle</h4>
                                                <h3>3.10</h3>
                                                <h4>liters</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Fuel consumption PTO on</h4>
                                                <h3>8.31</h3>
                                                <h4>liters</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Fuel consumption per hour</h4>
                                                <h3>2.93</h3>
                                                <h4>liters</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Driving distance</h4>
                                                <h3>52.67</h3>
                                                <h4>kilometers</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="popupoperations" role="tabpanel" aria-labelledby="popupoperations-tab">
                                <div class="select-data">
                                    <ul>
                                        <li>
                                            <label>Select data</label>
                                            <div class="dropdown">
                                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> operation time </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <label>Select timeframe</label>
                                            <div class="dropdown">
                                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> operation time </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="graph-img">
                                    <img src="assets/images/graph.jpg" alt="">
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="popupsafety" role="tabpanel" aria-labelledby="popupsafety-tab">
                                <div class="today-count">
<!--                                <span>19.8.</span>
                                    <span>20.8.</span>
                                    <span>21.8.</span>
                                    <span>22.8.</span>
                                    <span>23.8.</span>
                                    <span>24.8.</span>-->
                                    <strong>TODAY</strong>
                                </div>
                                <div class="map" id="vehicle_map" style="height: 540px">
                                    <img src="assets/images/map.jpg" alt="">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="popupmap" role="tabpanel" aria-labelledby="popupmap-tab">
                                <div class="loader-box service-info">
                                    <ul class="d-flex flex-wrap">
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Next scheduled service</h4>
                                                <h3>1.10.2017</h3>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Service counters <br/> due in</h4>
                                                <h3>64</h3>
                                                <h4>days</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Next maintenance after</h4>
                                                <h3>5119</h3>
                                                <h4>cycles</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="loader-box-body">
                                                <h4>Usage time to next maintenance</h4>
                                                <h3>38d 13h</h3>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="active-notification">
                                    <h2>Service history</h2>
                                    <div class="active-notification-inr">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Ordered</th>
                                                    <th>Completed</th>
                                                    <th>Service provider</th>
                                                    <th>Service type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>01.08.2017</td>
                                                    <td>31.08.2017</td>
                                                    <td>Company name</td>
                                                    <td>Periodic maintenance</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>	
                            </div>
                            <div class="tab-pane fade" id="popupnotifications" role="tabpanel" aria-labelledby="popupnotifications-tab">
                                <div class="active-notification active-table-info">
                                    <h2>Active notifications</h2>
                                    <div class="active-notification-inr">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <i class="question-red"></i> <strong>Urgent Operation Alert</strong>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="question-yellow"></i> <strong>Urgent Operation Alert</strong>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>	
                                </div>
                                <div class="latest-message noti-log-table">
                                    <h2>Notifications log</h2>
                                    <div class="latest-message-table">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-yellow"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-red"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-yellow"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-red"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-yellow"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-red"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-yellow"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="operation-td">
                                                            <i class="question-red"></i>
                                                            <h5>Urgent Operation Alert</h5>
                                                        </div>
                                                    </td>
                                                    <td>3.6.2017 13.07</td>
                                                    <td>Truck driving with crane up</td>
                                                    <td>John Doe</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>
<div id="custom_timeframe_modal" class="modal fade">
    <div class="modal-dialog modal-md" style="margin:12% auto">
        <div class="modal-content">
            <div class="modal-header bg-black custom_modal_header">
                <h6 class="modal-title text-center">TimeFrame Selction</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body panel-body" id="custom_timeframe_body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-semibold">Time Frame Selection:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" placeholder="Select a daterange" id="timeframe" name="timeframe">
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-semibold">Start Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input type="text" class="form-control pickadate-accessibility" placeholder="Select a date&hellip;" id="txt_track_start_date" name="track_start_date" value="<?php echo date('d F, Y'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-semibold">Start Time:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                                    <input type="text" class="form-control pickatime-hidden" placeholder="Try me&hellip;" name="track_start_time" id="txt_track_start_time" value="<?php echo '12:00 AM'; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-semibold">End Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input type="text" class="form-control pickadate-accessibility" placeholder="Select a date&hellip;" id="txt_track_end_date" name="track_end_date" value="<?php echo date('d F, Y'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">    
                                            <div class="form-group">
                                                <label class="text-semibold">End Time:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                                    <input type="text" class="form-control pickatime-hidden" placeholder="Try me&hellip;" name="track_end_time" id="txt_track_end_time" value="<?php echo '11:30 PM'; ?>">
                                                </div>
                                            </div>
                                        </div>-->
                    <input type="hidden" name="txt_deviceGUID" id="txt_deviceGUID">
                    <button type="button" class="btn btn-red btn-block btn_custom_tf_serach">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y&callback=initMap"></script>			
<script type="text/javascript">
    var mapOptions = '',
            vmap = '',
            start_point = [],
            end_point = [],
            lat_lng = [],
            lat_lng_2 = [],
            path = [],
            vmarker = '',
            prev_latlng,
            gps_track, last_index;
    var cnt = 0;

</script>
<script type="text/javascript" src="assets/js/custom_pages/vehicle_track.js"></script>
<script type="text/javascript">

    //--Custom scorllbar
    $("#content-8").mCustomScrollbar({
        axis: "y"
    });

    //-- Script for map
    const MONTH_NAMES = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var vehicle_data = <?php echo json_encode($vehicle_latlong); ?>;

    var vehicle_latlong = [],
            markers = [],
            map,
            random_color = '';

    $(vehicle_data).each(function (key, value) {
        vehicle_latlong.push({
            lat: parseFloat(value['latitude'].replace('"', '')),
            lng: parseFloat(value['longitude'].replace('"', ''))
        });
    });

    function initMap() {
        $('#map').show();
        var mapOptions = {
            zoom: 16,
            center: new google.maps.LatLng(vehicle_latlong[0]),
        };
        map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var latlngbounds = new google.maps.LatLngBounds();
        var infoWindow = new google.maps.InfoWindow();
        $(vehicle_latlong).each(function (key, value) {
            var myLatlng = new google.maps.LatLng(parseFloat(value['lat']), parseFloat(value['lng']));
            random_color = randomColor();
//            var pinImage = new google.maps.MarkerImage("http://www.googlemapsmarkers.com/v1/" + random_color + '/');
            var pinImage = base_url + 'assets/images/loader-track-marker.png';
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: {
                    url: pinImage,
                    labelOrigin: new google.maps.Point(30, 60)
                },
                //url: site_url + 'track/vehicle/' + vehicle_data[key]['deviceGUID'],
                label: {
                    color: 'black',
                    fontWeight: 'bold',
                    text: vehicle_data[key]['deviceGUID'],
                },
            });
            //var markerCluster = new MarkerClusterer(map, marker,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
            var d = new Date();
            var date = d.getDate() + ' ' + MONTH_NAMES[d.getMonth()] + ', ' + d.getFullYear();
            var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
            var last_hour = "?track_start_date=" + date + "&track_start_time=" + (d.getHours() - 1) + ":" + d.getMinutes() + ":" + d.getSeconds() + "&track_end_date=" + date + "&track_end_time=" + time;
            var last_two_hour = "?track_start_date=" + date + "&track_start_time=" + (d.getHours() - 2) + ":" + d.getMinutes() + ":" + d.getSeconds() + "&track_end_date=" + date + "&track_end_time=" + time;
            var last_three_hour = "?track_start_date=" + date + "&track_start_time=" + (d.getHours() - 3) + ":" + d.getMinutes() + ":" + d.getSeconds() + "&track_end_date=" + date + "&track_end_time=" + time;
            var today = "?track_start_date=" + date + "&track_start_time=00:00:01" + "&track_end_date=" + date + "&track_end_time=23:30:00";
            var yesterday = "?track_start_date=" + (d.getDate() - 1) + " " + MONTH_NAMES[d.getMonth()] + ", " + d.getFullYear() + "&track_start_time=00:00:01" + "&track_end_date=" + (d.getDate() - 1) + "&track_end_time=23:30:00";
            var last_use = "?last_use=1";
            var content = '<div>' +
                    '<label><b>Track</b> : ' + vehicle_data[key]['deviceGUID'] + '</label>' +
                    '<ul style="padding-left:16px;margin-bottom:0px">' +
                    '<li style="padding:3px"><b><a href="javascript:void(0)" class="display-map" data-href="' + site_url + "company_admin/operation/track_vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + today + '" style="color:#000">Today</a></b></li>' +
                    '<li style="padding:3px"><b><a href="javascript:void(0)" class="display-map" data-href="' + site_url + "company_admin/operation/track_vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + yesterday + '" style="color:#000">Yesterday</a></b></li>' +
                    '<li style="padding:3px"><b><a href="javascript:void(0)" class="display-map" data-href="' + site_url + "company_admin/operation/track_vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + last_use + '" style="color:#000">Last use</a></b></li>' +
                    '<li style="padding:3px"><b><a href="javascript:void(0)" onClick="open_custom_timeframe_modal(\'' + vehicle_data[key]['deviceGUID'] + '\')" style="color:#000">Date range</a></b></li>' +
                    '</ul>' +
                    '</div>';
            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.close();
                infoWindow.setContent(content);
                infoWindow.open(map, this);
            });
            markers.push(marker);
            //google.maps.event.addListener(marker, 'click', function() { window.location.href = this.url; });
            latlngbounds.extend(marker.position);
            $('.' + vehicle_data[key]['deviceGUID'] + '_star').css('color', '#' + random_color);
        });


        var bounds = new google.maps.LatLngBounds();

        /* Set map's marker bounds */
//        map.setCenter(latlngbounds.getCenter());
//        map.fitBounds(latlngbounds);

        var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
    /******************************************
     Marker Random Color
     *******************************************/
    var safeColors = ['00', '33', '66', '99', 'cc', 'ff'];
    function rand() {
        return Math.floor(Math.random() * 6);
    }
    function randomColor() {
        var r = safeColors[rand()];
        var g = safeColors[rand()];
        var b = safeColors[rand()];
        var color = '#' + r + g + b;
        return (color.split('#'))[1];
    }
</script>
<script type="text/javascript">
    function open_custom_timeframe_modal(deviceGUID) {
        $('#txt_deviceGUID').val(deviceGUID);
        $('#custom_timeframe_modal').modal('show');
    }
    function display_vmap(href) {
        $('#custom_loading').show();
        $.ajax({
            type: "POST",
            url: href,
            dataType: 'json',
            success: function (data) {
                $('#custom_loading').hide();
                $('#individual-overview').modal();
                $('#vehicle_title').html(data.deviceGUID);

                gps_track = data.vehicle_latlong;
                last_index = gps_track.length - 1;
                mapOptions = {
                    zoom: 19,
                    center: new google.maps.LatLng({lat: 54.602129, lng: -7.302873}),
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    },
                    fullscreenControl: true,
                    fullscreenControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_BOTTOM
                    },
//                    mapTypeId: google.maps.MapTypeId.HYBRID
                };

                vmap = new google.maps.Map(document.getElementById("vehicle_map"), mapOptions);
                if (gps_track.length != 0) {
                    if (gps_track[0]['is_google_route'] == 1) {
                        setTimeout(function () {
                            google_route_livemap('<?php echo $this->uri->segment(3); ?>');
                        }, 1000);
                    } else {
                        setTimeout(function () {
                            normal_livemap('<?php echo $this->uri->segment(3); ?>');
                        }, 1000);
                    }
                } else {
                    new PNotify({
                        title: 'Warning notice',
                        text: 'No Data Exists for this timeframe. Page will auto redirect to live tracking page.',
                        addclass: 'bg-warning',
                        buttons: {
                            sticker: false
                        },
                    });
                    var deviceGUID = '<?php echo $this->uri->segment(3); ?>';
                    var current_latlng = new google.maps.LatLng(
                            parseFloat((gps_device_data[deviceGUID]['GPS']['Latitude'])),
                            parseFloat((gps_device_data[deviceGUID]['GPS']['Longitude']))
                            );
                    vmarker = new google.maps.Marker({
                        position: current_latlng,
                        map: vmap
                    });
                    var latlngbounds = new google.maps.LatLngBounds();
                    latlngbounds.extend(vmarker.position);
                    var bounds = new google.maps.LatLngBounds();
                    map.setCenter(latlngbounds.getCenter());
                    setInterval(function () {
                        noraml_live_track(deviceGUID);
                    }, 7000);
                }

            }
        });
    }
    //-- Display map on popup selection
    $(document).on('click', '.display-map', function () {
        var href = $(this).attr('data-href');
        display_vmap(href);
    });

    $(document).on('click', '.btn_custom_tf_serach', function () {
        var timeframe = $('#timeframe').val();
        times = timeframe.split('-');
        timeframe1 = $.trim(times[0]);
        datesArr1 = timeframe1.split(' ');
        txt_track_start_date = datesArr1[0];
        txt_track_start_time = datesArr1[1];
        timeframe2 = $.trim(times[1]);
        datesArr2 = timeframe2.split(' ');
        txt_track_end_date = datesArr2[0];
        txt_track_end_time = datesArr2[1];
        $('#custom_timeframe_modal').modal('hide');
//        var href = '?track_start_date=' + $('#txt_track_start_date').val() + '&track_start_time=' + $('#txt_track_start_time').val() + '&track_end_date=' + $('#txt_track_end_date').val() + '&track_end_time=' + $('#txt_track_end_time').val();
        var href = site_url + "company_admin/operation/track_vehicle/" + $('#txt_deviceGUID').val() + '/?track_start_date=' + txt_track_start_date + '&track_start_time=' + txt_track_start_time + '&track_end_date=' + txt_track_end_date + '&track_end_time=' + txt_track_end_time;
        display_vmap(href);
//        window.location.href = site_url + 'track/vehicle/' + $('#txt_deviceGUID').val() + '/' + href;
    });
    $(function () {
        //-- Initialize daterange picker
        $('#timeframe').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            maxDate: new Date(),
            locale: {
                format: 'DD/MM/YYYY hh:mm A'
            }
        });

        $('#tbl_tracking tr td a').on('click', function () {
            $('.indi_div').removeClass('hide');
            livemap($(this).attr('deviceGUID'));
            map2($(this).attr('deviceGUID'));
            $('.td_last_service').html($(this).attr('lastServiceDate'));
            $('.td_next_service').html($(this).attr('nextServiceDue'));
            $('.td_last_inspection').html($(this).attr('lastInspectionDate'));
            $('.td_next_inspection').html($(this).attr('nextInspectionDue'));
        });

        // Pie with legend
        // ------------------------------

        // Initialize chart
        animatedPieWithLegend("#pie_basic_legend", 200);

        // Chart setup
        function animatedPieWithLegend(element, size) {

            // Add data set
            var data = [
                {
                    "status": "New",
                    "value": 578,
                    "color": "#29B6F6"
                }, {
                    "status": "Pending",
                    "value": 983,
                    "color": "#66BB6A"
                }, {
                    "status": "Shipped",
                    "value": 459,
                    "color": "#EF5350"
                }
            ];

            // Main variables
            var d3Container = d3.select(element),
                    distance = 2, // reserve 2px space for mouseover arc moving
                    radius = (size / 2) - distance,
                    sum = d3.sum(data, function (d) {
                        return d.value;
                    });


            // Create chart
            // ------------------------------

            // Add svg element
            var container = d3Container.append("svg");

            // Add SVG group
            var svg = container
                    .attr("width", size)
                    .attr("height", size)
                    .append("g")
                    .attr("transform", "translate(" + (size / 2) + "," + (size / 2) + ")");


            // Construct chart layout
            // ------------------------------

            // Pie
            var pie = d3.layout.pie()
                    .sort(null)
                    .startAngle(Math.PI)
                    .endAngle(3 * Math.PI)
                    .value(function (d) {
                        return d.value;
                    });

            // Arc
            var arc = d3.svg.arc()
                    .outerRadius(radius);


            //
            // Append chart elements
            //

            // Group chart elements
            var arcGroup = svg.selectAll(".d3-arc")
                    .data(pie(data))
                    .enter()
                    .append("g")
                    .attr("class", "d3-arc")
                    .style({
                        'stroke': '#fff',
                        'stroke-width': 2,
                        'cursor': 'pointer'
                    });

            // Append path
            var arcPath = arcGroup
                    .append("path")
                    .style("fill", function (d) {
                        return d.data.color;
                    });


            // Add interactions
            arcPath
                    .on('mouseover', function (d, i) {

                        // Transition on mouseover
                        d3.select(this)
                                .transition()
                                .duration(500)
                                .ease('elastic')
                                .attr('transform', function (d) {
                                    d.midAngle = ((d.endAngle - d.startAngle) / 2) + d.startAngle;
                                    var x = Math.sin(d.midAngle) * distance;
                                    var y = -Math.cos(d.midAngle) * distance;
                                    return 'translate(' + x + ',' + y + ')';
                                });

                        // Animate legend
                        $(element + ' [data-slice]').css({
                            'opacity': 0.3,
                            'transition': 'all ease-in-out 0.15s'
                        });
                        $(element + ' [data-slice=' + i + ']').css({'opacity': 1});
                    })
                    .on('mouseout', function (d, i) {

                        // Mouseout transition
                        d3.select(this)
                                .transition()
                                .duration(500)
                                .ease('bounce')
                                .attr('transform', 'translate(0,0)');

                        // Revert legend animation
                        $(element + ' [data-slice]').css('opacity', 1);
                    });

            // Animate chart on load
            arcPath
                    .transition()
                    .delay(function (d, i) {
                        return i * 500;
                    })
                    .duration(500)
                    .attrTween("d", function (d) {
                        var interpolate = d3.interpolate(d.startAngle, d.endAngle);
                        return function (t) {
                            d.endAngle = interpolate(t);
                            return arc(d);
                        };
                    });


            //
            // Append counter
            //

            // Append element
            d3Container
                    .append('h2')
                    .attr('class', 'mt-15 mb-5 text-semibold');

            // Animate counter
            d3Container.select('h2')
                    .transition()
                    .duration(1500)
                    .tween("text", function (d) {
                        var i = d3.interpolate(this.textContent, sum);

                        return function (t) {
                            this.textContent = d3.format(",d")(Math.round(i(t)));
                        };
                    });


            //
            // Append legend
            //

            // Add element
            var legend = d3.select(element)
                    .append('ul')
                    .attr('class', 'chart-widget-legend')
                    .selectAll('li').data(pie(data))
                    .enter().append('li')
                    .attr('data-slice', function (d, i) {
                        return i;
                    })
                    .attr('style', function (d, i) {
                        return 'border-bottom: 2px solid ' + d.data.color;
                    })
                    .text(function (d, i) {
                        return d.data.status + ': ';
                    });

            // Add value
            legend.append('span')
                    .text(function (d, i) {
                        return d.data.value;
                    });
        }
    });
    // $('.twbs-default').twbsPagination({
    //     totalPages: 20,
    //     visiblePages: 7,
    //     prev: 'Prev',
    //     first: null,
    //     last: null,
    //     onPageClick: function (event, page) {
    //         $('.twbs-content-default').text('Page ' + page);
    //     }
    // });
    function print_report(elem) {
        if (elem == 'dailycheck')
            url = site_url + "Dashboard/get_dailycheck_pagination";
        else if (elem == 'service_due')
            url = site_url + "Dashboard/get_service_due_pagination";
        else if (elem == 'operators')
            url = site_url + "Dashboard/get_operators_pagination";

        $.ajax({
            type: "POST",
            url: url,
            data: {print: 'yes', txt_date: $('#txt_date').val()},
            async: false,
            dataType: 'json',
            success: function (data) {
                //$('body').html(data);
                var mywindow = window.open('', 'PRINT', 'height=400,width=600');
                mywindow.document.write('<h1>' + document.title + '</h1>');
                mywindow.document.write(data);
                mywindow.document.close();
                mywindow.focus();
                mywindow.print();
                mywindow.close();
            }
        });
    }
</script>