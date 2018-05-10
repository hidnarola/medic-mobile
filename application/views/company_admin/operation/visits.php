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
                                <a href="service-history.html">
                                    <i></i>
                                    <span>E-MAIL</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="services-table">
                        <div class="services-table-head">
                            <h4>Visits</h4>
                            <h6></h6>
                        </div>
                        <div class="srh-table table-accordion">
                            <table class="table" id="accordion">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Operator</th>
                                        <th>Total stops</th>
                                        <th>Stops over 1 hour</th>
                                        <th>Operating time</th>
                                        <th>Idle time</th>
                                        <th>Cycles</th>
                                        <th>Notifications</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="9">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <table data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <tbody>
                                                        <td>
                                                            <div class="srh-machine">
                                                                <div class="track-icon"></div>
                                                                <h4>91-BJD-1/35264</h4>
                                                                <p>Group 1</p>
                                                            </div>
                                                        </td>
                                                        <td>John Doe</td>
                                                        <td>10</td>
                                                        <td>3</td>
                                                        <td>8.51 h</td>
                                                        <td>1.21 h</td>
                                                        <td>38</td>
                                                        <td>2</td>
                                                        <td>SEE<br/>STOPS</td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <th>Total time</th>
                                                                    <th>Entry time</th>
                                                                    <th>Exit time</th>
                                                                    <th>Operating time</th>
                                                                    <th>Idle time</th>
                                                                    <th>Cycles</th>
                                                                    <th>Notifications</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>	
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>	
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <div class="card">
                                                <div class="card-header" id="headingtwo">
                                                    <table data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                                        <tbody>
                                                        <td>
                                                            <div class="srh-machine">
                                                                <div class="track-icon"></div>
                                                                <h4>91-BJD-1/35264</h4>
                                                                <p>Group 1</p>
                                                            </div>
                                                        </td>
                                                        <td>John Doe</td>
                                                        <td>10</td>
                                                        <td>3</td>
                                                        <td>8.51 h</td>
                                                        <td>1.21 h</td>
                                                        <td>38</td>
                                                        <td>2</td>
                                                        <td>SEE<br/>STOPS</td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="collapsetwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <th>Total time</th>
                                                                    <th>Entry time</th>
                                                                    <th>Exit time</th>
                                                                    <th>Operating time</th>
                                                                    <th>Idle time</th>
                                                                    <th>Cycles</th>
                                                                    <th>Notifications</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>	
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>	
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <div class="card">
                                                <div class="card-header" id="headingthree">
                                                    <table data-toggle="collapse" data-target="#collapsethree" aria-expanded="true" aria-controls="collapsethree">
                                                        <tbody>
                                                        <td>
                                                            <div class="srh-machine">
                                                                <div class="track-icon"></div>
                                                                <h4>91-BJD-1/35264</h4>
                                                                <p>Group 1</p>
                                                            </div>
                                                        </td>
                                                        <td>John Doe</td>
                                                        <td>10</td>
                                                        <td>3</td>
                                                        <td>8.51 h</td>
                                                        <td>1.21 h</td>
                                                        <td>38</td>
                                                        <td>2</td>
                                                        <td>SEE<br/>STOPS</td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <th>Total time</th>
                                                                    <th>Entry time</th>
                                                                    <th>Exit time</th>
                                                                    <th>Operating time</th>
                                                                    <th>Idle time</th>
                                                                    <th>Cycles</th>
                                                                    <th>Notifications</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>	
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>	
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <div class="card">
                                                <div class="card-header" id="headingfour">
                                                    <table data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapsethree">
                                                        <tbody>
                                                        <td>
                                                            <div class="srh-machine">
                                                                <div class="track-icon"></div>
                                                                <h4>91-BJD-1/35264</h4>
                                                                <p>Group 1</p>
                                                            </div>
                                                        </td>
                                                        <td>John Doe</td>
                                                        <td>10</td>
                                                        <td>3</td>
                                                        <td>8.51 h</td>
                                                        <td>1.21 h</td>
                                                        <td>38</td>
                                                        <td>2</td>
                                                        <td>SEE<br/>STOPS</td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <th>Total time</th>
                                                                    <th>Entry time</th>
                                                                    <th>Exit time</th>
                                                                    <th>Operating time</th>
                                                                    <th>Idle time</th>
                                                                    <th>Cycles</th>
                                                                    <th>Notifications</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>	
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>	
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <div class="card">
                                                <div class="card-header" id="headingfive">
                                                    <table data-toggle="collapse" data-target="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                                                        <tbody>
                                                        <td>
                                                            <div class="srh-machine">
                                                                <div class="track-icon"></div>
                                                                <h4>91-BJD-1/35264</h4>
                                                                <p>Group 1</p>
                                                            </div>
                                                        </td>
                                                        <td>John Doe</td>
                                                        <td>10</td>
                                                        <td>3</td>
                                                        <td>8.51 h</td>
                                                        <td>1.21 h</td>
                                                        <td>38</td>
                                                        <td>2</td>
                                                        <td>SEE<br/>STOPS</td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <th>Total time</th>
                                                                    <th>Entry time</th>
                                                                    <th>Exit time</th>
                                                                    <th>Operating time</th>
                                                                    <th>Idle time</th>
                                                                    <th>Cycles</th>
                                                                    <th>Notifications</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="srh-machine">
                                                                            <div class="placeholder-icon"></div>
                                                                            <h4>STOP 1: Westham road<br/> 234, Warminster</h4>
                                                                        </div>
                                                                    </td>
                                                                    <td>0.11 h</td>
                                                                    <td>8.45</td>
                                                                    <td>8.51</td>
                                                                    <td>0.08 h</td>
                                                                    <td>0.03 h</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td>
                                                                        <div class="srh-location-srh"></div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>	
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>	
                                        </td>
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