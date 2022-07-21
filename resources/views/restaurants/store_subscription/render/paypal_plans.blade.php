
@foreach( $data as $value)
<div>
    <div class="card">
        <div class="modal fade active" id="modal-payment-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-secondary">
                    <div class="modal-header">
                        <h6 class="modal-title text-black-50" id="modal-title-notification">Payments</h6>

                    </div>
                    <div class="modal-body">
                        <div id="paypal-button-container-{{$value->id}}"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-white " id="stopSound1" >Close</button>
                        <a id="stopSound2" target="_blank"  data-dismiss="modal" href="{{route("store_admin.subscription_plans")}}" class="btn btn-white ml-auto text-black-50">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
