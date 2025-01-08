<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="save_form">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group mb-3">
                        <label for="">Product Name<span class="text-danger ml-1">*</span></label>
                        <input type="text" id="name" class="form-control" placeholder="Product Name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Description<span class="text-danger ml-1">*</span></label>
                        <input type="text" id="description" class="form-control" placeholder="Description">
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="">Stock<span class="text-danger ml-1">*</span></label>
                        <input type="number" id="stock" class="form-control" placeholder="Stock">
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="">Color<span class="text-danger ml-1">*</span></label>
                        <input type="text" id="color" class="form-control" placeholder="Color">
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="">Price<span class="text-danger ml-1">*</span></label>
                        <input type="number" id="price" class="form-control" placeholder="Price">
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="">Category<span class="text-danger ml-1">*</span></label>
                        <select id="categoryId" class="form-select">
                            <option value="">--- Select Category ---</option>
                            @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="">Brand<span class="text-danger ml-1">*</span></label>
                        <select id="brandId" class="form-select">
                            <option value="">--- Select Brand ---</option>
                            @foreach ($brands as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="">Status<span class="text-danger ml-1">*</span></label>
                        <select id="status" class="form-select">
                            <option value="">--- Select Status ---</option>
                            <option value="active">Active</option>
                            <option value="inactive">In Active</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Product Images Upload<span class="text-danger ml-1">*</span></label>
                        <input id="imageInput" multiple type="file" class="form-control">
                    </div>

                </div>
            </div>
        </form>

        <div id="imageDive" class="p-3 pt-0"></div>

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
        let stock = $('#stock').val()
        let price = $('#price').val()
        let color = $('#color').val()
        let categoryId = $('#categoryId').val()
        let brandId = $('#brandId').val()
        let imageInput = document.getElementById('imageInput')
        // let images = document.getElementById('image').files[0];
        let status = $('#status').val()

        if (!name) {
            errorToast('Name is required')
        } else if(!description) {
            errorToast('Description is required')
        } else if(!stock) {
            errorToast('Stock is required')
        } else if(!price) {
            errorToast('Price is required')
        } else if(!color) {
            errorToast('Color is required')
        } else if(!imageInput) {
            errorToast('Image is required')
        } else if(!status) {
            errorToast('Status is required')
        } else {
            $('#close_save_form').click()

            let formData = new FormData()

            for (let i = 0; i < imageInput.files.length; i++) {
                // const element = array[i];
                formData.append('images[]',imageInput.files[i])
            }

            formData.append('name',name)
            formData.append('description',description)
            formData.append('stock',stock)
            formData.append('price',price)
            formData.append('color',color)
            formData.append('categoryId',categoryId)
            formData.append('brandId',brandId)

            formData.append('status',status)

           let res = await axios.post('/product-store',formData)

           if (res.status === 200) {
            document.getElementById('save_form').reset()
            await getList()
            successToast(res.data['message'])
           } else {
            errorToast(res.data['message'])
           }


        }

    }
  </script>

  @endpush
