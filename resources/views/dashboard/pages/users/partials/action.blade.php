@canany(['dashboard.users.edit', 'dashboard.users.delete'])
<div class="dropdown d-inline-block">
    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-more-fill align-middle"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        @can('dashboard.users.edit')
        <li><a class="dropdown-item edit-item-btn" onclick="showEditModal({{ $value->id }})"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Sửa</a></li>
        @endcan
        @can('dashboard.users.delete')
            @if($value->id >1)
                <li>
                    <a class="dropdown-item remove-item-btn" onclick="singleDelete({{ $value->id }})">
                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Xóa
                    </a>
                </li>
            @endif
        @endcan
    </ul>
</div>
@endcanany