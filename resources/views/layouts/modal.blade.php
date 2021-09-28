<div id="modalHolder-@yield('id', 'modal')">
    @yield('before')
    <div class="modal fade @yield('modal-ajax', 'modal-ajax')" id="@yield('id', 'modal')" tabindex="-1" role="dialog"
        aria-labelledby="#@yield('label', 'modalLabel')" aria-hidden="true">
        <div class="modal-dialog @yield('dialog-class')" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @yield('header-before')
                    <h5 class="modal-title" id="@yield('label', 'modalLabel')"><span
                            class="context-menu-translate">@yield('title', 'Modal')</span></h5>
                    <div class="ml-auto">@yield('header-between')</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @yield('header-after')
                </div>
                <div class="modal-body">
                    @yield('content')
                </div>
                <div class="modal-footer">
                    @yield('footer')
                </div>
            </div>
        </div>
    </div>
    @yield('after')
    <script type="text/javascript">
    </script>
    @yield('scripts')
    <img src="{{ asset("storage/images/blank.png") }}?d={{ time() }}"
        onload="$('#@yield('id', 'modal')').trigger('loaded.bs.modal');">
</div>