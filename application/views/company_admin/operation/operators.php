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

                    <div class="services-table">
                        <div class="loader-crane d-flex">
                            <h4>Operator stats</h4>
                            <h6></h6>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Today </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>

                        <div class="operator-wrap">
                            <ul class="d-flex">
                                <li>
                                    <div class="operator-box">
                                        <p>Operation stars</p>
                                        <h4> <span>248</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" 	x="0px" y="0px" width="33px" height="33px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
                                            <g id="star">
                                            <polygon points="255,402.212 412.59,497.25 370.897,318.011 510,197.472 326.63,181.738 255,12.75 183.371,181.738 0,197.472     139.103,318.011 97.41,497.25   " fill="#ecc200"/>
                                            </g>
                                            </svg>
                                        </h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="operator-box">
                                        <p>Operator safety</p>
                                        <h4> <span>24</span> 
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
                                            <g id="check-circle-blank">
                                            <path d="M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z" fill="#a3bd0b"/>
                                            </g>
                                            </svg> 
                                        </h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="operator-box">
                                        <p>Average lifts per day</p>
                                        <h4><span>34.23</span> </h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="operator-box">
                                        <p>Average customers per day</p>
                                        <h4><span>11.6</span> </h4>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="srh-table">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Operator</th>
                                        <th>Operation</th>
                                        <th>Safety</th>
                                        <th>Avg. lifts per day</th>
                                        <th>Avg. customers per day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4><a data-toggle="modal" data-target="#individual-overview">John Doe</a></h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-icon"></i> </td>
                                        <td><i class="circle-icon green"></i> </td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-iocn"></i> </td>
                                        <td> <i class="circle-icon red"></i> </td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-iocn"></i></td>
                                        <td><i class="circle-icon yellow"></i></td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-icon"></i></td>
                                        <td><i class="circle-icon green"></i></td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-iocn"></i></td>
                                        <td><i class="circle-icon red"></i></td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-iocn"></i></td>
                                        <td><i class="circle-icon yellow"></i></td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-icon"></i></td>
                                        <td><i class="circle-icon green"></i></td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-iocn"></i></td>
                                        <td><i class="circle-icon red"></i></td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="user-icon"></div>
                                                <h4>John Doe</h4>
                                            </div>
                                        </td>
                                        <td> 40 <i class="star-iocn"></i></td>
                                        <td><i class="circle-icon yellow"></i></td>
                                        <td>26,66</td>
                                        <td>4,25</td>
                                    </tr>
                                </tbody>
                            </table>
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
            <div class="close-div">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> Close </span></button>
            </div>	
            <div class="user-popup">
                <span></span>
                <h3>John Doe</h3>
                <p>Operating truck 91-BJD-1/35264</p>
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
                                        <td>Last truck operated</td>
                                        <td>91-BJD-1/35264</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Operator ID</td>
                                        <td>83377</td>
                                    </tr>
                                    <tr>
                                        <td>Detail #4</td>
                                        <td>-</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Detail #5</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Detail #6</td>
                                        <td>-</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>	
            <div class="popup-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li><a class="active" id="popuphome-tab" data-toggle="tab" href="#popuphome" role="tab" aria-controls="home" aria-selected="true">Home</a></li>
                    <li><a id="popupoperations-tab" data-toggle="tab" href="#popupoperations" role="tab" aria-controls="profile" aria-selected="false">Operations</a></li>
                    <li><a id="popupsafety-tab" data-toggle="tab" href="#popupsafety" role="tab" aria-controls="contact" aria-selected="false">Safety</a></li>
                    <li><a id="popuptrends-tab" data-toggle="tab" href="#popuptrends" role="tab" aria-controls="profile" aria-selected="false">Trends</a></li>
                    <li><a id="popupmap-tab" data-toggle="tab" href="#popupmap" role="tab" aria-controls="contact" aria-selected="false">Map</a></li>
                    <li><a id="popupnotifications-tab" data-toggle="tab" href="#popupnotifications" role="tab" aria-controls="contact" aria-selected="false">Notifications</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="popuphome" role="tabpanel" aria-labelledby="popuphome-tab">
                        <div class="operation-saferty">
                            <ul>
                                <li>
                                    <h3>Operation</h3>
                                    <span>46</span> <i class="star-icon"></i>
                                </li>
                                <li>
                                    <h3>Safety</h3>
                                    <i class="circle-icon green"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="active-notification">
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
                        <div class="loader-crane-wrap popup-overview-btm">
                            <div class="loader-crane d-flex">
                                <h4>Operator stats</h4>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Today </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="loader-box">
                                <ul class="d-flex">
                                    <li>
                                        <div class="loader-box-body">
                                            <h4>Operator warnings</h4>
                                            <h3>4</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="loader-box-body">
                                            <h4>Safety critical count</h4>
                                            <h3>1</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="loader-box-body">
                                            <h4>Operator time</h4>
                                            <h3>4.5</h3>
                                            <h4>hours</h4>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="loader-box-body">
                                            <h4>Distance traveled</h4>
                                            <h3>11.6</h3>
                                            <h4>kilometers</h4>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="popupoperations" role="tabpanel" aria-labelledby="popupoperations-tab">
                        <div class="loader-crane d-flex">
                            <h4>Stars earned</h4>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Today </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="operation-saferty">
                            <ul>
                                <li>
                                    <h3>Efficiency</h3>
                                    <span>23</span> <i class="star-icon"></i>
                                </li>
                                <li>
                                    <h3>Smooth driving</h3>
                                    <span>23</span> <i class="star-icon"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="active-notification">
                            <div class="active-notification-inr">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                        <tr>
                                            <td><i class="star-icon"></i> <strong>Efficiency</strong> </td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>	
                        </div>
                    </div>
                    <div class="tab-pane fade" id="popupsafety" role="tabpanel" aria-labelledby="popupsafety-tab">
                        <div class="loader-crane d-flex">
                            <h4>Safety points</h4>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Today </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="safety-count">
                            <h2>Safety</h2>
                            <span>3</span>
                            <ul>
                                <li><i class="circle-icon green"></i> 0–10</li>
                                <li><i class="circle-icon yellow"></i> 10–20</li>
                                <li><i class="circle-icon red"></i> 20-> </li>
                            </ul>
                        </div>
                        <div class="active-notification">
                            <div class="active-notification-inr">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stability and structural abuse</strong> </td>
                                            <td>1</td>
                                            <td>3.6.2017</td>
                                            <td>91-BJD-1/35264 <div class="srh-location-srh"></div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>	
                        </div>
                    </div>
                    <div class="tab-pane fade" id="popuptrends" role="tabpanel" aria-labelledby="popuptrends-tab">
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
                            <img src="images/graph.jpg" alt="" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="popupmap" role="tabpanel" aria-labelledby="popupmap-tab">05</div>
                    <div class="tab-pane fade" id="popupnotifications" role="tabpanel" aria-labelledby="popupnotifications-tab">06</div>
                </div>
            </div>	
        </div>
    </div>
</div>