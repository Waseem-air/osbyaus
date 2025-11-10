   @include("admin.components.head")
 @include("admin.components.header")
  <!-- #wrapper -->
<div id="wrapper">
    <!-- #page -->
    <div id="page" class="">
        <!-- layout-wrap -->
        <div class="layout-wrap loader-off">
            <!-- preload -->
            <div id="preload" class="preload-container">
                <div class="preloading">
                    <span></span>
                </div>
            </div>
            <!-- /preload -->
 @include("admin.components.sidebar")
  <!-- section-content-right -->
            <div class="section-content-right">
 @include("admin.components.header")
@yield('content')
 </div>
            <!-- /section-content-right -->
        </div>
        <!-- /layout-wrap -->
    </div>
    <!-- /#page -->
</div>
<!-- /#wrapper -->
 @include("admin.components.footer")
