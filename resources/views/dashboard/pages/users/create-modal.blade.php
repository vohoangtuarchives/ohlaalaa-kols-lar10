<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <input type="hidden" id="id-field" />
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Tên</label>
                        <input type="text" name='name' id="customername-field" class="form-control" placeholder="Name" required />
                        <div class="invalid-feedback">Chưa có tên.</div>
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Email</label>
                        <input type="email" name='email' id="customername-field" class="form-control" placeholder="Email" required />
                        <div class="invalid-feedback">Chưa có email.</div>
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Phân quyền</label>
                        <select name="role" class="form-select">
                            @php
                                $roles = \App\Models\Role::all(['id','code', 'title']);
                            @endphp
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if($role->code == 'member') selected @endif> {{ $role->title }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Chưa có email.</div>
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Password</label>
                        <input type="password" name='password' id="customername-field" class="form-control" placeholder="Password" required />
                        <div class="invalid-feedback">Chưa có password.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>