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
                                    <div class="map" id="map" style="height: 540px">
                                        <img src="assets/images/map.jpg" alt="" />
                                    </div>

                                    <div id="accordion" class="map-accordion">
                                        <h2>MY FLEET (<?php echo count($vehicle_latlong); ?>) <i></i></h2>
                                        <!--                                        <div class="card">
                                                                                    <div class="card-header" id="headingOne">
                                                                                        <div data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"  class="collapsed">
                                                                                            <div class="card-header-body">
                                                                                                <div class="card-header-img"><i></i></div>
                                                                                                <h3>50-BBB-9/34935 <br/> 2 products</h3>
                                                                                                <p>Operator: John Doe</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
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
                                                                                </div>-->
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
                        <span class="bdr-red">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="44" viewBox="0 0 53 34">
                            <g fill="none" fill-rule="evenodd">
                            <path fill="#989898" d="M48.818 10.793H38.159V22.8H.231v4.332c0 2.052 1.7 3.724 3.785 3.724h2.549a4.562 4.562 0 0 0 4.325 3.117c2.009 0 3.785-1.292 4.326-3.117h25.258a4.562 4.562 0 0 0 4.326 3.117c2.008 0 3.785-1.292 4.326-3.117H52.448V14.441c.155-1.976-1.545-3.648-3.63-3.648zM10.968 32.53c-1.776 0-3.166-1.369-3.166-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.39 3.117-3.167 3.117zm33.988 0c-1.777 0-3.167-1.369-3.167-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.468 3.117-3.167 3.117zm6.256-11.325h-2.549v-4.636h2.55v4.636zm0-6.004H48.2c-.54 0-.927.38-.927.912v5.548c0 .532.386.912.927.912h3.012v6.84h-1.7c0-2.508-2.007-4.484-4.556-4.484-2.55 0-4.558 1.976-4.558 4.484H15.526c0-2.508-2.008-4.484-4.557-4.484-2.55 0-4.558 1.976-4.558 4.484H4.017c-1.313 0-2.395-1.064-2.395-2.356v-3.04h37.85V12.085h9.268c1.314 0 2.395 1.064 2.395 2.356l.077.76z"/>
                            <path fill="#FFF" d="M29.97 21.737H4.248V9.12H29.97v12.617zM5.64 20.445H28.58v-9.88H5.639v9.88z"/>
                            <path fill="#D52B1F" d="M37.463 21.737V7.068L28.58 1.672 16.298.152v5.7L12.9 9.12h2.008l2.008-2.052 2.24 2.052h2.163L17.766 5.7l.077-3.952 10.35 1.672 6.335 5.7v12.617z"/>
                            <ellipse cx="10.969" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                            <ellipse cx="44.956" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                            </g>
                            </svg>

                        </span>
                        <h3>91-BJD-1/35264</h3>
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
                            <li><a class="active" id="popuphome-tab" data-toggle="tab" href="#popuphome" role="tab" aria-controls="home" aria-selected="true">Overview</a></li>
                            <li><a id="popupoperations-tab" data-toggle="tab" href="#popupoperations" role="tab" aria-controls="profile" aria-selected="false">Trends</a></li>
                            <li><a id="popupsafety-tab" data-toggle="tab" href="#popupsafety" role="tab" aria-controls="contact" aria-selected="false">Map</a></li>
                            <li><a id="popupmap-tab" data-toggle="tab" href="#popupmap" role="tab" aria-controls="contact" aria-selected="false">Service</a></li>
                            <li><a id="popupnotifications-tab" data-toggle="tab" href="#popupnotifications" role="tab" aria-controls="contact" aria-selected="false">Notifications</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="popuphome" role="tabpanel" aria-labelledby="popuphome-tab">
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
                            <div class="tab-pane fade" id="popupsafety" role="tabpanel" aria-labelledby="popupsafety-tab">
                                <div class="today-count">
                                    <span>19.8.</span>
                                    <span>20.8.</span>
                                    <span>21.8.</span>
                                    <span>22.8.</span>
                                    <span>23.8.</span>
                                    <span>24.8.</span>
                                    <strong>TODAY</strong>
                                </div>
                                <div class="map">
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
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE19qNQTlcPGeOthK32NgAUo1xoiks_-Y&callback=initMap"></script>			
<script type="text/javascript">
    //--Custom scorllbar
    $("#content-8").mCustomScrollbar({
        axis: "y"
    });

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
//            zoom: 16,
            zoom: 16,
            center: new google.maps.LatLng(vehicle_latlong[0]),
//            mapTypeId: 'satellite'
            //        styles: [
            //   {
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#f5f5f5"
            //       }
            //     ]
            //   },
            //   {
            //     "elementType": "labels.icon",
            //     "stylers": [
            //       {
            //         "visibility": "off"
            //       }
            //     ]
            //   },
            //   {
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#616161"
            //       }
            //     ]
            //   },
            //   {
            //     "elementType": "labels.text.stroke",
            //     "stylers": [
            //       {
            //         "color": "#f5f5f5"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "administrative.land_parcel",
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#bdbdbd"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "poi",
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#eeeeee"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "poi",
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#757575"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "poi.park",
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#e5e5e5"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "poi.park",
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#9e9e9e"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "road",
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#ffffff"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "road.arterial",
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#757575"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "road.highway",
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#dadada"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "road.highway",
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#616161"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "road.local",
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#9e9e9e"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "transit.line",
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#e5e5e5"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "transit.station",
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#eeeeee"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "water",
            //     "elementType": "geometry",
            //     "stylers": [
            //       {
            //         "color": "#c9c9c9"
            //       }
            //     ]
            //   },
            //   {
            //     "featureType": "water",
            //     "elementType": "labels.text.fill",
            //     "stylers": [
            //       {
            //         "color": "#9e9e9e"
            //       }
            //     ]
            //   }
            // ]
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
                icon: pinImage,
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
            var content = '<div>' +
                    '<label><b>Track</b> : ' + vehicle_data[key]['deviceGUID'] + '</label>' +
                    '<ul style="padding-left:16px;margin-bottom:0px">' +
                    '<li style="padding:3px"><b><a href="' + site_url + "track/vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + last_hour + '" style="color:#000">Last Hour</a></b></li>' +
                    '<li style="padding:3px"><b><a href="' + site_url + "track/vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + last_two_hour + '" style="color:#000">Last 2 Hours</a></b></li>' +
                    '<li style="padding:3px"><b><a href="' + site_url + "track/vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + last_three_hour + '" style="color:#000">Last 3 Hours</a></b></li>' +
                    '<li style="padding:3px"><b><a href="' + site_url + "track/vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + today + '" style="color:#000">Today</a></b></li>' +
                    '<li style="padding:3px"><b><a href="' + site_url + "track/vehicle/" + vehicle_data[key]['deviceGUID'] + "/" + yesterday + '" style="color:#000">Yesterday</a></b></li>' +
                    '<li style="padding:3px"><b><a href="javascript:void(0)" onClick="open_custom_timeframe_modal(\'' + vehicle_data[key]['deviceGUID'] + '\')" style="color:#000">Custom</a></b></li>' +
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
    function open_custom_timeframe_modal(deviceGUID) {
        $('#txt_deviceGUID').val(deviceGUID);
        $('#custom_timeframe_modal').modal('show');
    }
</script>