<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="update_form">

            <div class="modal-body">
                <input type="hidden" id="updateId">
                <div class="form-group mb-3">
                    <label for="">Category Name</label>
                    <input type="text" id="nameUpdate" class="form-control" placeholder="Category Name">
                </div>

                <div class="form-group mb-3">
                    <label for="">Description</label>
                    <input type="text" id="descriptionUpdate" class="form-control" placeholder="Description">
                </div>

                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select id="statusUpdate" class="form-select">
                        <option value="">--- Select Status ---</option>
                        <option value="active">Active</option>
                        <option value="inactive">In Active</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="modal-footer">
          <button type="button" id="updateModalClose" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="Update()" class="btn btn-sm btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    // Filling update form with data from database
    async function FillUpdateForm(id) {
        $('#updateId').val(id)

        let res = await axios.post('/category-byId',{id:id})

        $('#nameUpdate').val(res.data['rows']['name'])
        $('#descriptionUpdate').val(res.data['rows']['description'])
        $('#statusUpdate').val(res.data['rows']['status'])
    }

    // Update the Form Data
    async function Update() {
        let updateId = $('#updateId').val()
        let nameUpdate = $('#nameUpdate').val()
        let descriptionUpdate = $('#descriptionUpdate').val()
        let statusUpdate = $('#statusUpdate').val()

        if (!nameUpdate) {
            errorToast('Category Name is required')
        } else if(!descriptionUpdate) {
            errorToast('Description is required')
        } else if(!statusUpdate) {
            errorToast('Status is required')
        } else {
            $('#updateModalClose').click()
            let updateFormData = new FormData()
            updateFormData.append('nameUpdate', nameUpdate)
            updateFormData.append('descriptionUpdate', descriptionUpdate)
            updateFormData.append('statusUpdate', statusUpdate)
            updateFormData.append('updateId', updateId)

            let res = await axios.post('/category-update',updateFormData)
            if (res.status === 200) {
                await getList()
                successToast(res.data['message'])
            } else {
                errorToast(res.data['message'])
            }
        }
    }
  </script>
  @endpush
