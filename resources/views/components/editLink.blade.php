<td class="text-left">
    @if(isset($routeEdit))
        <a href="{{ $routeEdit }}" class="btn btn-info"><i class="fa fa-edit"></i> ویرایش</a>
        &nbsp;
    @endif
    @if(isset($routeDelete))
        <form id="destroy-form-{{$itemId}}" method="post" action="{{$routeDelete}}" style="display:none">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
        </form>
        <a href="#" onclick='event.preventDefault(); destroy({{$itemId}});' class="btn btn-danger"><i class="fa fa-trash"></i> حذف</a>
        &nbsp;
    @endif
</td>

<script>
    function destroy(itemId) {
        swal({
            title: "آیا این ردیف حذف شود؟",
            text: "توجه داشته باشید که عملیات حذف غیر قابل بازگشت می باشد.",
            icon: "warning",
            buttons: ["انصراف", "حذف"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('destroy-form-'+itemId).submit();
            }
        });
    }
</script>
