<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="delete_form">
            <div class="modal-body">
                <input type="hidden" id="deleteId">
                <p>Are you sure ! Do you want to delete this item ?</p>
            </div>
        </form>
        <div class="modal-footer">
          <button type="button" id="closeDeleteModal" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="Delete()" class="btn btn-sm btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    async function Delete() {
        let deleteId = $('#deleteId').val()

        $('#closeDeleteModal').click()

        let deleteFormData = new FormData()
        deleteFormData.append('deleteId',deleteId)

        let res = await axios.post('/category-delete', deleteFormData)

        if (res.status === 200) {
            await getList()
            successToast(res.data['message'])
        } else {
            errorToast(res.data['message'])
        }
    }
  </script>

  @endpush
