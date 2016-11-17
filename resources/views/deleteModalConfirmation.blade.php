<html>
<head>
  </head>
    <body>

<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">@lang('language.delete-header')</h4>
            </div>
            <div class="modal-body">
                <p>@lang('language.delete-message')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('language.cancel')</button>
                <a class="delete"><button type="button" class="btn btn-danger confirm" id="confirm">@lang('language.delete')</button></a>
            </div>
        </div>
    </div>
</div>

</body>

</html>



<!-- Modal Dialog -->

