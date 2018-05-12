<div class="body-content">
    <div class="section history-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <nav id="sidebar">            
                        <!-- Sidebar Links -->
                        <ul class="list-unstyled components">
                            <li class="active"><a href="#">Dashboard</a></li>
                            <li><a href="#">My Profile</a></li>
                            <li><a href="<?php echo base_url(); ?>request">Add Flat</a></li>
                            <li><a href="<?php echo base_url(); ?>buyer">Add Buyer</a></li>
                           <li class="active"><a href="<?php echo base_url(); ?>primarydoc">Add Primary Document</a></li>
                            <li><a href="<?php echo base_url(); ?>document">Add document</a></li>
                            <li><!-- Link with dropdown items -->
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Request Status</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li><a href="#"> All Request</a></li>
                                    <li><a href="#"> Ongoing Request</a></li>
                                    <li><a href="#"> Success Request</a></li>
                                    <li><a href="#"> Failed Request</a></li>
                                </ul>
                            </li>			                
                            <li><a href="#">Message</a></li>
                        </ul>
                    </nav>       
                </div>
                <div class="col-md-9">
                    <h4>Welcome <? echo $this->session->land_owner_name ?> ! now you can request for plot or flat transfer.</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Current Process</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>header</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Successfull Process</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>header</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Edit Process</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>header</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Failed Process</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>header</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>data</td>
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