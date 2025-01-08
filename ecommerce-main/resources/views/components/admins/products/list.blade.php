<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <h5>All Products</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus me-2"></i>Add New</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>image</th>
                    <th class="action">Action</th>
                </thead>
                <tbody id="dataList">

                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    getList();

    async function getList(){
        try {
            let res = await axios.get('/product-list');

            let dataList = $('#dataList');
            let myTable = $('#myTable');

            myTable.DataTable().destroy();
            dataList.empty();

            res.data['rows'].forEach(function(item,index){
                let row = `<tr>
                    <td>${++index}</td>
                    <td>${item.name}</td>
                    <td>${item.stock}</td>
                    <td>${item.color}</td>
                    <td>${item.price}</td>
                    <td>${item.category.name}</td>
                    <td>${item.brand.name}</td>
                    <td>
                        <a href="/product-image-list/${item.id}" class="btn btn-sm btn-secondary">Add/View Image</a>
                    </td>
                    <td class="d-flex">
                        <button type="button" data-id="${item['id']}" class="me-2 btn btn-sm btn-success editBtn"><i class="fa fa-edit"></i></button>
                        <button type="button" data-id="${item['id']}" class="btn btn-sm btn-danger deleteBtn"><i class="fa fa-trash"></i></button>
                    </td>
                    </tr>`
                dataList.append(row)
            })

            $('.editBtn').on('click', async function(){
                let id = $(this).data('id')
                await FillUpdateForm(id)
                $('#updateModal').modal('show')
            })

            $('.deleteBtn').on('click', function(){
                let id = $(this).data('id')
                $('#deleteModal').modal('show')
                $('#deleteId').val(id)

            })

            new DataTable('#myTable',{
                order:[0,'desc']
            })

        } catch (e) {
            unauthorized(e.response.status);
        }


    }
</script>
@endpush
