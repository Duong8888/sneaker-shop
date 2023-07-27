<div class="modal fade show" id="bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel"
     aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="myLargeModalLabel">Thêm mới kích cỡ</p>
                <button type="button" class="btn-close btn-cancel" ></button>
            </div>
            <div class="modal-body">
                <form class="form add-color" method="POST" data-route="{{route('size.add')}}">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="data" class="form-control mb-2" placeholder=""/>
                            <span class="show-error text-danger mb-5"></span>
                        </div>
                        <input type="hidden" name="actionMethod">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-secondary btn-cancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
