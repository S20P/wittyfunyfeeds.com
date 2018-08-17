<div class="modal fade" id="favoritesModal"
tabindex="-1" role="dialog"
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog popup-round" role="document">
<div class="modal-content">
<!-- <div class="modal-header">
<button type="button" class="close"
data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true">&times;</span></button>
<h4 class="modal-title"
id="favoritesModalLabel">The Sun Also Rises</h4>
</div> -->
<div class="modal-body">
  @if(Auth::check())
  <div class="img-board">
       <img src="{{Auth::user()->picture}}" width="200px" height="200px" class="upload-preview" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); transform: translate3d(0px, 0px, 0px) scale(1, 1);"/>
        <p class="text-front-face">Front-facing Photo</p>
        </div>
               <form class="form-horizontal" role="form" name="event-form" id="event-form"  enctype="multipart/form-data">
                <div class="control_grup">
                <div class="control">
                    <label class="model_upload_btn" for="test">
                    <div class="title">Photo Upload</div>
                    <input type="file" id="app_img_url" class="form-control inputfile" name="app_img_url" accept="image/*"  onChange="showPreview(this);">
                   </label>

                          @if ($errors->has('app_img_url'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('app_img_url') }}</strong>
                              </span>
                          @endif
                  </div>
                  <div class="control">
                          <button type="submit" name="image_upload_app" id="image_upload_app" class="btn-submit wb-btn-red btn-start wb-btn wb-btn-lg wb-btn-fb btn-shadow disabled">
                              Next
                          </button>
                  </div>
                </div>
              </form>
@endif
</div>
<!-- <div class="modal-footer">
<button type="button"
class="btn btn-default"
data-dismiss="modal">Close</button>
</div> -->
  <!-- <button class="try-again-btn" onclick="app3_createimg()"><span></span>Try Again</button> -->
</div>
</div>
</div>
