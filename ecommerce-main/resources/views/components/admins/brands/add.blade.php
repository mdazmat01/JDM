<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Brand</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="save_form">
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="">Brand Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Brand Name">
                </div>

                <div class="form-group mb-3">
                    <label for="">Description</label>
                    <input type="text" id="description" class="form-control" placeholder="Description">
                </div>

                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select id="status" class="form-select">
                        <option value="">--- Select Status ---</option>
                        <option value="active">Active</option>
                        <option value="inactive">In Active</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="modal-footer">
          <button type="button" id="close_save_form" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="Save()" class="btn btn-sm btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    async function Save() {
        let name = $('#name').val()
        let description = $('#description').val()
        let status = $('#status').val()

        if (!name) {
            errorToast('Name is required')
        } else if(!description) {
            errorToast('Description is required')
        } else if(!status) {
            errorToast('Status is required')
        } else {
            $('#close_save_form').click()
            let formData = new FormData()
            formData.append('name',name)
            formData.append('description',description)
            formData.append('status',status)

           let res = await axios.post('/brand-store',formData)

           if (res.status === 200) {
            document.getElementById('save_form').reset()
            await getList()
            successToast(res.data['message'])
           } else {

           }


        }

    }
  </script>

  @endpush
