<footer class="footer footer-black footer-white">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="//fb.com/kpmquockhanh" target="_blank">Tác giả</a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>, from kpmquockhanh with <i class="fa fa-heart heart"></i>
              </span>
            </div>
        </div>
    </div>
</footer>
<script src="{{asset('backend/js/core/jquery.min.js')}}"></script>
<script src="{{asset('backend/js/core/popper.min.js')}}"></script>
<script src="{{asset('backend/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/moment.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/bootstrap-selectpicker.js')}}"></script>
<script src="{{asset('backend/js/plugins/jasny-bootstrap.min.js')}}"></script>
<script async defer src="{{asset('backend/plugins/buttons.js')}}"></script>
<script src="{{asset('backend/js/paper-dashboard.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/js/plugins/axios.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/iziToast.min.js')}}"></script>
<script src="{{asset('backend/js/admin.js')}}"></script>

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

@include('backend.layouts.editor-script')
