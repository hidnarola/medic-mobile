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

                    <div class="loader-crane-wrap">
                        <div class="loader-crane d-flex">
                            <h4>Loader crane stats</h4>
                            <h6></h6>
                            <a href="">See stats per machine »</a>
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
                                        <h4>Operation time</h4>
                                        <h3>11</h3>
                                        <h4>hours</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="loader-box-body">
                                        <h4>Idle machine</h4>
                                        <h3>14</h3>
                                        <h4>hours</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="loader-box-body">
                                        <h4>PTO on</h4>
                                        <h3>25</h3>
                                        <h4>hours</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="loader-box-body">
                                        <h4>>100 % capacity</h4>
                                        <h3>6</h3>
                                        <h4>cycles</h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>	

                    <div class="loader-crane-wrap">
                        <div class="loader-crane d-flex">
                            <h4>Demountable stats</h4>
                            <h6></h6>
                            <a href="">See stats per machine »</a>
                        </div>

                        <div class="loader-box loader-box-5">
                            <ul class="d-flex">
                                <li>
                                    <div class="loader-box-body">
                                        <h4>Operation time</h4>
                                        <h3>6</h3>
                                        <h4>hours</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="loader-box-body">
                                        <h4>Tipping</h4>
                                        <h3>102</h3>
                                        <h4>cycles</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="loader-box-body">
                                        <h4>Loading/Unloading</h4>
                                        <h3>105</h3>
                                        <h4>cycles</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="loader-box-body">
                                        <h4>Fast speed</h4>
                                        <h3>15</h3>
                                        <h4>cycles</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="loader-box-body">
                                        <h4>Remote control</h4>
                                        <h3>32</h3>
                                        <h4>cycles</h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>	

                    <div class="loader-table">
                        <h3>Loader crane machines</h3>
                        <div class="srh-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Operation time</th>
                                        <th>Stabilizer active</th>
                                        <th>PTO on time</th>
                                        <th>Idle time</th>
                                        <th>Driving time</th>
                                        <th>Driving distance</th>
                                        <th>Total cycles</th>
                                        <th>Cycles >100 % capacity</th>
                                        <th>Avg. capacity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                        <td>52%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                        <td>52%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                        <td>52%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                        <td>52%</td>
                                    </tr>
                                    <tr>
                                        <td class="average-td">
                                            <div class="srh-machine">
                                                <h4>Average</h4>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                        <td>52%</td>
                                    </tr>
                                    <tr>
                                        <td class="average-td">
                                            <div class="srh-machine">
                                                <h4>TOTAL</h4>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                        <td>52%</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="loader-table">
                        <h3>Demountable machines</h3>
                        <div class="srh-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Operation time</th>
                                        <th>Total cycles</th>
                                        <th>Driving time</th>
                                        <th>Driving distance</th>
                                        <th>Tipping cycles</th>
                                        <th>Loading/Unloading cycles</th>
                                        <th>Fast speed cycles</th>
                                        <th>Remote control cycles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td class="average-td">
                                            <div class="srh-machine">
                                                <h4>Average</h4>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td class="average-td">
                                            <div class="srh-machine">
                                                <h4>TOTAL</h4>
                                            </div>
                                        </td>
                                        <td>3,1 h</td>
                                        <td>1,6 h</td>
                                        <td>6,4 h</td>
                                        <td>1,2 h</td>
                                        <td>0,5 h</td>
                                        <td>8,5 km</td>
                                        <td>68</td>
                                        <td>3</td>
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