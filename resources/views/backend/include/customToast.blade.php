@if(session()->has('message'))
<div class="cus_toast">
    <div class="cus_toast-content">
        <i class="fas fa-solid fa-check check"></i>

        <div class="message">
            <span class="text text-1">Success</span>
            <span class="text text-2">{{ session()->get('message') }}</span>
        </div>
    </div>
    <i class="fa-solid fa-xmark close"></i>

    <div class="progress"></div>
</div>
@endif
@if(session()->has('error'))
    <div class="cus_toast">
        <div class="cus_toast-content">
            <i class="fa-solid fa-xmark"></i>

            <div class="message">
                <span class="text text-3">Error</span>
                <span class="text text-2">{{ session()->get('error') }}</span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>

        <div class="progress"></div>
    </div>
@endif
