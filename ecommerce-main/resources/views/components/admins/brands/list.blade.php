<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <h5>All Brands</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus me-2"></i>Add New</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped" id="myTable">
                <thead>
                    <th>#</th>
                    <th>Brands Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
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
            let res = await axios.get('/brand-list');

            let dataList = $('#dataList');
            let myTable = $('#myTable');

            myTable.DataTable().destroy();
            dataList.empty();

            res.data['rows'].forEach(function(item,index){
                let row = `<tr>
                    <td>${++index}</td>
                    <td>${item['name']}</td>
                    <td>${item['slug']}</td>
                    <td>${item['description']}</td>
                    <td>${item['status']}</td>
                    <td>
                        <button type="button" data-id="${item['id']}" class="btn btn-sm btn-success editBtn"><i class="fa fa-edit"></i></button>
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
