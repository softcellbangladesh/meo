
<?php
$document_list = $this->user_model->get_primary_document();
?>


<div class="body-content">
    <div class="section history-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
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

                <div class="col-md-8">
                    <h3 class="text-center form-title">প্রাথমিক নথি জমা দিন</h3>

                    <form name="buyerForm" class="form-horizontal" id="buyerForm" role="form" method="post" enctype="multipart/form-data">
                        <table class="table table-bordered table-hover">
                            <?php
                            foreach ($document_list as $document):
                                ?>
                                <tr>
                                    <td> <label for="" class="col-10"><?php echo $document->document_name; ?></label></td>

                                    <td>  <input id="file"  type="file" class="form-control-file" name="images[]">
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        </table>
                        <div class="form-group row">
                            <div class="col-5">

                            </div>
                            <div class="col-4">
                                <button type="button" id="save" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#save').on('click', function(){
       
       alert("click");
  
        var fileInputs = $('.form-control-file');
        var formData = new FormData();
        $.each(fileInputs, function(i,fileInput){
            if( fileInput.files.length > 0 ){
                $.each(fileInput.files, function(k,file){
                    formData.append('images[]', file);
                });
            }
        });
        $.ajax({
            method: 'post',
            url:"<?php echo base_url(); ?>welcome/upload_primarydocumnet",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response);
            }
        });
    });


</script>