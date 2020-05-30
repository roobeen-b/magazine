<?php
$header = "Follow Us"; 
    include 'inc/header.php';
    include 'inc/checklogin.php';
?>          
            
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php
                flashMessage();
            ?>
            <div class="page-title">
              <div class="title_left">               
                <h3>Follow Us</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Social-sites</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addFollowIcons()">Add Social-Sites</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-responsive table-striped table-bordered ">
                        <thead >
                          <th>S.N</th>
                          <th>Icon Name</th>
                          <th>URL</th>
                          <th>Icon</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php $FollowIcons = new follow();
                          $follows = $FollowIcons->getAllFollowIcons();
                            // debugger($follows,true);
                          if ($follows) {
                            foreach ($follows as $key => $follow) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><a href="<?php echo $follow->iconname;?>"><?php echo $follow->iconname;?></a></td>
                            <td><a href="<?php echo $follow->url;?>"><?php echo $follow->url;?></a></td>
                             
                            <td><a href="<?php echo $follow->url;?>"> <i class="<?php echo ('fa fa-'.strtolower($follow->iconname));?>"></i></a></td> 
                            <td>
                              <a href="javascript:;" class="btn btn-info" onclick="editFollowIcons(this);" data-follow_info='<?php echo(json_encode($follow))?>'>
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/follow?id=<?php echo($follow->id)?>&amp;act=<?php echo substr(md5("Delete-FollowIcons-".$follow->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this follow icon?');">
                                <i class="fa fa-trash"></i>
                              </a>
                            </td>
                          </tr>           
                          <?php
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                      
                      <div class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h4 class="modal-title" id="title">Add Social Icons</h4>
                            </div>
                            <form action="process/follow.php" method="post">
                              <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Icon Name</label>
                                    <input type="text" class="form-control" name="iconname" id="iconname" placeholder="Icon Name" required="" >
                                </div>
                                <div class="form-group">
                                    <label for="">URL</label>
                                    <input type="text" class="form-control" name="url" id="url" placeholder="URL Here" required="" >
                                </div>
                             </div>
                              <div class="modal-footer">
                                <input type="hidden" id="id" name="id">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>                
                            </form>      
                        </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php 
    include 'inc/footer.php';
?>
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">

  function addFollowIcons(){
    $('#sIcons').addClass('form-group');
    $('#title').html('Add Social-Icons');
    $('#iconname').val("");
    $('#url').val("");
    $('#id').removeAttr('value');
    showModal();
  }

  function editFollowIcons(element){
     console.log(element);
    var follow_info = $(element).data('follow_info');

    if (typeof(follow_info) != 'object'){
      follow_info = JSON.parse(follow_info);
    }
    // console.log(follow_info);
    $('#title').html('Edit Social Icons');
    $('#iconname').val(follow_info.iconname);
    $('#url').val(follow_info.url);
    $('#id').val(follow_info.id);
    showModal();  
  }


  function showModal(data=""){
    $('.modal').modal();
      }

</script>