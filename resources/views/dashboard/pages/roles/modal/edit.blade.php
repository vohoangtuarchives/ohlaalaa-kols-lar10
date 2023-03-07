<div class="modal fade" id="showUpdateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Update Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>

            <form class="tablelist-form" autocomplete="off" method="POST" action="{{ request()->url() }}">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <input type="hidden" id="id-field" />
                    <div class="mb-3">
                        <div class="row">
                            @foreach($permissions as $group => $values)
                                <div class="col-lg-4 col-sm-6">
                                    <h5>{{ $group }}</h5>
                                    @foreach($values as $permission)
                                        <div class="form-check form-switch">
                                            <label for="{{ $permission->code }}" class="form-label">{{ $permission->title }}</label>
                                            <input name="permissions[]"
                                                   class="form-check-input"
                                                   type="checkbox"
                                                   role="switch"
                                                   id="{{ $permission->code }}"
                                                   value="{{$permission->id}}"
                                                    {{ !$role->hasPermission($permission->code) ? '' : 'checked' }}>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>