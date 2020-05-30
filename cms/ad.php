<?php
$header = "Ad"; 
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
          <h3>Ad</h3>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>List of Ads</h2>

              <ul class="nav navbar-right panel_toolbox">
                <a href="#" class="btn btn-primary" onclick="addAd()">Add Ad</a>
              </ul>

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-responsive table-striped table-bordered ">
                  <thead >
                    <th>S.N</th>
                    <th>URL</th>
                    <th>AdType</th>
                    <th>Image</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php $Ad = new ad();
                    $ads = $Ad->getAllAd();
                      // debugger($ads,true);
                    if ($ads) {
                      foreach ($ads as $key => $ad) {
                    ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><a href="<?php echo $ad->url;?>"><?php echo $ad->url;?></a></td>
                      <td><?php echo $ad->adType;?></td>
                      <?php
                          if(isset($ad->image) && !empty($ad->image) && file_exists(UPLOAD_PATH."ad/".$ad->image)){
                            $thumbnail = UPLOAD_URL.'ad/'.$ad->image;
                          }else{
                            $thumbnail = UPLOAD_URL.'noimg.jpg';
                          }
                      ?>
                      <td><img class="img-responsive" src="<?php echo($thumbnail) ?>"alt="" style="width: 300px; height: auto"></td>
                      
                      <td>
                        <a href="javascript:;" class="btn btn-info" onclick="editAd(this); " data-ad_info='<?php echo(json_encode($ad))?>'>
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="process/ad?id=<?php echo($ad->id)?>&amp;act=<?php echo substr(md5("Delete-Ad-".$ad->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ad?');">
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
                        <h4 class="modal-title" id="title">Add Ad</h4>
                      </div>
                      <form action="process/ad.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="">URL</label>
                              <input type="text" class="form-control" name="url" id="url" placeholder="url" required="" >
                          </div>
                          <div class="form-group" id=abc>
                            <label for="">AdType</label><br>
                            <input type="radio"  name="adType" id="type1" value="Simplead" >  Simple Ad<br>
                            <input type="radio"  name="adType" id="type2" value="Widead" >  Wide Ad<br>
                          </div>
                          <div class="form-group">
                            <label for="">Image</label>
                            <input type="file"  name="image" id="image" accept="image/*">
                          </div>
                          <div class="form-group" id="imgid">       
                            <img class="img-responsive" src="" style="width: 300px; height: auto;" id="thumbnail">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($ad_image->id) && !empty($ad_image->id))?"$ad_image->id":""?>">
                          <input type="hidden" id="id" name="id">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="sumbit" class="btn btn-primary">Save changes</button>
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
<script type="text/javascript">
  var ab = " Ad-20200530112306am554.png ";
</script>
<?php $abc = "<script>document.writeln(ab);</script>" ?>
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">

  function addAd(){
    $('#ed').addClass('form-group');
    $('#title').html('Add Ad');
    $('#url').val("");
    $('#id').removeAttr('value');
    $('#type1').removeAttr('checked');
    $('#type2').removeAttr('checked');
    //for insert image duing add ads
    var path = "<?php echo UPLOAD_URL?>insert.jpg";
    $('#imgid img').attr("src",path);
    showModal();
  }

  function editAd(element){
     console.log(element);
    var ad_info = $(element).data('ad_info');

    if (typeof(ad_info) != 'object'){
      ad_info = JSON.parse(ad_info);
    }
    // console.log(ad_info);
    $('#title').html('Edit Ad');
    $('#url').val(ad_info.url);
    $('#id').val(ad_info.id);
    if (ad_info.type=="Simple") {
      $('#type1').prop("checked",true);
    }if(ad_info.type=="Wide"){     
      $('#type2').prop("checked",true);
    }
    //to show previously added image
    var string='';
    var image_id = ad_info.image;
    if (image_id!=''){
      var path = string.concat("<?php echo UPLOAD_URL.'ad/'?>",image_id);
    }else{
      var path = string.concat("<?php echo UPLOAD_URL?>",noimg.jpg);
    }
     $('#imgid img').attr("src",path); 
    showModal();  
  }
  


  function showModal(data=""){
    $('.modal').modal();
  }

  //for the thumbnail
  document.getElementById("image").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("thumbnail").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
</script>