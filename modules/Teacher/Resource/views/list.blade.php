@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <div class="border">
        <h2 class="text-center pt-3 font-weight-bold pb-2 border-bottom">LISR TEACHERS! </h2>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <p class="text-right" style="margin-top: 4px;">
                    <a href="{{route('admin.teacher.create')}}" class="btn btn-primary mr-3">Add New Teacher</a>
                </p>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive" style=" overflow: visible;">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 7%;">Image</th>
                                <th class="">Name</th>
                                <th class="">Experience</th>
                                <th class="">Start date</th>
                                <th class="text-center" style="width: 5%;">Edit</th>
                                <th class="text-center" style="width: 5%;">Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="text-center" style="width: 7%;">Image</th>
                                <th class="">Name</th>
                                <th class="">Experience</th>
                                <th class="">Start date</th>
                                <th class="text-center" style="width: 5%;">Edit</th>
                                <th class="text-center" style="width: 5%;">Delete</th>
                            </tr>
                            </tfoot>

                        </table>
                @include('parts.backend.form-delete')
                </div>

            </div>
        </div>
    </div>




@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                ajax      : '{{route('admin.teacher.data')}}',
                processing: true,
                serverSide: true,
                'columns'  : [
                    { "data": "image" },
                    { "data": "name" },
                    { "data": "exp" },
                    { "data": "created_at" },
                    { "data": "edit" },
                    { "data": "delete" },

                ]
            })
        });
    </script>
    <script>
        const tableList     = document.querySelector('#dataTable');
        const deleteForm    = document.querySelector('.delete-form');

        tableList.addEventListener("click", (e) => {
            if (e.target.classList.contains('delete-action')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xoá ??',
                    text: "Xoá sẽ không thể khôi phục lại!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ok, Xoá !'
                }).then((result) => {
                    if (result.isConfirmed) {
                            const action        = e.target.href;
                            deleteForm.action   = action;
                            deleteForm.submit();
                    }
                })

            }
        });
    </script>
@endsection
