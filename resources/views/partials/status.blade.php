<div class="relative inline-block">
    <img
        src="{{asset('storage/orders')}}/{{$status->file_name}}"
        class="orderSvg absolute" alt="">
    <p class="rounded border-orange-900 border-b-2 border-t-2 p-3 inline">
        {{$statuses[$status->name]}}
    </p>
</div>
