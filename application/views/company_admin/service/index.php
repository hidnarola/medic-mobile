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
                <?php $this->load->view('company_admin/service/left') ?>
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
                            <i class="services-red"></i>
                            <h4>Urgent service need</h4>
                            <h6></h6>
                        </div>
                        <div class="srh-table">
                            <table class="table red-bdr">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Serial Number</th>
                                        <th>Branch</th>
                                        <th>Reason</th>
                                        <th>Error time</th>
                                        <th></th>
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
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>31.08.2017</td>
                                        <td>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="services-table">
                        <div class="services-table-head">
                            <i class="yellow-servcies"></i>
                            <h4>Service overdue</h4>
                            <h6></h6>
                        </div>
                        <div class="srh-table">
                            <table class="table yellow-bdr">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Serial Number</th>
                                        <th>Branch</th>
                                        <th>Reason</th>
                                        <th>Previous service</th>
                                        <th>Service due</th>
                                        <th></th>
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
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div data-toggle="tooltip" data-placement="left" title="Service counter overdue, contact service." class="td-tooltips"></div>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="services-table">
                        <div class="services-table-head">
                            <i class="yellow-servcies"></i>
                            <h4>Service upcoming next 30 days</h4>
                            <h6></h6>
                        </div>
                        <div class="srh-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Machine</th>
                                        <th>Serial Number</th>
                                        <th>Branch</th>
                                        <th>Reason</th>
                                        <th>Previous service</th>
                                        <th>Service due</th>
                                        <th></th>
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
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div data-toggle="tooltip" data-placement="left" title="Service counter overdue, contact service." class="td-tooltips"></div>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="srh-machine">
                                                <div class="track-icon"></div>
                                                <h4>91-BJD-1/35264</h4>
                                                <p>Group 1</p>
                                            </div>
                                        </td>
                                        <td>50-BBB-9/34935</td>
                                        <td>NIEUWEGEN</td>
                                        <td>Calendar interval</td>
                                        <td>01.08.2017</td>
                                        <td>31.08.2018</td>
                                        <td>
                                            <div class="srh-location-srh"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="show-services">
                            <a href="">SHOW FUTURE SERVICES</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>