
  <!-- Modal -->
  <div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="createRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="createRequestModalLabel">Add Testimonial</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('testimonial.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleTextField"></label>
              <input type="text" name="written_by" class="form-control" id="exampleTextField" placeholder="Testimonial By">
            </div>
            <div class="form-group">
              <label for="exampleTextArea">Testimonial</label>
              <textarea class="form-control" name="description" id="exampleTextArea" rows="3" placeholder="Enter short Testiomial"></textarea>
            </div>
          
            <div class="form-group">
              <label for="exampleFile">Upload Testimonial Image</label>
              <input type="file" name="imageurl" class="form-control-file" id="exampleFile" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  