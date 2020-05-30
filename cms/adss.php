
  
<?php 
$header = "Ad";
include 'inc/header.php'; ?>
<?php include 'inc/checklogin.php'; ?>

<!-- <?php
  $action = "Add";
  if($_GET){
    if (isset($_GET['id']) && !empty($_GET['id'])) {
      $ad_id = (int)$_GET['id'];
      if ($ad_id) {
        $act = substr(md5("Edit-Ad-".$ad_id.$_SESSION['token']), 3, 15);
        if ($act == $_GET['act']) {
          $Ad = new ad();
          $ad_info = $Ad->getAdbyId($ad_id);
          if ($ad_info) {
            $ad_info = $ad_info[0];
            $action = "Edit";
          }
        }
      }
    }
  }
?> -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Ad</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Ads</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="javascript:;" class="btn btn-primary" onclick="addAd();">Add Ad</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <th>S.N</th>
                        <th>URL</th>
                        <th>Ad Type</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $Ad = new ad();
                          $Ads = $Ad->getAllAd();
                           //debugger($Ads, true);
                          if ($Ads) {
                            foreach ($Ads as $key => $ad) {
                        ?>
                        <tr>
                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $ad->url; ?></td>
                          <td><?php echo $ad->adType; ?></td>
                          <?php 
                            if (isset($ad->image) && !empty($ad->image) && file_exists(UPLOAD_PATH."ad/".$ad->image)) {
                              $thumbnail = UPLOAD_URL.'ad/'.$ad->image;
                          }else{
                              $thumbnail = UPLOAD_URL.'noimg.jpg';
                        }
                           ?>
                           <td>
                            <img src="<?php echo($thumbnail) ?>" alt="" style="width: 300px;height: auto;"></td>
                          
  
                         <td>
                            <a href="javascript:;" class="btn btn-info" onclick="editAd(this);" data-ad_info='<?php echo(json_encode($ad)) ?>'>
                              <i class="fa fa-edit"></i>
                            </a>
                            <a href="process/ad?id=<?php echo($ad->id) ?>&amp;act=<?php echo substr(md5("Delete-Ad-".$ad->id.$_SESSION['token']), 3,15) ?>" onclick="return confirm('Are you sure you want to delete this ad?');" class="btn btn-danger">
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="title">Add Ad</h4>
                          </div>
                          <form action="process/ad" method="post">
                            
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="">AdType</label><br>
                                <input type="radio" name="adType" id="adType1" value="widead">Wide-ad<br>
         
                                <input type="radio" name="adType" id="adType2" value="simplead">Simple-ad
                              </div>
                               <div class="form-group">
                                  <label for="url">Ad's URL</label>
                                  <input type="text" id="url" class="form-control" name="url" placeholder="Give redirection URL">
                                </div>
                              <div class="form-group">
                                <label for="">Ad image</label>
                                <input type="file" id="image" name="image" accept="image/*">
                              </div>
<!--                               <?php 
                                if (isset($ad->image) && !empty($ad->image) && file_exists(UPLOAD_PATH."ad/".$ad->image)) {
                                  $thumbnail = UPLOAD_URL.'ad/'.$ad->image;
                                }else{
                                  $thumbnail = UPLOAD_URL.'noimg.jpg';
                                }
                               ?> -->
                             <div class="form-group">
                                <img src="" id="thumbnail" style = "width: 300px; height: auto;">
                               </div>

                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="old_img" id="old_img" value="<?php echo (isset($ad_info->image) && !empty($ad_info->image))?$ad_info->image:"" ?>">
                                <input type="hidden" id="id" name="id">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save Changes</button>
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
  <?php include 'inc/footer.php'; ?>
  <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
  <script src="assets/js/datatable.js"></script>
  <script type="text/javascript">
    function addAd(){
      $('#title').html('Add Ad');
      $('#adname').val("");
      $('#id').removeAttr('value');
      showModal();
    }

    function editAd(element){
      var ad_info = $(element).data('ad_info');
      if (typeof(ad_info) != 'object') {
        ad_info=JSON.parse(ad_info);
      }
      console.log(ad_info);
      $('#title').html('Edit Ad');
      $('#id').val(ad_info.id);
      $('#url').val(ad_info.url);
      $('#adType').val(ad_info.adType);
     // $('#image').val(ad_info.image);

      showModal();
    }

    function showModal(data=""){
      $('.modal').modal();
    }



      document.getElementById("image").onchange = function(){
        var reader = new FileReader();

        reader.onload = function (e){
          //Get loaded data and render thumbnail
          document.getElementById("thumbnail").src = e.target.result;
        };

          //Read image file as a dara URL
          reader.readAsDataURL(this.files[0]);
    };
  </script>