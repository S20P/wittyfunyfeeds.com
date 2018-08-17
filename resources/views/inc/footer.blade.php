@section('footer')


<footer id="footer" class="text-center">
  <div class="last-div">
      <div class="container-fluid">
        <div class="row">
          <div class="copyright">
             <a class="link" href="{{ route('About_us') }}">About Us</a> &nbsp;|&nbsp;
             <a class="link" href="{{ route('Terms_of_Service') }}">Terms of Service</a> &nbsp;|&nbsp;
             <a class="link" href="{{ route('privacy_and_policy') }}">Privacy &amp; Policy</a> &nbsp;|&nbsp;
             <a class="link" href="{{ route('faq') }}">FAQ</a>
            <p>
             Disclaimer: All content is provided for fun and entertainment purposes only
           </p>
          </div>
          <ul class="social-network">
            <li id="facebook-social"><a href="http://www.free-css.com/free-css-templates" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-1x"></i></a></li>
            <li><a href="http://www.free-css.com/free-css-templates" data-placement="top" title="Twitter"><i class="fa fa-twitter fa-1x"></i></a></li>
            <li id="google-pluse-social"><a href="http://www.free-css.com/free-css-templates" data-placement="top" title="Google plus"><i class="fa fa-google-plus fa-1x"></i></a></li>
            <li><a href="http://www.free-css.com/free-css-templates" data-placement="top" title="instagram"><i class="fa fa-instagram fa-1x"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
</footer>
 @show
