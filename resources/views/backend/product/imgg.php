<div class="col-md-4">
    <div class="form-group">
        <h5>Main Thumbnail <span class="text-danger">*</span></h5>
        <div class="controls">
            <input type="file" name="product_thumbnail" class="form-control" onchange="mainTHM(this)">
            <img src="" alt="" id="thmIMG">
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <h5>Multi Image <span class="text-danger">*</span></h5>
        <div class="controls">
            <input type="file" name="multi_img[]" class="form-control" onchange="multiImg(this)" multiple id="multiImg">
            <div class="row" id="preview_img"></div>
        </div>
    </div>
</div>
</div>