@extends('layouts.master')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Teams</a></li>
        </ol>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    Team Members
                    <button type="button" class="btn btn-primary btn-sm addbtn">add new member</button>
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
                                <th>sl</th>
                                <th>name</th>
                                <th>designation</th>
                                <th>phone</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($team_members as $key=>$member)                                
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->designation }}</td>
                                <td>
                                    <img src="{{ asset('/dashboard_assets/images/team') }}/{{ $member->photo }}" alt="" width="100">
                                </td>
                                <td>
                                    <button type="button" value="{{ $member->id }}" class="btn btn-outline-success btn-sm editBtn"><i class="fa fa-edit"></i></button>
                                    <button type="button" value="{{ $member->id }}" class="btn btn-outline-danger btn-sm deleteBtn"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal for add new member -->
    <div class="modal fade" id="addNewMember">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">add new member</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form action="{{ url('admin/team/member/store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="designation">designation</label>
                            <input type="text" name="designation" id="designation" class="form-control" value="{{ old('designation') }}">
                            @error('designation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="photo">photo</label>
                            <input type="file" name="photo" id="photo" class="form-control">
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
    <div class="modal fade" id="deleteConfirmModal">
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
    </div>
    {{-- modal for edit team member --}}
    <div class="modal fade" id="editMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">edit / update member information</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form action="{{ route('member.update') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="updateHiddenId" id="updateHiddenId">
                        <div class="form-group">
                            <label for="updatedName">name</label>
                            <input type="text" name="updatedName" id="updatedName" class="form-control" value="{{ old('updatedName') }}">
                            @error('updatedName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="updatedDesignation">designation</label>
                            <input type="text" name="updatedDesignation" id="updatedDesignation" class="form-control" value="{{ old('updatedDesignation') }}">
                            @error('updatedDesignation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="updatedPhoto">photo</label>
                            <input type="file" name="updatedPhoto" id="updatedPhoto" class="form-control">
                            @error('updatedPhoto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            // scripts for add new member
            $(document).on('click', '.addbtn', function() {
                $('#addNewMember').modal('show');
            });
            // scripts for delete team member
            $('.deleteBtn').click(function (e) { 
                e.preventDefault();
                let deleteBtnId = $(this).val();
                $('#deleteConfirmModal').modal('show');
                $('#deletedId').val(deleteBtnId);
            });
            // scripts for edit team member
            $('.editBtn').click(function (e) { 
                e.preventDefault();
                let editBtnId = $(this).val();
                $('#editMemberModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "admin/getMemberInfo/" + editBtnId,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $('#updateHiddenId').val(editBtnId);
                        $('#updatedName').val(response.member_info.name);
                        $('#updatedDesignation').val(response.member_info.designation);
                    }
                });
            });
        });
    </script>
    
@endsection
