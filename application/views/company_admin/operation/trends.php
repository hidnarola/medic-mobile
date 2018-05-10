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
                                <a href="service-history.html" data-toggle="modal" data-target="#exampleModal">
                                    <i></i>
                                    <span>E-MAIL</span>
                                </a>
                            </li>
                        </ul>
                    </div>
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
                            <li>
                                <label>Select style</label>
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
                </div>
            </div>
        </div>
    </div>	
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="trends-choose">
                <h4>To see trends, select product</h4>
                <ul>
                    <li>
                        <div class="trends-choose-box">
                            <a href="">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="53" height="34" viewBox="0 0 53 34">
                                    <g fill="none" fill-rule="evenodd">
                                    <path fill="#989898" d="M48.818 10.793H38.159V22.8H.231v4.332c0 2.052 1.7 3.724 3.785 3.724h2.549a4.562 4.562 0 0 0 4.325 3.117c2.009 0 3.785-1.292 4.326-3.117h25.258a4.562 4.562 0 0 0 4.326 3.117c2.008 0 3.785-1.292 4.326-3.117H52.448V14.441c.155-1.976-1.545-3.648-3.63-3.648zM10.968 32.53c-1.776 0-3.166-1.369-3.166-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.39 3.117-3.167 3.117zm33.988 0c-1.777 0-3.167-1.369-3.167-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.468 3.117-3.167 3.117zm6.256-11.325h-2.549v-4.636h2.55v4.636zm0-6.004H48.2c-.54 0-.927.38-.927.912v5.548c0 .532.386.912.927.912h3.012v6.84h-1.7c0-2.508-2.007-4.484-4.556-4.484-2.55 0-4.558 1.976-4.558 4.484H15.526c0-2.508-2.008-4.484-4.557-4.484-2.55 0-4.558 1.976-4.558 4.484H4.017c-1.313 0-2.395-1.064-2.395-2.356v-3.04h37.85V12.085h9.268c1.314 0 2.395 1.064 2.395 2.356l.077.76z"/>
                                    <path fill="#FFF" d="M29.97 21.737H4.248V9.12H29.97v12.617zM5.64 20.445H28.58v-9.88H5.639v9.88z"/>
                                    <path fill="#D52B1F" d="M37.463 21.737V7.068L28.58 1.672 16.298.152v5.7L12.9 9.12h2.008l2.008-2.052 2.24 2.052h2.163L17.766 5.7l.077-3.952 10.35 1.672 6.335 5.7v12.617z"/>
                                    <ellipse cx="10.969" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                                    <ellipse cx="44.956" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                                    </g>
                                    </svg>
                                </i>
                                <p>Loader Cranes</p>
                            </a>	
                        </div>
                    </li>
                    <li>
                        <div class="trends-choose-box">
                            <a href="">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="53" height="34" viewBox="0 0 53 34">
                                    <g fill="none" fill-rule="evenodd">
                                    <path fill="#989898" d="M48.818 10.793H38.159V22.8H.231v4.332c0 2.052 1.7 3.724 3.785 3.724h2.549a4.562 4.562 0 0 0 4.325 3.117c2.009 0 3.785-1.292 4.326-3.117h25.258a4.562 4.562 0 0 0 4.326 3.117c2.008 0 3.785-1.292 4.326-3.117H52.448V14.441c.155-1.976-1.545-3.648-3.63-3.648zM10.968 32.53c-1.776 0-3.166-1.369-3.166-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.39 3.117-3.167 3.117zm33.988 0c-1.777 0-3.167-1.369-3.167-3.117s1.39-3.116 3.167-3.116c1.776 0 3.167 1.368 3.167 3.116s-1.468 3.117-3.167 3.117zm6.256-11.325h-2.549v-4.636h2.55v4.636zm0-6.004H48.2c-.54 0-.927.38-.927.912v5.548c0 .532.386.912.927.912h3.012v6.84h-1.7c0-2.508-2.007-4.484-4.556-4.484-2.55 0-4.558 1.976-4.558 4.484H15.526c0-2.508-2.008-4.484-4.557-4.484-2.55 0-4.558 1.976-4.558 4.484H4.017c-1.313 0-2.395-1.064-2.395-2.356v-3.04h37.85V12.085h9.268c1.314 0 2.395 1.064 2.395 2.356l.077.76z"/>
                                    <path fill="#FFF" d="M29.97 21.737H4.248V9.12H29.97v12.617zM5.64 20.445H28.58v-9.88H5.639v9.88z"/>
                                    <path fill="#D52B1F" d="M37.463 21.737V7.068L28.58 1.672 16.298.152v5.7L12.9 9.12h2.008l2.008-2.052 2.24 2.052h2.163L17.766 5.7l.077-3.952 10.35 1.672 6.335 5.7v12.617z"/>
                                    <ellipse cx="10.969" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                                    <ellipse cx="44.956" cy="29.489" fill="#989898" rx="1.468" ry="1.444"/>
                                    </g>
                                    </svg>
                                </i>
                                <p>Demountables</p>
                            </a>	
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>