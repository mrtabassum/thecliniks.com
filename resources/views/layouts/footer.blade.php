<div class="footer py-4 d-flex flex-lg-column footer-fix" id="kt_footer">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark">
            <span class="text-muted fw-bold me-1">{{ __("messages.all_rights_reserved") }} ©{{ \Carbon\Carbon::now()->year }}  </span>
            <a href="#" class="text-gray-800 text-hover-primary">{{ getAppName() }}</a>
        </div>
        <div class="">
            <span class="text-muted align-content-end">v{{ version() }}</span>
        </div>
    </div>
</div>
