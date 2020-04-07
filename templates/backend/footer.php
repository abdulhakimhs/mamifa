<div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            <?= date('Y') ?> &copy; <a href="https://ahsanwebid.com"><b>ahsanwebid</b></a> - All rights reserved.
                        </span>
                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        

        <!-- <![endif]-->

        <!--[if IE]>
<script src="<?= base_url() ?>assets/backend/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url() ?>assets/backend/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="<?= base_url() ?>assets/backend/js/bootstrap.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script> -->
        <script src="<?= base_url() ?>assets/backend/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/backend/js/jquery.dataTables.bootstrap.min.js"></script>
        
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
        <script src=""></script>
        <script src="<?= base_url() ?>assets/backend/js/dataTables.select.min.js"></script>
        <script src="<?= base_url() ?>assets/backend/js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/backend/js/jquery-ui.custom.min.js"></script>
        <!-- page specific plugin scripts -->

        <!-- ace scripts -->
        <script src="<?= base_url() ?>assets/backend/js/ace-elements.min.js"></script>
        <script src="<?= base_url() ?>assets/backend/js/ace.min.js"></script>

        <script type="text/javascript">
        // $(document).ready(function () {
        //     var url = window.location;
        //     $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        //     $('ul.nav a').filter(function() {
        //          return this.href == url;
        //     }).parent().addClass('active');
        // });
        </script>
        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {

             var $sidebar = $('.sidebar').eq(0);
             if( !$sidebar.hasClass('h-sidebar') ) return;

             $(document).on('settings.ace.top_menu' , function(ev, event_name, fixed) {
                if( event_name !== 'sidebar_fixed' ) return;

                var sidebar = $sidebar.get(0);
                var $window = $(window);

                //return if sidebar is not fixed or in mobile view mode
                var sidebar_vars = $sidebar.ace_sidebar('vars');
                if( !fixed || ( sidebar_vars['mobile_view'] || sidebar_vars['collapsible'] ) ) {
                    $sidebar.removeClass('lower-highlight');
                    //restore original, backend marginTop
                    sidebar.style.marginTop = '';

                    $window.off('scroll.ace.top_menu')
                    return;
                }


                 var done = false;
                 $window.on('scroll.ace.top_menu', function(e) {

                    var scroll = $window.scrollTop();
                    scroll = parseInt(scroll / 4);//move the menu up 1px for every 4px of document scrolling
                    if (scroll > 17) scroll = 17;


                    if (scroll > 16) {
                        if(!done) {
                            $sidebar.addClass('lower-highlight');
                            done = true;
                        }
                    }
                    else {
                        if(done) {
                            $sidebar.removeClass('lower-highlight');
                            done = false;
                        }
                    }

                    sidebar.style['marginTop'] = (17-scroll)+'px';
                 }).triggerHandler('scroll.ace.top_menu');

             }).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);

             $(window).on('resize.ace.top_menu', function() {
                $(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
             });


            });
        </script>
    </body>
</html>
