<div class="modal fade" id="{{ $dataTarget }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="deleteComponent">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-header">
                    <h5 class="modal-title">Delete {{ $modalType }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        Are you sure you want to delete this {{ $modalType }}?
                    </div>
                    <input type="hidden" name="media_id" value="" />

                    <!-- <input type="hidden" name="_method" value="DELETE" /> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function passRoute(e) {
        $('#deleteComponent').attr('action', $(e).data('href'));
        if ($(e).data('id')) {
            $('input[name="media_id"]').val($(e).data('id'));
        }

    }
</script>