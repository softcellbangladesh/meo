
<?php
$important_list = $this->user_model->get_important_document();
// foreach($important_list as $row): 
//           echo '<pre>';
//           print_r($row);
//           echo '</pre>';
//    endforeach; 
?>
<div class="body-content">
    <div class="section history-page">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <nav id="sidebar">            
                        <!-- Sidebar Links -->
                        <ul class="list-unstyled components">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">My Profile</a></li>
                            <li><a href="<?php echo base_url(); ?>request">Add Flat</a></li>
                            <li class="active"><a href="<?php echo base_url(); ?>buyer">Add Buyer</a></li>
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
                <div class="col-md-10">

                    <h3 class="text-center form-title">গুরুত্বপূর্ণ প্রমাণপত্র জমা দিন</h3>

                    <form name="buyerForm" class="form-horizontal" id="buyerForm" role="form" method="post" enctype="multipart/form-data">
                        <table class="table table-bordered table-hover">
           
                            <tbody>
                            <?php foreach ($important_list as $importantdata): ?>
                            
                                <tr>
                                    <td style="width:70%">

                                        <label for="" ><?php echo $importantdata->document_name ?></label></td>

                                    <td style="width:30%"> 
                                        <input id="file" type="file" class="form-control-file" name="" placeholder="">

                                    </td>
                                </tr>

                                 
                            <?php endforeach ?>
                            </tbody>
                        </table>

                        <div class="form-group row">

                            <div class=" offset-5 col-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>