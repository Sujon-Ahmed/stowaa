@extends('layouts.master')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Brands</a></li>
        </ol>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    All Brands
                    <button type="button" class="btn btn-primary btn-sm addbtn">add new brand</button>
                </div>

                <div class="card-body">
                    @if (session('delete'))
                        <div class="alert alert-success" role="alert">
                            {{ session('delete') }}
                        </div>
                    @endif
                    <table id="example3" class="display min-w850">
                        <thead>
                            <tr>
                                <th>brand logo</th>
                                <th class="float-right">options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key=>$brand)                                
                            <tr>
                                <td>
                                    <img src="{{ asset('/uploads/brands') }}/{{ $brand->brand_img }}" alt="" width="100">
                                </td>
                                <td class="float-right">
                                    <label class="switch">
                                        <input type="checkbox" name="status" onchange="status_change(this)" value="{{ $brand->id }}" {{ $brand->status == '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                      </label>
                                    <button type="button" value="{{ $brand->id }}" class="btn btn-outline-success btn-sm editBtn"><i class="fa fa-edit"></i></button>
                                    <button type="button" value="{{ $brand->id }}" class="btn btn-outline-danger btn-sm deleteBtn"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal for add new member -->
    <div class="modal fade" id="addNewBrand">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">add new brand</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="preview">
                            <img src="" id="pic" class="img-fluid">
                        </div>
                        <div class="form-group">
                            <input type="file" name="photo" id="photo" class="form-control" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal for delete confirm message --}}
    {{-- <div class="modal fade" id="deleteConfirmModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Message</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('teamMember.delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are You Sure Delete This Team Member?</p>
                        <input type="hidden" name="deletedId" id="deletedId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes! Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('footer_script')
    <script>
        $(document).ready(function () {
            $('.addbtn').click(function() {
                $('#addNewBrand').modal('show');
            });
        });
        function status_change(el) {
            var status = 0;
            if(el.checked) {
                var status = 1;
            }
            $.post('{{ route('change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status});
            // $.post('{{ route('change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, is_featured:is_featured});
        }
    </script>
@endsection
