<?php
$land_owner = $this->user_model->get_table_data('land_owner', array('is_buyer' => '0'));
// $dohs_options='<option value="">Please select a DOHS</option>';	  
// foreach($do as $d){ 
// 	$dohs_options.='<option value="'.$d['dohs'].'">'.$d['dohs'].'</option>';
// }
?>


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
<!--                            <li><a href="<?php echo base_url(); ?>admin">Manage User</a></li>-->
                            <li><!-- Link with dropdown items -->
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Manage Request</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li><a href="<?php echo base_url(); ?>admin/startedrequest"> Srarted Request</a></li>
                                    <li><a href="#"> Froward Request</a></li>
                                    <li><a href="#"> Success Request</a></li>
                                    <li><a href="#"> Failed Request</a></li>
                                </ul>
                            </li>			                
                            <li><a href="#">Message</a></li>
                        </ul>
                    </nav>       
                </div>
<!--                <div class="col-md-9">
                    <h4>Welcome <? echo $this->session->employee_name ?> ! manage user and request carefully.</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Inactive User</h4>
                            <table id="inactive-user" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Nid/Birth Certificate No</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($land_owner as $lo) {
                                        if ($lo['is_active'] == 0) {
                                            echo'<tr>';
                                            echo'<td>' . $lo['land_owner_name'] . '</td>';
                                            echo'<td>' . $lo['nid'] . '</td>';
                                            echo'<td>' . $lo['phone'] . '</td>';
                                            echo'<td>
				   							     <a class="btn-primary btn-sm" href="' . base_url() . 'admin/edit/' . $lo['land_owner_id'] . '">View/Update</a></td>';

                                            echo'</tr>';
                                        }
                                    }
                                    ?>				

                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <h4>Active User</h4>
                            <table id="active-user" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Nid/Birth Certificate No</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($land_owner as $lo) {
                                        if ($lo['is_active'] == 1) {
                                            echo'<tr>';
                                            echo'<td>' . $lo['land_owner_name'] . '</td>';
                                            echo'<td>' . $lo['nid'] . '</td>';
                                            echo'<td>' . $lo['phone'] . '</td>';
                                            echo'<td>
				   							     <a class="btn-primary btn-sm" href="' . base_url() . 'admin/edit/' . $lo['land_owner_id'] . '">View/Update</a></td>';

                                            echo'</tr>';
                                        }
                                    }
                                    ?>				

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            
                            <h4>Registration  wrong</h4>
                            <table id="reg-wrong" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Nid/Birth Certificate No</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($land_owner as $lo) {
                                        if ($lo['is_active'] == 2) {
                                            echo'<tr>';
                                            echo'<td>' . $lo['land_owner_name'] . '</td>';
                                            echo'<td>' . $lo['nid'] . '</td>';
                                            echo'<td>' . $lo['phone'] . '</td>';
                                            echo'<td>
				   							     <a class="btn-primary btn-sm" href="' . base_url() . 'admin/edit/' . $lo['land_owner_id'] . '">View/Update</a></td>';

                                            echo'</tr>';
                                        }
                                    }
                                    ?>				

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                             <div class="panel panel-default panel-table">
                                 <div class="panel-heading" style="background:#007bff;">
                                <div class="row">
                                    <div class="col col-xs-6">
                                        <h3 class="panel-title">Land wrong</h3>
                                    </div>
                                    <div class="col col-xs-6 text-right">
                                        <button data-toggle="toggle" type="button" class="btn btn-primary "><i class="glyphicon glyphicon-plus"></i>Expand</button>
                                    </div>
                                </div>
                            </div>
                                 end panne heading
                            
                            <div class="panel-body">
                            <table id="land-wrong" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Nid/Birth Certificate No</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($land_owner as $lo) {
                                        if ($lo['is_active'] == 3) {
                                            echo'<tr>';
                                            echo'<td>' . $lo['land_owner_name'] . '</td>';
                                            echo'<td>' . $lo['nid'] . '</td>';
                                            echo'<td>' . $lo['phone'] . '</td>';
                                            echo'<td>
				   							     <a class="btn-primary btn-sm" href="' . base_url() . 'admin/edit/' . $lo['land_owner_id'] . '">View/Update</a></td>';

                                            echo'</tr>';
                                        }
                                    }
                                    ?>				

                                </tbody>
                            </table>
                            </div> 
                            end pannel body
                             </div> 
                            end pannel table
                        </div>
                        
                        
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#active-user').DataTable();
        $('#inactive-user').DataTable();
        $('#reg-wrong').DataTable();
        $('#land-wrong').DataTable();
        
        
	
        
    });
</script>