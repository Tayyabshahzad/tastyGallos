@extends('layouts.master')
@section('title', 'Modifiers Edit')
@section('page_head')
    <link href="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-12">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.modifiers') }}"> Modifiers </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted"> Edit</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.modifiers.update') }}" method="post" enctype="multipart/form-data"
                    id="updateModifierFrom"> @csrf
                    <input type="hidden" name="edit_id" value="{{ $modifier->id }}">
                    <input type="hidden" name="status" value="inactive">
                    <div class="card card-custom mb-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Edit Modifiers</h3>
                            </div>
                            <div class="card-toolbar">
                                <div class="card-toolbar">
                                    <span class="switch switch-danger switch-icon switch-sm">
                                        <span class="font-weight-bold">Status</span> <label class="ml-2">
                                            <input type="checkbox" value="active"
                                                @if ($modifier->status == 'active') checked="checked" @endif name="status">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Modifers Name *</label>
                                    <input type="text" required="" name="name" class="form-control"
                                        value="{{ $modifier->name }}">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label class="font-weight-bold">Select Item *</label>
                                    <select class="form-control select2" id="kt_select2_3" multiple="multiple"
                                        name="newItems[]" required>
                                        @foreach ($items as $item )
                                            <option value="{{ $item->id }}"    @if (in_array($item->id, $assign_items)) selected="selected" @endif >   {{ $item->name }} &nbsp;&nbsp;&nbsp; &rArr; {{ $item->final_price }} ZAR </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 form-group ticket_price_group">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Item
                                                </th>
                                                <th>
                                                    Price
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemsList">
                                            @foreach ($modifier->items as $myItem)
                                                <tr>
                                                    <td>
                                                        <input type="text" disabled value="{{ $myItem->name }}"  class="form-control">
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">ZAR</span>
                                                            </div>
                                                            <input type="number"
                                                                class="form-control item_price{{ $myItem->id }}"
                                                                name="prices[{{ $myItem->id }}]"
                                                                step="0.01"
                                                                min="0"
                                                                value="{{ $myItem->pivot->price }}" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{-- <button  class="mt-1 btn btn-sm btn-icon btn-light-danger btn-square deleteItem"
                                                                type="button"
                                                                onclick="deleteItems({{ $myItem->id }},{{ $modifier->id }})">
                                                                <i class=" icon-1x text-dark-5 flaticon-delete"></i>
                                                            </button> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-lg-12 mb-5 ">
                                            <label class="font-weight-bold">Rules *</label>
                                            <p class="font-weight-bold"> Set rules to control how customer select items in
                                                the modifier group </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 ">
                                            <p>What’s the minimum number of options a customer must select </p>
                                        </div>
                                        <div class="col-lg-2 text-left mb-5">
                                            <input type="text" required="" class="form-control" name="select_min_options"
                                                value="{{ $modifier->select_min_options }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10 ">
                                            <p>What’s the maximum number of options a customer can select </p>
                                        </div>
                                        <div class="col-lg-2 text-left mb-5">
                                            <input type="text" required="" class="form-control" name="select_max_options"
                                                value="{{ $modifier->select_max_options }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p>How many times can customers select any single option </p>
                                        </div>
                                        <div class="col-lg-2 text-left">
                                            <input type="text" required="" class="form-control"
                                                name="option_selected_times"
                                                value="{{ $modifier->option_selected_times }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p>Should choose quantity ?</p>
                                        </div>
                                        <div class="col-lg-2 text-left">
                                            <div class="col-2 col-form-label">
                                                <div class="checkbox-inline">
                                                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                                    <input type="checkbox" name="choose_quantity" value="yes" @if($modifier->choose_quantity == true)  checked="checked" @endif >
                                                    <span></span></label>

                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('admin.modifiers') }}"
                                        class="btn btn-warning font-weight-bold btn-square"> Cancel </a>
                                    <button type="submit" class="btn btn-danger font-weight-bold btn-square"
                                        id="UpdateModifier"> Update
                                        Modifier </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('page_js')
    <script>
        $('#kt_select2_3').select2({
            placeholder: "Select Item",
        });
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                $myError = ucwords($error);
            @endphp
            <script>
                toastr.error('{{ $myError }}', "Error");
            </script>
        @endforeach
    @endif
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".updateItem").click(function(e) {
            var item_id = $(this).data('item_id');
            var modifier_id = $(this).data('modifier_id');
            var item_price = $('.item_price' + item_id).val();

            e.preventDefault();
            var url = '{{ route('admin.modifiers.item.update') }}';
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    item_id: item_id,
                    modifier_id: modifier_id,
                    item_price: item_price,
                },
                success: function(response) {
                    if (response.success == true) {
                        table.ajax.reload();
                        toastr.success(response.message, "success");
                    } else {
                        toastr.error(response.message, "error");
                    }
                    console.log(response.success);
                },

            });
        });

        function deleteItems(id, modifier_id) {
            Swal.fire({
                title: "Are you sure to delete ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn-danger"
                }
            }).then(function(result) {
                if (result.value) {
                    var url = '{{ route('admin.modifiers.item.delete') }}';
                    $.ajax({
                        url: url,
                        method: 'get',
                        data: {
                            id: id,
                            modifier_id: modifier_id
                        },
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response.message, "success");
                                location.reload();
                            } else {
                                toastr.error(response.message, "error");
                            }
                        }
                    });
                }
            });
        }
        $("#updateModifierFrom").submit(function(e) {
            $("#UpdateModifier").attr("disabled", true);
        });
    </script>
    <script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var table = $('#datatable').DataTable();
    </script>
@endsection
